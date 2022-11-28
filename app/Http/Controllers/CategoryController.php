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
        if ($category = Category::query()->find($id)){
            return new JsonResponse($category,200);
        }else{
            return new JsonResponse($category,404);
        }

    }

    public function getProductsByCategory(int $id):view
    {
        /** @var Category $category */
        $category = Category::query()->find($id);

        return view('product.productItem',["products" => $category->products()]);
    }

    public function create(Request $request): JsonResponse
    {
        $category = new Category();
        $category->fill($request->all())->save();
        return new JsonResponse($category,201);
    }
    public function update(Request $request,int $id): JsonResponse
    {
        $category = Category::query()->find($id);
        $category->update($request->all());
        return new JsonResponse($category,200);
    }


    public function delete(int $id): JsonResponse
    {
        $result = Category::destroy($id);
        if ($result){
            return new JsonResponse(
                ["message"=>"Categoria Eliminada",
                 "id"=>$id
                ],200);
        }else{
            return new JsonResponse(["message"=>"No se pudo eliminar la categoria"],500);
        }

    }
}
