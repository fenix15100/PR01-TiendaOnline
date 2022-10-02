<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        return new JsonResponse(Category::all(),200);
    }

    public function get( int $id): JsonResponse
    {
        return new JsonResponse(Category::find($id),200);
    }

    public function getProductsByCategory( int $id): view
    {
        return view('product.productItem',["products" => Category::find($id)->products()]);
    }

    public function create(Request $request): JsonResponse
    {
        $category = new Category();
        $category->fill($request->all())->save();
        $category = Category::find($category->id);
        return new JsonResponse($category,201);
    }
    public function update(Request $request,int $id): JsonResponse
    {
        $category = Category::find($id);
        $category->update($request->all());
        return new JsonResponse($category,200);
    }
}
