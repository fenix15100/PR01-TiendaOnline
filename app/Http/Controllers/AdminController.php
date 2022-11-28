<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {

        return view('admin.admin',
            [
                "categorias"=>Category::paginate($perPage = 2, $columns = ['*'], $pageName = 'category'),
                "productos"=>Product::paginate($perPage = 2, $columns = ['*'], $pageName = 'product'),
                "clientes"=>Customer::paginate($perPage = 2, $columns = ['*'], $pageName = 'customer')

            ]);
    }

}
