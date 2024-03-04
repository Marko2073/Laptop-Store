@extends('layouts.layout')


@section('title') Cart @endsection
@section('description') Cart page @endsection
@section('keywords') shop, online, home, best, sellers @endsection


@section('content')


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Cart Start -->
<div class="container-fluid">

    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                <tr>
                    <th>Image</th>
                    <th>Products</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody class="align-middle" id="korpa">

                </tbody>
            </table>
        </div>
        <div class="col-lg-3">

            <div class="bg-light  mb-5">

                <div class="">

                    @if(!session()->has('user'))

                        <p class="alert alert-danger font-weight-bold">You must be logged in to proceed to checkout. Click  <a href="/login" >here</a> to login</br>
                            You don't have account? Click  <a href="/register">here</a> to register
                        </p>





                    @else
                    <a href="/checkout" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->


@endsection
