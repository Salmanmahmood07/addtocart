@extends('layouts.app')
@section('content')

<form class="form-horizontal"  id="product-form">
{!! csrf_field() !!}
  <input id="id" name="id" placeholder="NAME" class="form-control input-md" required="" type="hidden" value="{{$product->id}}">
<fieldset>

<!-- Form Name -->
<legend>PRODUCTS</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>  
  <div class="col-md-4">
  <input id="product_name" name="product_name" placeholder="NAME" class="form-control input-md" required="" type="text" value="{{$product->product_name}}">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="product_name_fr">PRODUCT DESCRIPTION FR</label>  
  <div class="col-md-4">
  <input id="product_name_fr" name="product_description" placeholder="DESCRIPTION" class="form-control input-md" required="" type="text" value="{{$product->product_description}}">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="product_price">PRODUCT PRICE</label>  
  <div class="col-md-4">
  <input id="product_name_fr" name="product_price" placeholder="PRICE" class="form-control input-md" required="" type="text" value="{{$product->product_price}}">
    
  </div>
</div>

 <!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton">Select image</label>
  <div class="col-md-4">
     <input type="file" name="images" value="{{old('images')}}" class="form-control"  required onchange="readURL(this);" >
    <img id="blah" src="{{url('/home_assets/images/')}}/{{$product->image}}" height="100" width="100" style="border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 150px;"  alt="Your selected image..." />
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton"></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-primary">Update Product</button>
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
                      url: "{{ url('/updateproduct') }}",
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

@endsection