
@extends('layouts.layout')

@section('title'){{$product->brand_name. ' ' . $product->name }}@endsection
@section('description')' Single page'@endsection
@section('keywords') shop, online, home, best, sellers @endsection


@section('content')
<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($pictures as $index => $picture)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('assets/img/products-resize/'.$picture->path) }}" alt="Product Image" class="d-block w-100">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#product-carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#product-carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>


        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{$product->brand_name. ' ' . $product->name }}</h3>
                @if($specifications[10]->name == 'Yes')
                    <span class="badge badge-warning text-uppercase flagNew">New Arrival</span>

                @endif
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        @php
                            $fullStars = floor($product->rating);
                            $halfStars = ceil($product->rating - $fullStars);
                            for($i = 0; $i < $fullStars; $i++) {
                                echo '<i class="fas fa-star"></i>';
                            }
                            if ($halfStars > 0) {
                                echo '<i class="fas fa-star-half-alt"></i>';
                            }
                            $emptyStars = 5 - $fullStars - $halfStars;
                            for($i = 0; $i < $emptyStars; $i++) {
                                echo '<i class="far fa-star"></i>';
                            }
                        @endphp
                    </div>
                    <small class="pt-1">({{$numOfReviews}} Reviews)</small>
                </div>





                <h3 class="font-weight-bold mb-2 ">${{$product->current_price}}</h3>
                @if($product->old_price != null)
                    <h5 class=" text-decoration-line-through">${{$product->old_price}}</h5>
                @endif
                @php
                    $stock = $product->stock;
                    $colorClass = '';

                    if ($stock > 50) {
                        $colorClass = 'text-success';
                    } elseif ($stock > 20) {
                        $colorClass = 'text-warning';
                    } elseif ($stock > 0) {
                        $colorClass = 'text-danger';
                    } else {
                        $stock = "Out of stock";
                        $colorClass = 'text-secondary'; // Dodajemo klasi za boju teksta
                    }
                @endphp

                <h5 class="mb-2 col-2 alert {{$colorClass}} alert-primary text-capitalize text-center ">
                    {{$stock}}@if($stock != "Out of stock") left @endif
                </h5>

                @if($stock != "Out of stock")
                <div class="d-flex align-items-center mb-4 pt-2">
                    {{--<div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary border-0 text-center brojEl " value="1" >
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>--}}
                    <input type="hidden" class="BrojStock" data-id="{{$product->model_specification_id}}" value="{{$product->stock}}">
                    <button class="btn btn-primary px-3 addCart" data-ProductId="{{$product->model_specification_id}}"><i class="fa fa-shopping-cart mr-1"></i> Add To
                        Cart</button>
                </div>
                @endif
                <div class="d-flex pt-2">

                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Specifications</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews ({{$countReviews}})</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <table id="tabelaSingl" class="mx-auto">
                            <thead>
                            </thead>
                            <tbody>
                            @foreach($specifications as $index=>$s)

                                <tr class="spec-row">
                                    @if($names[$index]->name != 'New arrivals')
                                    <td class="spec-value">{{$names[$index]->name}}:
                                    </td>
                                <td class="spec-name">{{$s->name}}</td>
                                    @endif

                            </tr>
                            @endforeach

                            </tbody>
                        </table> </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">{{$countReviews }} reviews for {{$product->brand_name. ' '. $product->name}}</h4>
                                @if($countReviews == 0)
                                    <p>There are no reviews for this product.</p>
                                @else
                                @foreach($reviews as $r)

                                    <div class="media mb-4">
                                        <img src="{{asset('assets/img/products-resize/'. $r->path)}}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6>{{$r->name}}<small> - <i>{{$r->created_at}}</i></small></h6>

                                            <p>{{$r->content}}</p>
                                        </div>
                                    </div>


                                @endforeach
                                    {{$reviews->links()}}
                                @endif
                            </div>
                            <div class="col-md-6">

                                @if(session()->has('user'))
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <form action="{{route('addreview')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control" name="userreview"></textarea>
                                        <input type="hidden" name="product_id" value="{{$product->model_specification_id}}">
                                        <input type="hidden" name="rating" value="0" id="rating">
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="text-primary mr-2 klasaZvezde">
                                            <i class="far fa-star" onclick="fillstars(1)"></i>
                                            <i class="far fa-star" onclick="fillstars(2)"></i>
                                            <i class="far fa-star" onclick="fillstars(3)"></i>
                                            <i class="far fa-star" onclick="fillstars(4)"></i>
                                            <i class="far fa-star" onclick="fillstars(5)"></i>

                                        </div>
                                    </div>

                                    <div class="form-group mb-0">
                                        <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                    </div>
                                </form>
                                @else
                                    <h4 class="mb-4">Leave a review</h4>
                                    <p>You must be logged in to leave a review.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function fillstars(index) {
    const stars = document.querySelectorAll('.klasaZvezde i');
    document.getElementById('rating').value = index;
    for (let i = 0; i < stars.length; i++) {
        if (i < index) {
            stars[i].classList.remove('far');
            stars[i].classList.add('fas');
        } else {
            stars[i].classList.remove('fas');
            stars[i].classList.add('far');
        }
    }
}
</script>
@endsection
