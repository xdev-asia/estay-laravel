<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\Setting;
use App\Models\Admin\Language;
use App\Models\Admin\Str;


class UpdateController extends Controller
{
    public function update(){
        $version = Config::get('app.version');

        if($version == '1.25'){
            $setting = Setting::where('key', 'update_done')->first();
            if($setting && $setting->value == $version){
                
                // Save for next Update
                $setting->value = '1.25';
                $setting->save();

                // Create Strings
                $languages = Language::all();
                foreach($languages as $language){
                    $default = ($language->id == 1) ? 1 : 0;
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 1,
                        'key' => 'more_options',
                        'string' => 'More Options',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 1,
                        'key' => 'filter_by_features',
                        'string' => 'Filter by features',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 1,
                        'key' => 'upgrade_completed_email',
                        'string' => 'Your account has been successfully upgraded to Owner. When you login on the website now you will be redirected to your own dashboard! Enjoy.',
                    ]);
                }

                Setting::create([
                    'key' => 'filter_by_features', 
                    'type' => 'property',
                    'value' => '1',
                ]);

                dd('Your version is successfully upgraded to 1.25! You can close this tab now. Enjoy :)');

            }else if($setting && $setting->value != $version){
                dd('Already Updated to 1.25');
            }else{

                // Create Strings
                $languages = Language::all();
                foreach($languages as $language){
                    $default = ($language->id == 1) ? 1 : 0;
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 1,
                        'key' => 'more_options',
                        'string' => 'More Options',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 1,
                        'key' => 'filter_by_features',
                        'string' => 'Filter by features',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 1,
                        'key' => 'upgrade_completed_email',
                        'string' => 'Your account has been successfully upgraded to Owner. When you login on the website now you will be redirected to your own dashboard! Enjoy.',
                    ]);
                }

                Setting::create([
                    'key' => 'filter_by_features', 
                    'type' => 'property',
                    'value' => '1',
                ]);

                // If setting doesnt exist
                Setting::create([
                    'key' => 'update_done', 
                    'value' => '1.25',
                ]);

                dd('Your version is successfully upgraded to 1.25! You can close this tab now. Enjoy :)');
            }
        }
        

        if($version == '1.11'){
            $setting = Setting::where('key', 'update_done')->first();
            if($setting && $setting->value == $version){
                
                // Save for next Update
                $setting->value = '1.12';
                $setting->save();

                // Update Database
                $sql = "ALTER TABLE `withdrawals` ADD `status` INT NOT NULL DEFAULT '0' AFTER `user_id`;UPDATE `strings` SET `is_backend` = '0' WHERE `strings`.`key` = 'completed';INSERT INTO `settings` (`id`, `key`, `value`, `type`) VALUES (NULL, 'facebook_api_id', NULL, 'user'), (NULL, 'facebook_api_secret', NULL, 'user'), (NULL, 'google_api_id', NULL, 'user'), (NULL, 'google_api_secret', NULL, 'user');CREATE TABLE `socials` (`id` int(10) UNSIGNED NOT NULL,`user_id` int(11) NOT NULL DEFAULT '0',`social_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,`social_user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;ALTER TABLE `socials` ADD PRIMARY KEY (`id`);ALTER TABLE `socials` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;";
                DB::unprepared($sql);

                // Create Strings
                $languages = Language::all();
                foreach($languages as $language){
                    $default = ($language->id == 1) ? 1 : 0;
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 1,
                        'key' => 'google_client_id',
                        'string' => 'Google Client ID',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 1,
                        'key' => 'google_client_secret',
                        'string' => 'Google Client Secret',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 1,
                        'key' => 'facebook_client_id',
                        'string' => 'Facebook Client ID',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 1,
                        'key' => 'facebook_client_secret',
                        'string' => 'Facebook Client Secret',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'login_with_facebook',
                        'string' => 'Login with Facebook',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'login_with_google',
                        'string' => 'Login with Google',
                    ]);
                }
                dd('Your version is successfully upgraded to 1.11! You can close this tab now. Enjoy :)');

            }else if($setting && $setting->value != $version){

                // If already updated to 1.11
                dd('Already Updated to 1.11');
            }else{

                // Update Database
                $sql = "ALTER TABLE `withdrawals` ADD `status` INT NOT NULL DEFAULT '0' AFTER `user_id`;UPDATE `strings` SET `is_backend` = '0' WHERE `strings`.`key` = 'completed';INSERT INTO `settings` (`id`, `key`, `value`, `type`) VALUES (NULL, 'facebook_api_id', NULL, 'user'), (NULL, 'facebook_api_secret', NULL, 'user'), (NULL, 'google_api_id', NULL, 'user'), (NULL, 'google_api_secret', NULL, 'user');CREATE TABLE `socials` (`id` int(10) UNSIGNED NOT NULL,`user_id` int(11) NOT NULL DEFAULT '0',`social_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,`social_user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;ALTER TABLE `socials` ADD PRIMARY KEY (`id`);ALTER TABLE `socials` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;";
                DB::unprepared($sql);

                // Create Strings
                $languages = Language::all();
                foreach($languages as $language){
                    $default = ($language->id == 1) ? 1 : 0;
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 1,
                        'key' => 'google_client_id',
                        'string' => 'Google Client ID',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 1,
                        'key' => 'google_client_secret',
                        'string' => 'Google Client Secret',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 1,
                        'key' => 'facebook_client_id',
                        'string' => 'Facebook Client ID',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 1,
                        'key' => 'facebook_client_secret',
                        'string' => 'Facebook Client Secret',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'login_with_facebook',
                        'string' => 'Login with Facebook',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'login_with_google',
                        'string' => 'Login with Google',
                    ]);
                }

                // If setting doesnt exist
                Setting::create([
                    'key' => 'update_done', 
                    'value' => '1.12',
                ]);

                dd('Your version is successfully upgraded to 1.11! You can close this tab now. Enjoy :)');
            }
        }


        // 1.13 Version
        if($version == '1.13'){
            $setting = Setting::where('key', 'update_done')->first();
            if($setting && $setting->value == $version){
                
                // Save for next Update
                $setting->value = '1.13';
                $setting->save();

                $languages = Language::all();
                foreach($languages as $language){
                    $default = ($language->id == 1) ? 1 : 0;
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'you_have_received_new_booking',
                        'string' => 'You have received a new booking! Here are the details:',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'add_your_property',
                        'string' => 'Add your Property',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'upgrade_request_confirm',
                        'string' => 'Are you sure you want to request an upgrade for your account?',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'allow_add_property_button',
                        'string' => 'Show Add your Property button',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'upgrade_completed',
                        'string' => 'Upgrade Completed',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'upgrade_completed_email',
                        'string' => 'Your account has been successfully upgraded to Owner. When you login on the website now you will be redirected to your own dashboard! Enjoy.
',
                    ]);
                }

                Setting::create([
                    'key' => 'allow_add_property_button', 
                    'value' => '1',
                    'type' => 'design',
                ]);


                // Update Database
                $sql = "ALTER TABLE `categories` ADD `order` INT NOT NULL DEFAULT '0' AFTER `id`;ALTER TABLE `locations` ADD `order` INT NOT NULL DEFAULT '0' AFTER `id`;";
                DB::unprepared($sql);

                dd('Your version is successfully upgraded to 1.13! You can close this tab now. Enjoy :)');

            }else if($setting && $setting->value != $version){

                // If already updated to 1.13
                dd('Already Updated to 1.13');
            }else{

                // Update Database
                $sql = "ALTER TABLE `categories` ADD `order` INT NOT NULL DEFAULT '0' AFTER `id`;";
                DB::unprepared($sql);

                
                $languages = Language::all();
                foreach($languages as $language){
                    $default = ($language->id == 1) ? 1 : 0;
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'you_have_received_new_booking',
                        'string' => 'You have received a new booking! Here are the details:',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'add_your_property',
                        'string' => 'Add your Property',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'upgrade_request_confirm',
                        'string' => 'Are you sure you want to request an upgrade for your account?',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'allow_add_property_button',
                        'string' => 'Show Add your Property button',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'upgrade_completed',
                        'string' => 'Upgrade Completed',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'upgrade_completed_email',
                        'string' => 'Your account has been successfully upgraded to Owner. When you login on the website now you will be redirected to your own dashboard! Enjoy.
',
                    ]);
                }

                // If setting doesnt exist
                Setting::create([
                    'key' => 'update_done', 
                    'value' => '1.13',
                ]);
                Setting::create([
                    'key' => 'allow_add_property_button', 
                    'value' => '1',
                    'type' => 'design',
                ]);

                dd('Your version is successfully upgraded to 1.13! You can close this tab now. Enjoy :)');
            }
        }

        // 1.14 Version
        if($version == '1.13'){
            $setting = Setting::where('key', 'update_done')->first();
            if($setting && $setting->value == $version){
                
                // Save for next Update
                $setting->value = '1.2';
                $setting->save();

                $languages = Language::all();
                foreach($languages as $language){
                    $default = ($language->id == 1) ? 1 : 0;
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'account_updated',
                        'string' => 'Account successfully updated!',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'register_owner_directly',
                        'string' => 'Allow owners to be registered directly?',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'register_as_owner',
                        'string' => 'Register as an Owner?',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'success_close',
                        'string' => 'Successfully closed!',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'message_received',
                        'string' => 'Message Received',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'message_login_to_reply',
                        'string' => 'Login to your account so you can read and reply to this message.',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'success_message_sent',
                        'string' => 'You have sent your message!',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'message',
                        'string' => 'Message',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'messages',
                        'string' => 'Messages',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'message_threads',
                        'string' => 'Message Threads',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'back',
                        'string' => 'Back',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'between',
                        'string' => 'Between',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'reply',
                        'string' => 'Reply',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'created',
                        'string' => 'Created',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'updated',
                        'string' => 'Updated',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'message_close_confirm',
                        'string' => 'Are you sure you want to close this thread?',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'enable_messages',
                        'string' => 'Enable Messaging',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'open',
                        'string' => 'Open',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'closed',
                        'string' => 'Closed',
                    ]);
                }

                Setting::create([
                    'key' => 'register_owner_directly', 
                    'value' => '1',
                    'type' => 'owner',
                ]);

                Setting::create([
                    'key' => 'enable_messages', 
                    'value' => '1',
                    'type' => 'user',
                ]);


                // Update Database
                $sql = "INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (91, '2017_06_13_2044444_create_withdrawals_table', 44),(92, '2017_09_26_192142_create_message_threads_table', 44),(93, '2017_09_26_192159_create_messages_table', 44);CREATE TABLE `messages` (`id` int(10) UNSIGNED NOT NULL,`thread_id` int(11) NOT NULL,`user` int(11) NOT NULL DEFAULT '0',`message` text COLLATE utf8_unicode_ci,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;CREATE TABLE `message_threads` (`id` int(10) UNSIGNED NOT NULL,`status` int(11) NOT NULL DEFAULT '0',`closed` int(11) NOT NULL DEFAULT '0',`user_id` int(11) NOT NULL,`owner_id` int(11) NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;ALTER TABLE `messages`ADD PRIMARY KEY (`id`);ALTER TABLE `message_threads`ADD PRIMARY KEY (`id`);ALTER TABLE `messages`MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;ALTER TABLE `message_threads`MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;";
                DB::unprepared($sql);

                dd('Your version is successfully upgraded to 1.2! You can close this tab now. Enjoy :)');

            }else if($setting && $setting->value != $version){

                // If already updated to 1.13
                dd('Already Updated to 1.2');
            }else{

                // Update Database
                $sql = "INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (91, '2017_06_13_2044444_create_withdrawals_table', 44),(92, '2017_09_26_192142_create_message_threads_table', 44),(93, '2017_09_26_192159_create_messages_table', 44);CREATE TABLE `messages` (`id` int(10) UNSIGNED NOT NULL,`thread_id` int(11) NOT NULL,`user` int(11) NOT NULL DEFAULT '0',`message` text COLLATE utf8_unicode_ci,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;CREATE TABLE `message_threads` (`id` int(10) UNSIGNED NOT NULL,`status` int(11) NOT NULL DEFAULT '0',`closed` int(11) NOT NULL DEFAULT '0',`user_id` int(11) NOT NULL,`owner_id` int(11) NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;ALTER TABLE `messages`ADD PRIMARY KEY (`id`);ALTER TABLE `message_threads`ADD PRIMARY KEY (`id`);ALTER TABLE `messages`MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;ALTER TABLE `message_threads`MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;";
                DB::unprepared($sql);

                
                $languages = Language::all();
                foreach($languages as $language){
                    $default = ($language->id == 1) ? 1 : 0;
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'account_updated',
                        'string' => 'Account successfully updated!',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'register_owner_directly',
                        'string' => 'Allow owners to be registered directly?',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'register_as_owner',
                        'string' => 'Register as an Owner?',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'success_close',
                        'string' => 'Successfully closed!',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'message_received',
                        'string' => 'Message Received',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'message_login_to_reply',
                        'string' => 'Login to your account so you can read and reply to this message.',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'success_message_sent',
                        'string' => 'You have sent your message!',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'message',
                        'string' => 'Message',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'messages',
                        'string' => 'Messages',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'message_threads',
                        'string' => 'Message Threads',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'back',
                        'string' => 'Back',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'between',
                        'string' => 'Between',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'reply',
                        'string' => 'Reply',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'created',
                        'string' => 'Created',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'updated',
                        'string' => 'Updated',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'message_close_confirm',
                        'string' => 'Are you sure you want to close this thread?',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'enable_messages',
                        'string' => 'Enable Messaging',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'open',
                        'string' => 'Open',
                    ]);
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'closed',
                        'string' => 'Closed',
                    ]);
                }

                // If setting doesnt exist
                Setting::create([
                    'key' => 'update_done', 
                    'value' => '1.2',
                ]);
                Setting::create([
                    'key' => 'register_owner_directly', 
                    'value' => '1',
                    'type' => 'owner',
                ]);

                Setting::create([
                    'key' => 'enable_messages', 
                    'value' => '1',
                    'type' => 'user',
                ]);

                dd('Your version is successfully upgraded to 1.2! You can close this tab now. Enjoy :)');
            }
        }


        // 1.2 Version
        if($version == '1.2'){
            $setting = Setting::where('key', 'update_done')->first();
            if($setting && $setting->value == $version){
                
                // Save for next Update
                $setting->value = '1.21';
                $setting->save();

                $languages = Language::all();
                foreach($languages as $language){
                    $default = ($language->id == 1) ? 1 : 0;
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'write_your_message',
                        'string' => 'Write your message here.',
                    ]);
                }

                dd('Your version is successfully upgraded to 1.21! You can close this tab now. Enjoy :)');

            }else if($setting && $setting->value != $version){

                // If already updated to 1.13
                dd('Already Updated to 1.21');
            }else{

                foreach($languages as $language){
                    $default = ($language->id == 1) ? 1 : 0;
                    Str::create([
                        'default' => $default,
                        'code'  => $language->code, 
                        'is_backend' => 0,
                        'key' => 'write_your_message',
                        'string' => 'Write your message here.',
                    ]);
                }

                // If setting doesnt exist
                Setting::create([
                    'key' => 'update_done', 
                    'value' => '1.21',
                ]);

                dd('Your version is successfully upgraded to 1.21! You can close this tab now. Enjoy :)');
            }
        }

    }
}
