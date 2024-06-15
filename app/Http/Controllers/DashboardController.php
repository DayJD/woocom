<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = 'Dashboard';
      
   
        return view('shop_manager.dashboard' ,$data);
    }
}
