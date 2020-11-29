<?php

namespace Froiden\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Froiden\LaravelInstaller\Helpers\InstalledFileManager;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FinalController extends Controller
{
    /**
     * @var string
     */
    private $envPath;

    /**
     * @var string
     */
    private $envExamplePath;

    /**
     * Set the .env and .env.example paths.
     */
    public function __construct()
    {
        $this->envPath = base_path('.env');
        $this->envExamplePath = base_path('.env.example');
    }

    /**
     * Get the content of the .env file.
     *
     * @return string
     */
    public function getEnvContent()
    {
        if (!file_exists($this->envPath)) {
            if (file_exists($this->envExamplePath)) {
                copy($this->envExamplePath, $this->envPath);
            } else {
                touch($this->envPath);
            }
        }

        return file_get_contents($this->envPath);
    }

    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @return \Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager)
    {
        $fileManager->update();
        $this->saveFile();
        getAwesomeData();
        return view('vendor.installer.finished');
    }

    /**
     * Save the edited content to the file.
     *
     * @param Request $input
     * @return string
     */
    public function saveFile()
    {

        $message = trans('messages.environment.success');

        $env = $this->getEnvContent();
        $databaseSetting = '
SESSION_DRIVER=database
INSTALLED=true';

        // @ignoreCodingStandard
        $rows       = explode("\n", $env);
        $unwanted   = "SESSION_DRIVER|INSTALLED";
        $cleanArray = preg_grep("/$unwanted/i", $rows, PREG_GREP_INVERT);
        $cleanString = implode("\n", $cleanArray);
        $env = $cleanString.$databaseSetting;
        try{
            file_put_contents($this->envPath, $env);
        }catch (Exception $e) {
            $message = trans('messages.environment.errors');
        }
        return;
    }
}
