<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesControler extends Controller
{
    public function index(){
    	return view('Pages.index');
    }

public function about(){
    	return view('Pages.about');
    }
    public function Services(){
    	return view('Pages.services');
    }


}
