<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return View
     */
    public function showDetail(int $id): View
    {
        return view('product.productdetail',["p"=>Product::query()->find($id)]);
    }


}
