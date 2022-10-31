<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TokenController extends Controller
{
    public function getHeaderAuth()
    {
        Log::debug('TOKEN');
        Log::debug(Session::get('credentials'));
        $head = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '. $this->getCredentials()['access_token']
        ];
        return $head;
    }

    public function getCredentials()
    {
        return Session::get('credentials');
    }

    public function setCredentials($credentials)
    {
        Session::put('credentials', $credentials);
    }
}
