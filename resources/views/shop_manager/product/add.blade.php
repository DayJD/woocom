@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">Add Product</h3>
                    </div>
                    @include('_message')
                    
                    <form method="POST" action="">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product Name <span style="color: red;font-size: 18px"> *</span></label>
                                        <input type="text" name="title" value="{{ old('title') }}" required
                                            class="form-control" placeholder="Enter Product Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>SUK <span style="color: red;font-size: 18px"> *</span></label>
                                        <input type="text" name="suk" value="{{ old('suk') }}" required
                                            class="form-control" placeholder="Enter SUK">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category <span style="color: red;font-size: 18px"> *</span></label>
                                        <select class="form-control" name="category_id" id="ChangeCategory" required>
                                            <option value="">Select Category</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Subcategory <span style="color: red;font-size: 18px"> *</span></label>
                                        <select class="form-control" name="sub_category_id" id="getSubCategory" required>
                                            <option value="">Select SubCategory</option>
                        
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tags <span style="color: red;font-size: 18px"> *</span></label>
                                        <select class="form-control" name="category_id" id="ChangeCategory" required>
                                            <option value="">Select Category</option>
                                           
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Price(฿) <span style="color: red;font-size: 18px"> *</span></label>
                                        <input type="text" name="price" class="form-control" placeholder="Enter Price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Old Price <span style="color: red;font-size: 18px"> *</span></label>
                                        <input type="text" name="old_price" required class="form-control"
                                            placeholder="Enter Old Price ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Short Description <span style="color: red;font-size: 18px"> *</span></label>
                                        <textarea class="form-control editor" name="short_description" placeholder="Short Description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Description <span style="color: red;font-size: 18px"> *</span></label>
                                    <textarea class="form-control editor"name="description" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>image</label>
                                    <input type="file" name="image[]" multiple style="padding: 5px;" class="form-control"
                                        accept="image/*">
                                </div>
                            </div>


                            <style>

                            </style>
                            <hr>
                            <div class="form-group">
                                <label>Status <span style="color: red;font-size: 18px"> *</span></label>
                                <select class="form-control" name="status" required>
                                    <option {{ old('status') == 0 ? 'selected' : '' }} value="0">
                                        Active</option>
                                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">
                                        Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script src="{{ url('public/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $('.editor').summernote({
            tabsize: 2,
            height: 150,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        var i = 101;
        $('body').on('click', '.AddSize', function(e) {
            var html = `
            <tr id="DeleteSize${i}"> 
                <td><input type="text" name="size[${i}][name]"  placeholder="Name"  class="form-control"></td> 
                <td><input type="text" name="size[${i}][price]"  placeholder="Price" class="form-control"></td> 
                <td> 
                    <button type="button" id="${i}" class="btn btn-danger DeleteSize">Delete</button> 
                </td> 
            </tr>`;
            i++;
            $('#AppendSize').append(html);
        });

        $('body').on('click', '.DeleteSize', function(e) {
            var id = $(this).attr('id');
            $('#DeleteSize' + id).remove();
        });


        $('body').on('change', '#ChangeCategory', function(e) {
            var id = $(this).val()
            console.log(id);
            $.ajax({
                url: "{{ url('admin/get_sub_categroy') }}",
                type: "POST",
                dataType: 'json',
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    $('#getSubCategory').html(data.html);
                },
                error: function(data) {
                    console.log(data);
                }
            })
        })
    </script>
@endsection
