<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $p1 = new \stdClass();
        $p1->title = "Producto 1";
        $p1->price = "60$";
        $p2 = new \stdClass();
        $p2->title = "Producto 2";
        $p2->price = "40$";
        return view('home.home',["product"=>[$p1,$p2]]);
    }
}
