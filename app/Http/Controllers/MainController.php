<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class MainController extends Controller
{
    /**
     * Создание нового экземпляра контроллера.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Отображение товара на главной странице.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View - The view for the main page
     */
    public function index1()
    {
        $products = Product::orderBy('created_at')->take(50)->get();
        
        return view('index',[
            'products' => $products
        ]);
    }

    /**
     * Отображение категорий.
     *
     * @param string $cat_alias - The alias of the category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View - The view for the category
     */
    public function showCategory($cat_alias){
        $cat = Category::where('alias',$cat_alias)->first();

        return view('categories.index',[
            'cat' => $cat
        ]);
    }
  
}