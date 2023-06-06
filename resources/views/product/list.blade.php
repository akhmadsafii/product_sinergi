@extends('layouts.AdminLTE.index')

@section('icon_page', 'gear')

@section('title', 'Application Settings')

@section('content')
    @push('styles')
        <style>
            .product-grid {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .product-item {
                width: calc(33.33% - 10px);
                margin-bottom: 20px;
            }

            .thumbnail {
                height: auto;
            }

            .product-title {
                margin-top: 10px;
            }

            .product-price {
                margin-top: 5px;
            }

            .product-description {
                margin-bottom: 10px;
            }

            .product-rating {
                margin-bottom: 10px;
            }

            .product-actions {
                text-align: center;
            }
        </style>
    @endpush
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('products') }}" method="GET" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" id="filter" name="filter" class="form-control input-lg"
                                        value="{{ $filter ?? '' }}">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-lg">Filter</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>                
                    @if ($products->isEmpty())
                        <p class="text-center">Product tidak ditemukan.</p>
                    @else
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Daftar Produk</h3>
                            </div>
                            <div class="panel-body">
                                <div class="product-grid">
                                    @foreach ($products as $product)
                                        <div class="product-item">
                                            <div class="thumbnail">
                                                <img src="{{ $product->thumbnail }}" alt="Product Thumbnail"
                                                    class="img-responsive">
                                                <div class="caption">
                                                    <h4 class="product-title">{{ $product->title }}</h4>
                                                    <p class="product-price">
                                                        @if ($product->discount_percentage > 0)
                                                            <span class="original-price">{{ $product->price }}</span>
                                                            <span
                                                                class="discounted-price">{{ $product->price - ($product->price * $product->discount_percentage) / 100 }}</span>
                                                        @else
                                                            {{ $product->price }}
                                                        @endif
                                                    </p>
                                                    <p class="product-description">{{ $product->description }}</p>
                                                    <div class="product-rating">
                                                        <div class="star-rating">
                                                            <?php
                                                            $rating = round($product->rating);
                                                            $fullStars = floor($rating);
                                                            $halfStar = $rating - $fullStars >= 0.5;
                                                            
                                                            for ($i = 1; $i <= 5; $i++) {
                                                                if ($i <= $fullStars) {
                                                                    echo '<i class="fa fa-star text-danger"></i>';
                                                                } elseif ($halfStar && $i == $fullStars + 1) {
                                                                    echo '<i class="fa fa-star-half-o text-danger"></i>';
                                                                } else {
                                                                    echo '<i class="fa fa-star-o"></i>';
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="product-actions">
                                                        <a href="{{ route('products.show', $product->slug) }}"
                                                            class="btn btn-primary btn-sm"><i
                                                                class="glyphicon glyphicon-eye-open"></i> Lihat</a>
                                                        <a href="{{ route('products.edit', $product->slug) }}"
                                                            class="btn btn-info btn-sm"><i
                                                                class="glyphicon glyphicon-pencil"></i> Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
            </div>

        </div>
    </div>

@endsection
