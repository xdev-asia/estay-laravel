<?php

namespace App\Factories;

use App\Models\User;
use App\Repositories\ActivationRepository;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class ActivationFactory
{
    protected $activationRepo;
    protected $mailer;
    protected $resendAfter = 24;

    public function __construct(ActivationRepository $activationRepo, Mailer $mailer)
    {
        $this->activationRepo = $activationRepo;
        $this->mailer = $mailer;
    }

    public function sendActivationMail($user)
    {
        if ($user->is_active || !$this->shouldSend($user)) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);
        $link = route('user.activate', $token);
        $static_data = static_home();
        $mail_data = [
            'first_name'        => $user->info->first_name,
            'last_name'         => $user->info->last_name,
            'username'          => $user->username,
            'str_username'      => $static_data['strings']['username'],
            'str_email'         => $static_data['strings']['email'],
            'activate_account'  => $static_data['strings']['activate_account'],
            'email'             => $user->email,
            'link'              => $link,
            'message'           => $static_data['strings']['activate_account_email'],
            'site_name'         => $static_data['site_settings']['site_name'],
            'admin_email'       => $static_data['site_settings']['contact_email'],
            'regards'           => $static_data['strings']['regards']
        ];
        $mail_data['mail_after_text'] = $static_data['strings']['mail_after_text'];

        // Create the mail and send it
        Mail::send('emails.activate', ['mail_data' => $mail_data], function ($m) use ($mail_data) {
            $m->from($mail_data['admin_email'], $mail_data['site_name']);
            $m->to($mail_data['email'], $mail_data['first_name'])->subject($mail_data['activate_account'].' - '.$mail_data['site_name']);
        });
    }

    public function resendActivationMail($user)
    {
        if ($user->is_active) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);
        $link = route('user.activate', $token);
        $static_data = static_home();
        $mail_data = [
            'first_name'        => $user->info->first_name,
            'last_name'         => $user->info->last_name,
            'username'          => $user->username,
            'str_username'      => $static_data['strings']['username'],
            'str_email'         => $static_data['strings']['email'],
            'activate_account'  => $static_data['strings']['activate_account'],
            'email'             => $user->email,
            'link'              => $link,
            'message'           => $static_data['strings']['activate_account_email'],
            'site_name'         => $static_data['site_settings']['site_name'],
            'admin_email'       => $static_data['site_settings']['contact_email'],
            'regards'           => $static_data['strings']['regards']
        ];
        $mail_data['mail_after_text'] = $static_data['strings']['mail_after_text'];

        // Create the mail and send it
        Mail::send('emails.activate', ['mail_data' => $mail_data], function ($m) use ($mail_data) {
            $m->from($mail_data['admin_email'], $mail_data['site_name']);
            $m->to($mail_data['email'], $mail_data['first_name'])->subject($mail_data['activate_account'].' - '.$mail_data['site_name']);
        });
    }

    public function activateUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->is_active = 1;

        $user->save();

        $this->activationRepo->deleteActivation($token);

        return $user;
    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }
}