<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Validator,Redirect,Response,File;
use Session;
use DB;
use Input;
use Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index()
    // {
    //     $userid=Session::get('user_id');
    //     $data =DB::table('cart')
    //       ->join("products","cart.product_id", "=", "products.id")
    //       ->select('products.*', 'cart.id as cart_id')
    //       ->where("cart.user_id" ,  $userid)
    //       ->get();

    //       $total = DB::table('cart')
    //       ->join("products","cart.product_id", "=", "products.id")
    //       ->where("cart.user_id" ,  $userid)
    //       ->sum('products.product_price');

    //       $detail['detail'] =Cart::first();
    //   return view('cart', ['products'=>$data], ['total'=>$total])->with('detail',$detail);
    // }

    public function addToOrder(Request $request)
    {   $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        if(!Session::has('cart')){
            return redirect()->route('products');
        }
            $order = new Order();
            $order->user_id=Auth::id();
            $order->totalprice=$request->total;
            
            if($order->save()){
       
                foreach (session('cart') as $product) {
                $orderItem = new OrderItem();
                $orderItem->product_id=$product['id'];
                $orderItem->quantity=$product['quantity'];
                $orderItem->order_id=$order->id;
                $orderItem->price=$product['price'];
                $orderItem->save();
                
                }
                $cart = session()->forget('cart');
                session()->put('cart', $cart);

                return Response::json(['success' => '1','message' => 'Order added Successfully']);

            }else{
              return Response::json(['success' => '0','validation'=>'0','message' => 'Something is wrong. Please try again.']);
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        if (Auth::check()) {
            $order = Order::where('user_id', Auth::id())->get();   
            return view('orders', compact('order'));
        }else{
            return redirect()->route('/login');
        }
        
        
            
    }
    public function orderitems($id)
    {
         $orderitem = orderitem::where('order_id','=', $id)->get(); 
        return view('orderitems', compact('orderitem'));
            
    }

    // public function addorderitem(Request $request)
    // {

    //     $order_id=DB::getPdo()->lastInsertId();
    //     if(session('cart')){
    //         //dd(session('cart'));
    //         foreach (session('cart') as $product) {
    //             $obj = new OrderItem();
    //             $obj->product_id=$product['id'];
    //             $obj->quantity=$product['quantity'];
    //             $obj->order_id=$order_id;
    //             $obj->price=$product['price'];
    //             $obj->save();
    //        } dd($obj);

    //        if($obj->save()){
    //         $cart = session()->forget('cart');

    //         session()->put('cart', $cart);
    //         return redirect()->route('products');
    //         

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::destroy($id);
        return redirect('/cart');
    
    }
}
