<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Validator,Redirect,Response,File;
use Session;
use DB;
use Input;
use Auth;
use Image;
use App\Models\Product;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product()
    {
        return view('addproduct');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         request()->validate([
        'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $obj = new Product();
        $obj->product_name=$request->product_name;
        $obj->product_description=$request->product_description;
        $obj->product_price=$request->product_price;
        $image=$request->images;
            if(!empty($image))
         {
         $destinationPath =public_path().'/home_assets/images/';
         if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
        }
            $filename           = time().$image->getClientOriginalName();

         $image->move($destinationPath, $filename);
         $img = Image::make($destinationPath.$filename);
         $img->resize(250, 250,
        function ($constraint) {
          $constraint->aspectRatio();
        });
        if (!file_exists($destinationPath.'thumb/')) {
          mkdir($destinationPath.'thumb/', 0777, true);
        }
        $img->save($destinationPath.'/thumb/'.$filename);
        $obj->image=$filename;

        if($obj->save()){
            return Response::json(['success' => '1','message' => 'Product added successfully']);

          }
          else {
            return Response::json(['success' => '0','validation'=>'0','message' => 'Something is wrong. Please try again.']);

        }
    }
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showproduct(Request $request)
    {
        $data['products']=Product::all();
        return view('getallproducts',$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editproduct($id)
    {
        $data['product']=Product::find($id);
        return view('editproduct',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        
    public function updateproduct(Request $request)
    {
       
            $id=$request->id;
            $image=$request->images;
            if(!empty($image))
            {
          @unlink(public_path().'/home_assets/images/'.$obj->image);
          @unlink(public_path().'/home_assets/images/thumb/'.$obj->image);
           }
            if(!empty($image))
             {
                $destinationPath =public_path().'/home_assets/images/';
                if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
                }
                $filename = time().$image->getClientOriginalName();
       
                $image->move($destinationPath, $filename);
                $img = Image::make($destinationPath.$filename);
                $img->resize(250, 250,
                function ($constraint) {
                $constraint->aspectRatio();
                });
                if (!file_exists($destinationPath.'thumb/')) {
                mkdir($destinationPath.'thumb/', 0777, true);
                }
                $img->save($destinationPath.'/thumb/'.$filename);
            
            } //dd($filename);
            $obj =Product::find($id);
            $obj->image=$filename;
            $obj->product_name=$request->product_name;
            $obj->product_description=$request->product_description;
            $obj->product_price=$request->product_price;
    
            if($obj->save()){
                return Response::json(['success' => '1','message' => 'Product Updated successfully']);
    
              }
              else {
                return Response::json(['success' => '0','validation'=>'0','message' => 'Something is wrong. Please try again.']);
    
            }
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
    public function destroy($id){
        $file = Product::find($id);
              @unlink(public_path().'/home_assets/images/'.$file->image);
              @unlink(public_path().'/home_assets/images/thumb/'.$file->image);
              if($file->delete()){
                return response()->json([
                    'success' => '1',
                    'message'=>'Product deleted seccessfully!'
                  ]);
             }
             else{
               return response()->json([
                   'success' => '0',
                   'message'=>'Something is wrong'
                 ]);
            }
    
      }
}
