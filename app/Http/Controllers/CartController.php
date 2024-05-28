<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CartService;
use Session;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function index(Request $request){
    	$result = $this->cartService->create($request);
        if ($result === false) {
            return redirect()->back();
        }

        return redirect(url('carts/shop'));


    }
    public function show()
    {
        $products = $this->cartService->getProduct();

        return view('carts.list', [
            'title' => 'Giỏ Hàng',
            'products' => $products,
            'carts' => Session::get('tempProducts')
        ]);
    }
    public function update(Request $request)
    {
//        dd($request->all());
        $this->cartService->update($request);
        return redirect(url('carts/shop'));
    }
    public function remove($id = 0)
    {
        $this->cartService->remove($id);
        return redirect(url('carts/shop'));
    }
    public function addCart(Request $request)
    {
//        dd($request->input());
        $this->cartService->addCart($request);

        return redirect()->back();
    }

}
