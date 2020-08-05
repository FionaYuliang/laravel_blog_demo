<?php


namespace App\Admin\Controllers;

use phpDocumentor\Reflection\Types\True_;

class HomeController extends Controller
{


    public function index()
    {
        return view('admin/home/index');

    }

}
