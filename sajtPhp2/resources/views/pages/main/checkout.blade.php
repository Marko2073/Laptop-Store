@extends('layouts.layout')


@section('title') Checkout @endsection
@section('description') Checkout page @endsection
@section('keywords') shop, online, home, best, sellers @endsection


@section('content')

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <div id="purchaseModal" class="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title">
                        Successful purchase</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>You can view your orders on your profile in the order history section!</p>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a href="/" class="btn btn-success mr-2">Go to home page</a>
                    <a href="/profile" class="btn btn-success ml-2">Go to your Profile</a>
                </div>
            </div>
        </div>
    </div>



    <!-- Checkout Start -->
    <div class="container-fluid">




        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" disabled placeholder="John" name="firstname" value="{{$info->firstname}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" disabled placeholder="Doe" name="lastname" value="{{$info->lastname}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" disabled placeholder="example@email.com" name="email" value="{{$info->email}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" disabled placeholder="+123 456 789" name="mobile" value="{{$info->phone}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" type="text" disabled placeholder="123 Street" name="address" value="{{$info->address}}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" disabled placeholder="New York" name="city" value="{{$info->city}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <a href="/profile" class="btn btn-primary col-6 ">Change billing address</a>

                        </div>




                    </div>
                </div>

                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">

                        <div class="form-group">

                            <select class="custom-select" id="Placanje">
                                <option selected value="0">Choose...</option>
                                <option value="1">Credit Card</option>
                                <option value="2">Cash</option>
                            </select>

                        </div>
                        <div id="cards"></div>
                        <div id="cardDetails">

                        </div>
                        <div class="alert alert-success" role="alert" id="mojModal">
                            <h4 class="alert-heading">Well done!</h4>
                            <p>You have successfully ordered your products, the order has been received, expect your products soon!</p>

                        </div>

                        <button class="btn btn-block btn-primary font-weight-bold py-3" id="dugmeUpis">Place Order</button>

                    </div>
                </div>


            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Reciept items</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom" id="TotalOrder">
                        <h6 class="mb-3">Products</h6>


                    </div>
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Total</h5>
                            <h5 id="subtot"></h5>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>


    <!-- Checkout End -->

@endsection
