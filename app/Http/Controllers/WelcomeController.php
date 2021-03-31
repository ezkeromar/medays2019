<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Traits\CaptureIpTrait;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return redirect('login');
        // return view('welcome');
    }

    public function createDummyUser () {
        $ipAddress = new CaptureIpTrait();
        $user = User::create([
            'name'             => 'Omar EZKER',
            'first_name'       => 'Omar',
            'last_name'        => 'EZKER',
            'email'            => 'ezkeromar@gmail.com',
            'password'         => bcrypt('123456'),
            'token'            => str_random(64),
            'admin_ip_address' => $ipAddress->getClientIp(),
            'activated'        => 1,
        ]);
    }
}
