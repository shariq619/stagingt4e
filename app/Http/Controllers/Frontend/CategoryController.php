<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function firstAidTraining(){
        return view('frontend.categories.first-aid-training');
    }

    public function personalLicence(){
        return view('frontend.categories.personal-licence');
    }

    public function constructionRraining(){
        return view('frontend.categories.construction-training');
    }

    public function trafficMarshalVb(){
        return view('frontend.categories.traffic-marshal-vb');
    }
}
