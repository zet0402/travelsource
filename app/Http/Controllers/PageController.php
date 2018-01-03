<?php

namespace App\Http\Controllers;

use APP\Slide;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex(){
    	return view('page.trangchu');
    }
    public function getContactus(){
    	return view('page.contact_us');
    }
    public function getAbout(){
    	return view('page.about');
    }
     public function getPage404(){
    	return view('page.404');
    }
}
