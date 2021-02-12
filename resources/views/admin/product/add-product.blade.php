<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="addProductForm" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="product_status">Category</label>
                        <select class="form-control" name="cat_id" id="product_cat">
                            <option value="">Select Category</option>
                            @foreach($category as $categories)
                                <option value="{{$categories->id}}">{{$categories->cat_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter product Name" required>
                    </div>
                    <div class="form-group">
                        <label for="short_desc">Short Description</label>
                        <textarea class="form-control" name="short_desc" id="short_desc" placeholder="Enter Product Short Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="long_desc">Long Description</label>
                        <textarea class="form-control" name="long_desc" id="long_desc" placeholder="Enter Product Long Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="discount_price">Discount Price</label>
                        {{--<input type="text" name="discount_price" class="form-control" id="discount_price" placeholder="Enter Discount Price">--}}
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">&pound</div>
                            </div>
                            <input type="text" class="form-control" name="discount_price" id="discount_price" placeholder="Discount price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="product_price">Product Price</label>
                        {{--<input type="text" name="product_price" class="form-control" id="product_price" placeholder="Enter Product Price">--}}
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">&pound</div>
                            </div>
                            <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Product price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Enter Total quantity">
                    </div>
                    <div class="form-group">
                        <label for="product_size">Size</label>
                        <select class="form-control" name="size" id="product_size">
                            <option value="">Select size</option>
                            <option value="s">S</option>
                            <option value="m">M</option>
                            <option value="l">L</option>
                            <option value="xl">XL</option>
                            <option value="xxl">XXL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="filePhoto">Product Image</label>
                        <input type="file" name="product_image" class="form-control-file" id="filePhoto4" onchange="preview_image(event)">
                        <img src="" id="previewHolder" width="150px">
                    </div>
                    <div class="form-group">
                        <label for="filePhoto">Gallery Image</label>
                        <input type="file" name="gallery_image[]" class="form-control-file" id="filePhoto3" multiple>
                    </div>
                    <div class="form-group">
                        <label for="product_status">Publication Status</label>
                        <select class="form-control" name="status" id="product_status">
                            <option value="1">Published</option>
                            <option value="0">Unpublished</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_name">Add Attribute</label>
                        <span style="padding-right:10px">Yes</span><input type="radio" onclick="updateStatus()" name="add_attribute" class="radio-inline" id="add_attribute" placeholder="Enter product attribute" required value="1">
                        <span style="padding-right:10px">No</span><input type="radio" name="add_attribute" onclick="updateStatus()" class="radio-inline" id="add_attribute" placeholder="Enter product attribute" required value="0">
                    </div>
                    <div class="form-group" id="attr_val">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function updateStatus(){
    status = document.querySelector('input[name="add_attribute"]:checked').value;

    if(status ==1)
    {
        html = '<label for="product_name">Attribute Name/Value</label>';
        html+='<input type="text"  name="attribute_name" class="form-control" id="attribute_name" placeholder="Enter Attribute Name">';
        html+='<div id="field_wrapper"><input type="text" name="attribute_value[]" value=""/>';
        html+='<a href="javascript:void(0);" onclick="addMore()" class="add_button" title="Add field"><img src="/images/add-icon.png"/></a></div>';
        $("#attr_val").html(html);
    }
    else
    {
        $("#attr_val").html('');
    }
}

    var maxField = 10; //Input fields increment limitation
   
    var fieldHTML = '<div><input type="text" name="attribute_value[]" value=""/><a href="javascript:void(0);" onclick="remove(this)" class="remove_button" onclick="addMore()"><img src="/images/remove-icon.png"/></a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
   function addMore(){
        
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $("#field_wrapper").append(fieldHTML); //Add field html
        }
    }

    //Once remove button is clicked
    function remove(element){
        // e.preventDefault();
        element.parentNode.remove(); //Remove field html
        x--; //Decrement field counter
    }

</script>


</script>
