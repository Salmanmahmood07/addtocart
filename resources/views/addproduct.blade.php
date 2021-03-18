@extends('layouts.app')
@section('content')

<form class="form-horizontal"  id="product-form" >
  {!! csrf_field() !!}
<fieldset>

<!-- Form Name -->
<legend>PRODUCTS</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>  
  <div class="col-md-4">
  <input id="product_name" name="product_name" placeholder="NAME" class="form-control input-md" required="" type="text" value="{{old('product_name')}}">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="product_name_fr">PRODUCT DESCRIPTION FR</label>  
  <div class="col-md-4">
  <input id="product_name_fr" name="product_description" placeholder="DESCRIPTION" class="form-control input-md" required="" type="text" value="{{old('product_description')}}">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="product_price">PRODUCT PRICE</label>  
  <div class="col-md-4">
  <input id="product_name_fr" name="product_price" placeholder="PRICE" class="form-control input-md" required="" type="text" value="{{old('product_price')}}">
    
  </div>
</div>

 <!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton">Select image</label>
  <div class="col-md-4">
     <input type="file" name="images" value="{{old('images')}}" class="form-control"  required onchange="readURL(this);" >
    <img id="blah" src="#" height="100" width="100" style="border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 150px;"  alt="Your selected image..." />
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton"></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-primary">Add Product</button>
    <a class="btn btn-primary" href="{{route('showproduct')}}">Get All Products</a>
  </div>
  </div>

</fieldset>
</form>
<script src="{{url('/home_assets')}}/js/bootbox.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
                function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#blah')
                            .attr('src', e.target.result)
                            .width(150)
                            .height(200);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
            jQuery(document).ready(function(){
                jQuery('#product-form').submit(function(e){
                  e.preventDefault();
                  $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                  });
                  var myForm = document.getElementById('product-form');
                  var formData = new FormData(myForm);
                    jQuery.ajax({
                      url: "{{ url('/createproduct') }}",
                      method : 'post',
                      data: formData,
                      contentType: false,
                       cache: false,
                       processData: false,
                      success: function(result){
                        if(result.success == 0){
                          console.log(result);
                                  bootbox.alert({
                        title: "Message",
                        message:result.message,
                        callback: function(){
                            
                          }
                      });
                        }
                        else{
                          bootbox.alert({
                title: "Message",
                message:result.message,
                callback: function(){
                   //$(location).attr('href', '/tutor');
                }
              });
                        }
                      }});
                  });
              });

            </script>

<!-- Select Basic -->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="product_categorie">PRODUCT CATEGORY</label>
  <div class="col-md-4">
    <select id="product_categorie" name="product_categorie" class="form-control">
    </select>
  </div>
</div> -->

<!-- Text input-->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="available_quantity">AVAILABLE QUANTITY</label>  
  <div class="col-md-4">
  <input id="available_quantity" name="available_quantity" placeholder="AVAILABLE QUANTITY" class="form-control input-md" required="" type="text">
    
  </div>
</div> -->

<!-- Text input-->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="product_weight">PRODUCT WEIGHT</label>  
  <div class="col-md-4">
  <input id="product_weight" name="product_weight" placeholder="PRODUCT WEIGHT" class="form-control input-md" required="" type="text">
    
  </div>
</div> -->

<!-- Textarea -->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="product_description">PRODUCT DESCRIPTION</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="product_description" name="product_description"></textarea>
  </div>
</div> -->

<!-- Textarea -->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="product_name_fr">PRODUCT DESCRIPTION FR</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="product_name_fr" name="product_name_fr"></textarea>
  </div>
</div> -->

<!-- Text input-->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="percentage_discount">PERCENTAGE DISCOUNT</label>  
  <div class="col-md-4">
  <input id="percentage_discount" name="percentage_discount" placeholder="PERCENTAGE DISCOUNT" class="form-control input-md" required="" type="text">
    
  </div>
</div>
 -->
<!-- Text input-->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="stock_alert">STOCK ALERT</label>  
  <div class="col-md-4">
  <input id="stock_alert" name="stock_alert" placeholder="STOCK ALERT" class="form-control input-md" required="" type="text">
    
  </div>
</div> -->

<!-- Search input-->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="stock_critical">STOCK CRITICAL</label>
  <div class="col-md-4">
    <input id="stock_critical" name="stock_critical" placeholder="STOCK CRITICAL" class="form-control input-md" required="" type="search">
    
  </div>
</div> -->

<!-- Search input-->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="tutorial">TUTORIAL</label>
  <div class="col-md-4">
    <input id="tutorial" name="tutorial" placeholder="TUTORIAL" class="form-control input-md" required="" type="search">
    
  </div>
</div> -->
@endsection