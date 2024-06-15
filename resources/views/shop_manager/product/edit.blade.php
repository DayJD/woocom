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
                        <h3 class="card-title">Edit Product</h3>
                    </div>
                    @include('_message')

                    <form method="POST" action="" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product Name <span style="color: red;font-size: 18px"> *</span></label>
                                        <input type="text" name="title" value="{{ old('title', $getProduct->title) }}"
                                            required class="form-control" placeholder="Enter Product Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>SUK <span style="color: red;font-size: 18px"> *</span></label>
                                        <input type="text" name="suk" value="{{ old('suk', $getProduct->suk) }}"
                                            required class="form-control" placeholder="Enter SUK">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category <span style="color: red;font-size: 18px"> *</span></label>
                                        <select class="form-control" name="category_id" id="ChangeCategory" required>
                                            <option value="">Select Category</option>
                                            @foreach ($getCategroy as $category)
                                                <option {{ $getProduct->category_id == $category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Subcategory <span style="color: red;font-size: 18px"> *</span></label>
                                        <select class="form-control" name="sub_category_id" id="getSubCategory" required>
                                            <option value="">Select SubCategory</option>
                                            @foreach ($getSubCategory as $subCategory)
                                                <option
                                                    {{ $getProduct->sub_category_id == $subCategory->id ? 'selected' : '' }}
                                                    value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Brend <span style="color: red;font-size: 18px"> *</span></label>
                                        <select class="form-control" name="brand_id" required>
                                            <option value="">Select Brend</option>
                                            @foreach ($getBrand as $brand)
                                                <option {{ $getProduct->brand_id == $brand->id ? 'selected' : '' }}
                                                    value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Color <span style="color: red;font-size: 18px"> *</span></label>
                                        @foreach ($getColor as $color)
                                            @php
                                                $checked = '';
                                            @endphp
                                            @foreach ($getProduct->getColor as $pcolor)
                                                @if ($pcolor->color_id == $color->id)
                                                    @php
                                                        $checked = 'checked';
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <div>
                                                <label><input type="checkbox" {{ $checked }}
                                                        value="{{ $color->id }}" name="color_id[]">
                                                    {{ $color->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Size <span style="color: red;font-size: 18px"> *</span></label>
                                        <div class="">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="AppendSize">
                                                    <tr>
                                                        <td><input type="text" name="size[0][name]" placeholder="Name"
                                                                class="form-control"></td>
                                                        <td><input type="text" name="size[0][price]"placeholder="Price"
                                                                class="form-control"></td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-primary AddSize">AddSize</button>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $i_s = 1;
                                                    @endphp
                                                    @foreach ($getProduct->getSize as $size)
                                                        <tr id="DeleteSize{{ $i_s }}">
                                                            <td><input type="text"
                                                                    name="size[{{ $i_s }}][name]"
                                                                    value="{{ $size->name }}" placeholder="Name"
                                                                    class="form-control"></td>
                                                            <td><input type="text"
                                                                    name="size[{{ $i_s }}][price]"
                                                                    value="{{ $size->price }}" placeholder="Price"
                                                                    class="form-control"></td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger DeleteSize"
                                                                    id="{{ $i_s }}">Delete</button>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i_s++;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>image</label>
                                    <input type="file" name="image[]" multiple style="padding: 5px;" class="form-control"
                                        accept="image/*">
                                </div>
                            </div>
                            @if (!empty($getProduct->getImage->count()))
                                <div class="row" id="sortable">
                                    @foreach ($getProduct->getImage as $image)
                                        @if (!empty($image->getLogo()))
                                            <div class="col-md-1 text-center sortable">
                                                <img src="{{ $image->getLogo() }}" class="sortable_image"
                                                    id="{{ $image->id }}" style="width: 100%;height: 100px"
                                                    alt="">
                                                <a href="{{ url('admin/product/image_delete/' . $image->id) }}"
                                                    class="btn btn-sm btn-danger mt-1">Delete</a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            <hr>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Price(฿) <span style="color: red;font-size: 18px"> *</span></label>
                                        <input type="text" name="price"
                                            value="{{ !empty($getProduct->price) ? $getProduct->price : '' }}"
                                            class="form-control" placeholder="Enter Price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Old Price <span style="color: red;font-size: 18px"> *</span></label>
                                        <input type="text" name="old_price"
                                            value="{{ !empty($getProduct->old_price) ? $getProduct->old_price : '' }}"
                                            required class="form-control" placeholder="Enter Old Price ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Short Description <span style="color: red;font-size: 18px"> *</span></label>
                                        <textarea class="form-control" name="short_description" placeholder="Short Description">{{ $getProduct->short_description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Description <span style="color: red;font-size: 18px"> *</span></label>
                                    <textarea class="form-control editor"name="description" placeholder="Description">{{ $getProduct->description }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Additional Information <span style="color: red;font-size: 18px">
                                                *</span></label>
                                        <textarea class="form-control editor"name="additional_information" placeholder="Additional Information">{{ $getProduct->additional_information }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Shipping Returns <span style="color: red;font-size: 18px"> *</span></label>
                                        <textarea class="form-control editor"name="shipping_returns" placeholder="Shipping Returns">{{ $getProduct->shipping_returns }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Status <span style="color: red;font-size: 18px"> *</span></label>
                                <select class="form-control" name="status" required>
                                    <option {{ old('status', $getProduct->status) == 0 ? 'selected' : '' }}
                                        value="0">
                                        Active</option>
                                    <option {{ old('status', $getProduct->status) == 1 ? 'selected' : '' }}
                                        value="1">
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
<script type="text/javascript" src="{{ url('public/assets/sortable/jquery-ui.js') }}"></script>
    <script src="{{ url('public/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#sortable").sortable({
                update: function(event, ui) {
                    var photo_id = new Array();
                    $('.sortable_image').each(function() {
                        var id = $(this).attr('id');
                        photo_id.push(id);
                    })
                    $.ajax({
                        url: "{{ url('admin/product_image_sortable') }}",
                        type: "POST",
                        dataType: 'json',
                        data: {
                            "photo_id": photo_id,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            console.log(data);
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    })
                }
            });

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
                ],
            });

            var i_s = {{ $i_s }};

            $('body').on('click', '.AddSize', function(e) {
                var html = `
            <tr id="DeleteSize${i_s}"> 
                <td><input type="text" name="size[${i_s}][name]"  placeholder="Name"  class="form-control"></td> 
                <td><input type="text" name="size[${i_s}][price]"  placeholder="Price" class="form-control"></td> 
                <td> 
                <button type="button" id="DeleteButton${i_s}" class="btn btn-danger DeleteSize">Delete</button> 
            </td> 
            </tr>`;

                i_s++;
                $('#AppendSize').append(html);
            });

            $('body').on('click', '.DeleteSize', function(e) {
                var id = $(this).attr('id').replace('DeleteButton', '');
                $('#DeleteSize' + id).remove();
            });



            $('body').on('change', '#ChangeCategory', function(e) {
                var id = $(this).val()

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
        });
    </script>
@endsection
