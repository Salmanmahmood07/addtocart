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
use App\Models\User;

class AdminController extends Controller
{
  public function adminlogin()
  {
      return view('admin.login');
  }

  public function admin_authenticate(Request $request)
    {
        $messages=array(
        'email.required'=>'This field is required',
        'email.email'=>'Invalid Email',
        'password.password'=>'This field is required'
      );
      $rules=array(
        'email'=>'required|email',
        'password'=>'required|min:5|max:18'
      );
      $validator=\Validator::make($request->all(),$rules,$messages);
      if ($validator->fails())
      {
      return back()->withErrors($validator)->withInput();
    }else {
      $data = User::where('email','=',$request->email)->first();
      if($data){
        if(\Hash::check($request->password, $data->password))
        {
          if($data->type=='Admin'){

         Auth::attempt(['email' => $request->email, 'password' => $request->password]);
         Session::put('admin_id', $data->id);
         Session::put('admin_name', $data->name);
         Session::put('email', $data->email);
         //dd($data);
          return redirect('/admin/addproduct');
          }
       }
       else {
             Session::flash('login_feedback', 'Invalid User.');
             return back()->withErrors($validator)->withInput();
           }
     }else
     {
       Session::flash('login_feedback', 'Provided credentials are incorrect. Please try again');
       return back()->withErrors($validator)->withInput();
     }
    }
    }
    // public function adminlogout()
    // {
    //     Auth::logout();
    //     return redirect('/login');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addproduct()
    {
      // if (Auth::check()) {
      // $value=Auth::id();
      // $admin=User::where('id', $value)->first();
        return view('admin.addproduct');
    
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
        
        $obj = new Product();
        $obj->product_name=$request->product_name;
        $obj->product_description=$request->product_description;
        $obj->product_price=$request->product_price;
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
