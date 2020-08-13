<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use App\Post;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\True_;

class RoleController extends Controller
{


    public  function index()
    {


        return view('admin/roles/index');
    }

}
