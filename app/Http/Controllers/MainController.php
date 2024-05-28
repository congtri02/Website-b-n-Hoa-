<?php

namespace App\Http\Controllers;

use App\Http\Services\New\NewService;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;


class MainController extends Controller
{
    protected $menu;
    protected $slider;
    protected $product;
    protected $new;

    public function __construct(MenuService $menu,NewService $new,SliderService $slider, ProductService $product)
    {
        $this->menu = $menu;
        $this->slider = $slider;
        $this->new = $new;
        $this->product = $product;

    }
    public function index(Request $request)
    {

        $products = $this->product->get();

        if(!empty($request->search)){
            $products = \App\Models\Product::where('name','like','%' .trim($request->search). '%')->get();
        }

        // echo count($products); exit;s

        return view('home',[
            'title'=>'shop bán hoa chuyên nghiệp',
            'menus'=> $this->menu->show(),
            'news'=>$this->new->show(),
            'sliders'=>$this->slider->show(),
            'products'=> $products
        ]);

    }
    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->product->get($page);
        if (count($result) != 0) {
            $html = view('products.list', ['products' => $result ])->render();

            return response()->json([ 'html' => $html ]);
        }

        return response()->json(['html' => '' ]);
    }
}
