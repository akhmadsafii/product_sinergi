@extends('layouts.AdminLTE.index')

@section('icon_page', 'gear')

@section('title', 'Product Detail')

@section('content')
    @push('styles')
        <style>
            .product-detail {
                display: flex;
            }

            .product-images {
                flex: 1;
                display: flex;
                flex-direction: column;
            }

            .main-image {
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .main-image img {
                max-height: 500px;
                /* Sesuaikan dengan kebutuhan Anda */
            }

            .gallery-images {
                flex: 3;
                display: flex;
                flex-wrap: wrap;
                justify-content: flex-start;
                align-items: flex-start;
            }

            .gallery-image {
                flex-basis: calc(33.33% - 10px);
                /* Sesuaikan dengan kebutuhan Anda */
                margin: 5px;
            }

            .gallery-image img {
                max-height: 150px;
                /* Sesuaikan dengan kebutuhan Anda */
            }

            .product-info {
                flex: 1;
                margin-left: 20px;
                /* Sesuaikan dengan kebutuhan Anda */
            }

            /* Gaya tambahan untuk gaya dan tata letak lainnya */
        </style>
    @endpush

    <div class="box box-primary">
        <div class="box-body">
            <div class="product-detail">
                <div class="product-images">
                    <div class="main-image">
                        <img src="{{ $product->thumbnail }}" alt="Product Image">
                    </div>
                    <div class="gallery-images">
                        @foreach (is_array($product->images) ? $product->images : json_decode($product->images) as $image)
                            <div class="gallery-image">
                                <img src="{{ $image }}" alt="Gallery Image">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="product-info">
                    <h1 class="product-title">{{ $product->title }}</h1>
                    <div class="rating">
                        <div class="star-rating">
                            <?php
                            $rating = round($product->rating);
                            $fullStars = floor($rating);
                            $halfStar = $rating - $fullStars >= 0.5;
                            
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $fullStars) {
                                    echo '<i class="fa fa-star text-danger"></i>';
                                } elseif ($halfStar && $i == $fullStars + 1) {
                                    echo '<i class="fa fa-star-half-alt text-danger"></i>';
                                } else {
                                    echo '<i class="fa fa-star"></i>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <p class="product-price">
                        @if ($product->discount_percentage > 0)
                            <del class="original-price">{{ $product->price }}</del>
                            <span class="discounted-price">
                                {{ $product->price - ($product->price * $product->discount_percentage) / 100 }}
                                ({{ $product->discount_percentage }}% Off)
                            </span>
                        @else
                            {{ $product->price }}
                        @endif
                    </p>
                    <p class="product-description">{{ $product->description }}</p>
                    <div class="product-attributes">
                        <div class="attribute">
                            <span class="attribute-name">Category:</span>
                            <span class="attribute-value">{{ $product->category }}</span>
                        </div>
                        <div class="attribute">
                            <span class="attribute-name">Brand:</span>
                            <span class="attribute-value">{{ $product->brand }}</span>
                        </div>
                        <div class="attribute">
                            <span class="attribute-name">Stock:</span>
                            <span class="attribute-value">{{ $product->stock }}</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
