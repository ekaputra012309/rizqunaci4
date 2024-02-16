<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function login(): string
    {
        $pageTitle = 'Login - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page/login', $data);
    }

    public function dashboard()
    {
        $authorizationHeader = $this->request->getHeaderLine('Authorization');
        $pageTitle = 'Dashboard - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        echo $authorizationHeader;
        // return view('page/dashboard', $data);
    }

    public function agent(): string
    {
        return view('page/agent/agent');
    }

    public function hotel(): string
    {
        $pageTitle = 'Hotel - PT RIZQUNA MEKAH MADINAH';
        $data = array(
            'pageTitle' => $pageTitle,
        );
        return view('page/hotel/hotel', $data);
    }

    public function room(): string
    {
        return view('page/room/room');
    }

    public function rekening(): string
    {
        return view('page/rekening/rekening');
    }

    public function booking(): string
    {
        return view('page/booking/booking');
    }

    public function payment(): string
    {
        return view('page/payment/payment');
    }
}
