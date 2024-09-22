<?php

namespace App\Http\Controllers\AdminArea;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends ParentController
{    
    /**
     * Index
     * load the admin dashboard section
     *
     * @return void 
     */
    public function index()
    {
        return Inertia::render('AdminArea/Dashboard/index');
    }

}
