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
use App\Models\Cart;

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
        $user=User::where('id', $userid)->first();
        // $data['product']=Cart::all();
        
        $detail['product']=Cart::select('products.*')
      ->join("products","cart.product_id", "=", "products.id")
      ->where("cart.user_id" ,  $userid)
      ->get();

        return view('product.cart', $detail)->with('user',$user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addtocart(Request $request)
    {
         // if($request->session()->has('user')){

            $obj = new Cart();
            $obj->user_id=Session::get('user_id');
            $obj->product_id=$request->product_id;
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
        return Cart::where('user_id', $user_Id)->count();
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=Cart::find($id);

        if($item->delete())
        {
          return response()->json([
            'success' => '1',
            'message'=>'Image deleted seccessfully!'
          ]);
        }else{
          return response()->json([
            'success' => '0',
            'message'=>'Something is wrong'
          ]);
        }
    
    }
}
