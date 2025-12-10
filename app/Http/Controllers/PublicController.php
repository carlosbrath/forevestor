<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\ApplicantEducation;
use App\Models\Branch;
use App\Models\BusinessCategory;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function __construct()
    {
        
    }
    function home()
    {
        $title = 'Home';
        return view('public.home', compact('title'));
    }

    function about()
    {
        $title = 'About Us';
        return view('public.about', compact('title'));
    }

    function plans()
    {
        $title = 'Investment Plans';
        return view('public.plans', compact('title'));
    }

    function help()
    {
        $title = 'Help & Support';
        return view('public.help', compact('title'));
    }

    function privacy()
    {
        $title = 'Privacy Policy';
        return view('public.privacy', compact('title'));
    }

    function buyUsdt()
    {
        $title = 'Buy USDT';

        // Dummy data for USDT packages
        $packages = [
            [
                'name' => 'Starter Package',
                'usdt_amount' => 100,
                'inr_amount' => 8450,
                'bonus' => 0,
                'features' => [
                    'Instant delivery',
                    '0% transaction fee',
                    'Email support',
                    'Secure transfer'
                ]
            ],
            [
                'name' => 'Standard Package',
                'usdt_amount' => 500,
                'inr_amount' => 42250,
                'bonus' => 5,
                'features' => [
                    'Priority delivery',
                    '0% transaction fee',
                    'Priority support',
                    'Bonus: 5 USDT extra'
                ],
                'popular' => true
            ],
            [
                'name' => 'Premium Package',
                'usdt_amount' => 1000,
                'inr_amount' => 84500,
                'bonus' => 15,
                'features' => [
                    'Instant delivery',
                    '0% transaction fee',
                    'VIP support 24/7',
                    'Bonus: 15 USDT extra'
                ]
            ]
        ];

        $currentRate = 84.50; // 1 USDT = ₹84.50

        return view('public.buyusdt', compact('title', 'packages', 'currentRate'));
    }



}