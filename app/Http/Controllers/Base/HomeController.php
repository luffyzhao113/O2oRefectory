<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2018/9/26
 * Time: 17:45
 */

namespace App\Http\Controllers\Base;


use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function base()
    {
        return view('base');
    }
}