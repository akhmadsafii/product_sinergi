@extends('layouts.AdminLTE.index')

@section('icon_page', 'gear')

@section('title', 'Edit Product')

@section('content')
    @push('styles')
        <style>
            .rating {
                unicode-bidi: bidi-override;
                direction: rtl;
                text-align: left;
            }

            .rating>input {
                display: none;
            }

            .rating>label:before {
                content: '\2605';
                font-size: 30px;
                padding: 5px;
                color: #ccc;
                cursor: pointer;
            }

            .rating>input:checked~label:before {
                color: #ffca08;
            }
        </style>
    @endpush
    <div class="box box-primary">
        <div class="box-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="list-group">
                            <a href="#general" class="list-group-item" data-toggle="tab">
                                <div class="btn btn-primary btn-block">General</div>
                            </a>
                            <a href="#prices" class="list-group-item" data-toggle="tab">
                                <div class="btn btn-primary btn-block">Price</div>
                            </a>
                            <a href="#images" class="list-group-item" data-toggle="tab">
                                <div class="btn btn-primary btn-block">Images</div>
                            </a>
                            <a href="#descriptions" class="list-group-item" data-toggle="tab">
                                <div class="btn btn-primary btn-block">Description</div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content">
                            <div class="tab-pane active" id="general">
                                <div class="form-group">
                                    <label>Title:</label>
                                    <input type="text" name="title" class="form-control" value="{{ $product->title }}">
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Category:</label>
                                    <input type="text" name="category" class="form-control"
                                        value="{{ $product->category }}">
                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Brand:</label>
                                    <input type="text" name="brand" class="form-control" value="{{ $product->brand }}">
                                    @if ($errors->has('brand'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('brand') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Stock:</label>
                                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
                                    @if ($errors->has('stock'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('stock') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="rating">Rating:</label>
                                    <div class="rating">
                                        <input type="radio" id="star5" name="rating"
                                            value="5"{{ round($product->rating) == 5 ? ' checked' : '' }}>
                                        <label for="star5" title="5 stars"></label>
                                        <input type="radio" id="star4" name="rating"
                                            value="4"{{ round($product->rating) == 4 ? ' checked' : '' }}>
                                        <label for="star4" title="4 stars"></label>
                                        <input type="radio" id="star3" name="rating"
                                            value="3"{{ round($product->rating) == 3 ? ' checked' : '' }}>
                                        <label for="star3" title="3 stars"></label>
                                        <input type="radio" id="star2" name="rating"
                                            value="2"{{ round($product->rating) == 2 ? ' checked' : '' }}>
                                        <label for="star2" title="2 stars"></label>
                                        <input type="radio" id="star1" name="rating"
                                            value="1"{{ round($product->rating) == 1 ? ' checked' : '' }}>
                                        <label for="star1" title="1 star"></label>
                                    </div>
                                    @if ($errors->has('rating'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rating') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane" id="prices">
                                <div class="form-group">
                                    <label>Price:</label>
                                    <input type="text" name="price" class="form-control"
                                        value="{{ $product->price }}">
                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Diskon:</label>
                                    <div class="input-group">
                                        <input type="number" name="discount" class="form-control" min="0"
                                            max="100" step="1"
                                            value="{{ round($product->discount_percentage) }}">
                                        <span class="input-group-addon">%</span>
                                    </div>
                                    @if ($errors->has('discount'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('discount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane" id="descriptions">
                                <label>Deskripsi:</label>
                                <textarea class="textarea" placeholder="Message" name="description"
                                    style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $product->description !!}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="tab-pane" id="images">
                                <div class="form-group">
                                    <label>Thumbnail:</label>
                                    <div class="form-group">
                                        <img id="image-preview"
                                            src="{{ $product->thumbnail ? asset($product->thumbnail) : 'https://via.placeholder.com/150' }}"
                                            alt="Preview" class="form-group mb-1" style="width: 150px">
                                        <input id="image" type="file" name="thumbnail" accept="image/*"
                                            onchange="readURL(this);">
                                    </div>
                                    @if ($errors->has('thumbnail'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('thumbnail') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Gallery:</label>
                                    <div class="images row">
                                        @foreach (is_array($product->images) ? $product->images : json_decode($product->images) as $key => $photo)
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="img-upload-preview">
                                                    <img loading="lazy" src="{{ asset($photo) }}" alt=""
                                                        class="img-responsive">
                                                    <input type="hidden" name="images[]" value="{{ $photo }}">
                                                    <button type="button"
                                                        class="btn btn-danger close-btn remove-files"><i
                                                            class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if ($errors->has('images'))
                                        <span class="help-block">
                                            @foreach ($errors->get('images') as $error)
                                                <strong>{{ $error[0] }}</strong><br>
                                            @endforeach
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('products') }}" class="btn btn-danger btn-lg">Kembali</a>
                        <button type="submit" class="btn btn-info btn-lg">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/upload.js') }}"></script>
        <script>
            $(document).ready(function() {
                $(".images").spartanMultiImagePicker({
                    fieldName: 'images[]',
                    maxCount: 10,
                    rowHeight: '200px',
                    groupClassName: 'col-md-4 col-sm-4 col-xs-6',
                    maxFileSize: '',
                    dropFileLabel: "Drop Here",
                    onExtensionErr: function(index, file) {
                        console.log(index, file, 'extension err');
                        alert('Please only input png or jpg type file')
                    },
                    onSizeErr: function(index, file) {
                        console.log(index, file, 'file size too big');
                        alert('File size too big');
                    }
                });



                $('.remove-files').on('click', function() {
                    $(this).parents(".col-md-4").remove();
                });
            });

            function readURL(input, id) {
                id = id || '#image-preview';
                if (input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(id).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                    $('#image-preview').removeClass('hidden');
                    $('#start').hide();
                }
            }
        </script>
    @endpush

@endsection
