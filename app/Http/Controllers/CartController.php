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

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid=Session::get('user_id');
        $data =DB::table('cart')
          ->join("products","cart.product_id", "=", "products.id")
          ->select('products.*', 'cart.id as cart_id')
          ->where("cart.user_id" ,  $userid)
          ->get();

          $total = DB::table('cart')
          ->join("products","cart.product_id", "=", "products.id")
          ->where("cart.user_id" ,  $userid)
          ->sum('products.product_price');
//dd($total);
          $detail['detail'] =Cart::first();
      return view('cart', ['products'=>$data], ['total'=>$total])->with('detail',$detail);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        $userid=Session::get('user_id');
        return DB::table('cart')
          ->join("products","cart.product_id", "=", "products.id")
          ->where("cart.user_id" ,  $userid)
          ->sum('products.product_price');

    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToOrder(Request $request)
    {
         // if($request->session()->has('user')){
        

            $obj = new Cart();
            $obj->user_id=Session::get('user_id');
            $obj->product_id=$request->product_id;
            $obj->quantity=1;
            //dd($obj);
            if($obj->save()){
              return Response::json(['success' => '1','message' => 'Product added to cart Successfully']);
            }else{
              return Response::json(['success' => '0','validation'=>'0','message' => 'Something is wrong. Please try again.']);
            }
               // }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    static function cartitem()
    {
        $user_Id=Session::get('user_id');
        return order::where('user_id', $user_Id)->count();
    }

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
    public function store(Request $request)
    {
            $obj = new order();
            $obj->user_id=Session::get('user_id');
            $obj->product_id=$request->product_id;
            $obj->totalprice=$request->totalprice;
// dd($obj)
            if($obj->save()){
              return Response::json(['success' => '1','message' => 'Cart updated Successfully']);
            }else{
              return Response::json(['success' => '0','validation'=>'0','message' => 'Something is wrong. Please try again.']);
            }
    }

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
