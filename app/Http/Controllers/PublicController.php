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
}
