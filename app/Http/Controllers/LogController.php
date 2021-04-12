<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Response;

class LogController extends Controller
{

    private $LogFilePath;

    public function __construct()
    {
        $this->LogFilePath = storage_path() ."/logs/laravel.log";
    }

    public function downloadLogFile()
    {
        try {
            $response = Response::download($this->LogFilePath);
            ob_end_clean();
            return $response;
        }
        catch (\Exception $e)
        {
            return response("Error");
        }
    }

    public function eraseLogFile()
    {
        try {
            File::delete($this->LogFilePath);
            return response("Success");
        }
        catch (\Exception $e)
        {
            return response("Error");
        }
    }

    public function viewLogFile()
    {
        try {
            foreach(file($this->LogFilePath) as $line) {
                echo($line."<br/>");
            }
        }
        catch (\Exception $e)
        {
            return response("Error");
        }
    }
}
