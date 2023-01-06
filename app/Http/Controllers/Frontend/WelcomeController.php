<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Catagory;

class WelcomeController extends Controller
{
    public function index()
    {

        //$specials= Catagory::with('menus')->get();
        $specialMenus=Menu::all();
        //return $specialMenus;

        return view('welcome',compact('specialMenus'));

    }

    public function thankYou(){
        return view('thankYou');
    }

}
