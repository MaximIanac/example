<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stevebauman\Location\Facades\Location;

class LocationController extends Controller
{
    public function __invoke(Request $request)
    {
        $userIp = $request->ip();

        // $userIp = $_SERVER['REMOTE_ADDR'];

        // $userIp = '66.102.0.0';

        $location = Location::get($userIp);

        $this->writeToLog($location, 'Локация');

        return;
    }

    public function writeToLog($data, $title = '')
    {
        $log = "\n------------------------\n";
        $log .= date("Y.m.d G:i:s") . "\n";
        $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
        $log .= print_r($data, 1);
        $log .= "\n------------------------\n";
        Log::channel('checkDataFromB24')->info('Полученные данные: ' . $log);
        return true;
    }
}
