<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){

        $data['meta_title'] = 'Ecommerce - Home';
        $data['meta_keywords'] =  'Ecommerce - Home';
        $data['meta_description'] = 'Ecommerce - หน้าแรก';

        return view('home', $data);
    }
}
