<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    //
    public function home(){
        return "主页";
    }

    public function about(){

        return "关于页";
    }
    public function help(){
        return '帮助页';
        }
}
