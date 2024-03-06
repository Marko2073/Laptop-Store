@extends('layouts.layout')

@section('title') Home @endsection
@section('description') The main page of the shop. @endsection
@section('keywords') shop, online, home, best, sellers @endsection


@section('content')

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>

                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Products Start -->
    <div class="container-fluid pt-1 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Daily specials</span></h2>


        <div class="row">
            <div class="col-md-8 align-self-stretch">
                <!-- Prvi element širine 8 -->
                <div class="card h-100">
                    <div class="card-body  d-flex align-items-center">
                        <div class="row px-xl-6 d-flex align-items-center">
                            <div class="col-lg-6">
                                <div id="RandomProduct" >
                                    <a href="/shop/{{$productsRandom[0]->model_specification_id}}">
                                    <img class="w-100 h-100" src="{{asset('assets/img/products-resize/'.$productsRandom[0]->picture)}}" alt="Image">
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-6 ">
                                <div class="h-100 bg-light p-30">
                                    <h3>{{$productsRandom[0]->brand_name. ' ' . $productsRandom[0]->name }}</h3>




                                    <h3 class="font-weight-semi-bold mb-4">${{$productsRandom[0]->current_price}}</h3>
                                    @if($productsRandom[0]->old_price )
                                        <h5 class="font-weight-semi-bold mb-4"><del>${{$productsRandom[0]->old_price}}</del></h5>
                                    @endif
                                    <p class="mb-4">Volup erat ipsum diam elitr rebum et dolor. Est nonumy elitr erat diam stet sit
                                        clita ea. Sanc ipsum et, labore clita lorem magna duo dolor no sea

                                    </p>

                                    <div class="d-flex align-items-center mb-4 pt-2">
                                        <input type="hidden" class="BrojStock" data-id="{{$productsRandom[0]->model_specification_id}}" value="{{$productsRandom[0]->stock}}">

                                        <button class="btn btn-primary px-3 addCart" data-ProductId="{{$productsRandom[0]->model_specification_id}}"><i class="fa fa-shopping-cart mr-1"></i> Add To
                                            Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Prvi element širine 4 -->
                <div class="card h-50">
                    <div class="card-body d-flex align-items-center">
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-6">
                                <div id="RandomProduct">
                                    <a href="/">
                                        <img class="w-100 h-auto" src="{{asset('assets/img/products-resize/'.$productsRandom[1]->picture)}}" alt="Image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="h-100 bg-light p-30">
                                    <h6>{{$productsRandom[1]->brand_name. ' ' . $productsRandom[1]->name }}</h6>

                                    <h5 class="font-weight-semi-bold mb-4">${{$productsRandom[1]->current_price}}</h5>
                                    @if($productsRandom[1]->old_price )
                                        <h6 class="font-weight-semi-bold mb-4"><del>${{$productsRandom[1]->old_price}}</del></h6>
                                    @endif                                    <a href="/shop/{{$productsRandom[1]->model_specification_id}}" class="btn btn-primary px-3">More about</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Drugi element širine 4 -->
                <div class="card h-50">
                    <div class="card-body d-flex align-items-center">
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-6">
                                <div id="RandomProduct">
                                    <a href="/">
                                        <img class="w-100 h-auto" src="{{asset('assets/img/products-resize/'.$productsRandom[2]->picture)}}" alt="Image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="h-100 bg-light p-30">
                                    <h6>{{$productsRandom[2]->brand_name. ' ' . $productsRandom[2]->name }}</h6>

                                    <h5 class="font-weight-semi-bold mb-4">${{$productsRandom[2]->current_price}}</h5>
                                    @if($productsRandom[2]->old_price )
                                        <h6 class="font-weight-semi-bold mb-4"><del>${{$productsRandom[2]->old_price}}</del></h6>
                                    @endif
                                    <a href="/shop/{{$productsRandom[2]->model_specification_id}}" class="btn btn-primary px-3">More about</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>


    <!-- Products End -->


    <!-- Offer Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="assets/img/asus baner.png" alt="">
                    <div class="offer-text">
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="/shop" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="assets/img/sale baner.jpg" alt="">
                    <div class="offer-text">
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="/shop" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->




@endsection
