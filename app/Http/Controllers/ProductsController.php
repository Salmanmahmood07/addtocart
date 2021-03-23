<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class ProductsController extends Controller
{
    // static function cartitem()
    // {
    //     if(Session::has('cart'))
    //     $cart = Session::get('cart')->count();
    //     return  $cart;
    // }
    
    public function cart()
    {
        return view('newcart');
    }

    public function addToCart(Product $product)
    {
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [$product->id => $this->sessionData($product)];
            return $this->setSessionAndReturnResponse($cart);
        }
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
            return $this->setSessionAndReturnResponse($cart);
        }
        $cart[$product->id] = $this->sessionData($product);
        return $this->setSessionAndReturnResponse($cart);

    }

    public function changeQty(Request $request, Product $product)
    {
        $cart = session()->get('cart');
        if ($request->change_to === 'down') {
            if (isset($cart[$product->id])) {
                if ($cart[$product->id]['quantity'] > 1) {
                    $cart[$product->id]['quantity']--;
                    return $this->setSessionAndReturnResponse($cart);
                } else {
                    return $this->removeFromCart($product->id);
                }
            }
        } else {
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity']++;
                return $this->setSessionAndReturnResponse($cart);
            }
        }

        return back();
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', "Removed from Cart");
    }
     public function emptyCart()
    {
        $cart = session()->forget('cart');

            session()->put('cart', $cart);
        
        return redirect()->back()->with('success', "Cart empty Now");
    }

    protected function sessionData(Product $product)
    {
        return [
            'id' => $product->id,
            'name' => $product->product_name,
            'quantity' => 1,
            'price' => $product->product_price,
            'image' => $product->image
        ];
    }

    protected function setSessionAndReturnResponse($cart)
    {
        session()->put('cart', $cart);
        return redirect()->route('cart')->with('success', "Added to Cart");
    }
}
