<?php

namespace App\Http\Controllers\Api;


use App\AboutApp;
use App\Http\Controllers\Controller;

use App\Q_A;
use App\TermsCondition;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    //
    public function about(){
        $about = AboutApp::find(1)->about;
        return ApiController::respondWithSuccess($about);
    }

    public function terms(){
        $terms = TermsCondition::find(1)->terms;
        return ApiController::respondWithSuccess($terms);
    }

    public function q_a(){
        $faq = Q_A::find(1);
        $q_a = unserialize($faq->q_a);
        return ApiController::respondWithSuccess($q_a);
    }


}
