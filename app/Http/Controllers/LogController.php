<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class LogController extends Controller
{
    private $LogFilePath;

    public function __construct()
    {
        $this->LogFilePath = storage_path() ."/logs/";
    }

    public function downloadLogFile($year, $month, $date)
    {
        $file_name = "laravel-".$year."-".$month."-".$date.".log";
        try {
            $response = Response::download($this->LogFilePath.$file_name);
            ob_end_clean();
            return $response;
        }
        catch (\Exception $e)
        {
            return response("Error");
        }
    }

    public function eraseLogFile($year, $month, $date)
    {
        $file_name = "laravel-".$year."-".$month."-".$date.".log";
        try {
            File::delete($this->LogFilePath.$file_name);
            return response("Success");
        }
        catch (\Exception $e)
        {
            return response("Error");
        }
    }

    public function viewLogFile($year, $month, $date)
    {
        $file_name = "laravel-".$year."-".$month."-".$date.".log";
        try {
            foreach(file($this->LogFilePath.$file_name) as $line) {
                echo($line."<br/>");
            }
        }
        catch (\Exception $e)
        {
            return response("Error");
        }
    }
}
