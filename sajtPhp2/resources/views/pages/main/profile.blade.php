@extends('layouts.layout')
@section('title') Home @endsection
@section('description') The main page of the shop. @endsection
@section('keywords') shop, online, home, best, sellers @endsection


@section('content')

    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="/home">Home</a>
                <span class="breadcrumb-item active">Profile</span>
            </nav>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" id="ordersDetails1" data-toggle="tab" href="#tab-pane-1">About user</a>
                    <a class="nav-item nav-link text-dark" id="ordersDetails" data-toggle="tab" href="#tab-pane-2">Order details</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <div id="profile" class="row h-100">
                            <div class="col-xl-4 h-100" >

                                <div class="card mb-4 mb-xl-0">
                                    <div class="card-header">Profile Picture</div>
                                    <div class="card-body text-center ">

                                        <img class="img-account-profile rounded-circle mb-2" style="width: 150px"  src="{{asset('assets/img/products-resize/'.$picture->path)}}" alt>

                                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                        <form action="{{route('updatepicture')}}" method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <input type="file" name="path" class="form-control mb-4">
                                            <input type="submit" value="Save changes" class="btn btn-primary">
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 h-100" >

                                <div class="card mb-4">
                                    <div class="card-header">Account Details</div>
                                    <div class="card-body">
                                        <form action="{{route('updateuser')}}" method="POST">
                                            @csrf



                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label>First Name</label>
                                                    <input class="form-control" type="text" placeholder="John" name="firstname" value="{{$info->firstname}}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>Last Name</label>
                                                    <input class="form-control" type="text" placeholder="Doe" name="lastname" value="{{$info->lastname}}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>E-mail</label>
                                                    <input class="form-control" type="text" placeholder="example@email.com" name="email" value="{{$info->email}}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>Mobile No</label>
                                                    <input class="form-control" type="text" placeholder="+123 456 789" name="phone" value="{{$info->phone}}">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>Address Line 1</label>
                                                    <input class="form-control" type="text" placeholder="123 Street" name="address" value="{{$info->address}}">
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>City</label>
                                                    <input class="form-control" type="text" placeholder="New York" name="city" value="{{$info->city}}">
                                                </div>



                                            </div>

                                            <input class="btn btn-primary" type="submit" value="Save changes">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="profilecard" class="row">
                            <div class="col-xl-4">

                                <div class="card mb-4 mb-xl-0">
                                    <div class="card-header">Add credit card</div>
                                    <div class="card-body">
                                        <form action="{{route('storecard')}}" method="POST">
                                            @csrf
                                            <div class="form-group" >
                                                <label>Name</label>
                                                <select class="form-control" name="cardname">
                                                    <option value="Visa">Visa</option>
                                                    <option value="Mastercard">Mastercard</option>
                                                    <option value="American Express">American Express</option>
                                                    <option value="Discover">Discover</option>
                                                    <option value="Diners Club">Diners Club</option>
                                                </select>
                                                {{--<input class="form-control" type="text" placeholder="Visa" name="cardname" value="">--}}
                                            </div>

                                            <div class="form-group" >
                                                <label>Card Number</label>
                                                <input class="form-control" type="text" placeholder="1234 5678 9101 1121" name="cardnumber" value="">
                                            </div>
                                            <div class="form-group" >
                                                <label>Expiration Date</label>
                                                <input class="form-control" type="text" placeholder="MM/YY" name="expirationdate" value="">
                                            </div>

                                            <div class="form-group" >
                                                <label>CVV</label>
                                                <input class="form-control" type="text" placeholder="123" name="cvv" value="">
                                            </div>

                                            <input class="btn btn-primary" type="submit" value="Save changes">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8">

                                <div class="card mb-4">
                                    <div class="card-header">Card details</div>
                                    <div class="card-body">
                                        <div class="nav nav-tabs mb-4">
                                            @foreach($usercard as $index=>$card)
                                                @if($index==0)
                                                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#alo{{$index}}">{{$card->card_name}}</a>
                                                @else
                                                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#alo{{$index}}">{{$card->card_name}}</a>
                                                @endif

                                            @endforeach

                                        </div>
                                        <div class="tab-content">
                                            @foreach($usercard as $index=>$card)
                                                @if($index==0)
                                                    <div class="tab-pane fade show active" id="{{'alo'.$index}}">
                                                        <form action="{{route('updatecard')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" value="{{$card->id}}" name="cardid">
                                                            <div class="form-group" >
                                                                <label>Name</label>
                                                                <select class="form-control" name="cardname">
                                                                    <option value="Visa" @if($card->card_name=='Visa') selected @endif>Visa</option>
                                                                    <option value="Mastercard" @if($card->card_name=='Mastercard') selected @endif>Mastercard</option>
                                                                    <option value="American Express" @if($card->card_name=='American Express') selected @endif>American Express</option>
                                                                    <option value="Discover" @if($card->card_name=='Discover') selected @endif>Discover</option>
                                                                    <option value="Diners Club" @if($card->card_name=='Diners Club') selected @endif>Diners Club</option>
                                                                </select>

                                                            </div>

                                                            <div class="form-group" >
                                                                <label>Card Number</label>
                                                                <input class="form-control" type="text" placeholder="1234 5678 9101 1121" name="cardnumber" value="{{$card->card_number}}">
                                                            </div>
                                                            <div class="form-group" >
                                                                <label>Expiration Date</label>
                                                                <input class="form-control" type="text" placeholder="MM/YY" name="expirationdate" value="{{$card->expiration_date}}">
                                                            </div>

                                                            <div class="form-group" >
                                                                <label>CVV</label>
                                                                <input class="form-control" type="text" placeholder="123" name="cvv" value="{{$card->cvv}}">
                                                            </div>

                                                            <input type="submit" value="Save changes" class="btn btn-primary">
                                                        </form>


                                                    </div>
                                                @else
                                                    <div class="tab-pane fade show" id="{{'alo'.$index}}">
                                                        <form action="{{route('updatecard')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" value="{{$card->id}}" name="cardid">
                                                            <div class="form-group" >
                                                                <label>Name</label>
                                                                <select class="form-control" name="cardname">
                                                                    <option value="Visa" @if($card->card_name=='Visa') selected @endif>Visa</option>
                                                                    <option value="Mastercard" @if($card->card_name=='Mastercard') selected @endif>Mastercard</option>
                                                                    <option value="American Express" @if($card->card_name=='American Express') selected @endif>American Express</option>
                                                                    <option value="Discover" @if($card->card_name=='Discover') selected @endif>Discover</option>
                                                                    <option value="Diners Club" @if($card->card_name=='Diners Club') selected @endif>Diners Club</option>
                                                                </select>

                                                            </div>

                                                            <div class="form-group" >
                                                                <label>Card Number</label>
                                                                <input class="form-control" type="text" placeholder="1234 5678 9101 1121" name="cardnumber" value="{{$card->card_number}}">
                                                            </div>
                                                            <div class="form-group" >
                                                                <label>Expiration Date</label>
                                                                <input class="form-control" type="text" placeholder="MM/YY" name="expirationdate" value="{{$card->expiration_date}}">
                                                            </div>

                                                            <div class="form-group" >
                                                                <label>CVV</label>
                                                                <input class="form-control" type="text" placeholder="123" name="cvv" value="{{$card->cvv}}">
                                                            </div>

                                                            <input type="submit" value="Save changes" class="btn btn-primary">
                                                        </form>


                                                    </div>
                                                @endif



                                            @endforeach



                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab-pane-2">


                        <div class="card mb-4">
                            <div class="card-header">Order History</div>
                            <div class="card-body p-0">

                                <div class="table-responsive table-billing-history">

                                    <div id="accordion">
                                        @foreach($user_carts as $cart)
                                            <div class="card">
                                                <div class="card-header" id="heading{{$cart->id}}">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-primary" data-toggle="collapse" data-target="#collapse{{$cart->id}}" aria-expanded="true" aria-controls="collapse{{$cart->id}}">
                                                            Order-{{date($cart->created_at)}}
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapse{{$cart->id}}" class="collapse" aria-labelledby="heading{{$cart->id}}" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <table class="table table-borderless table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Image</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th>Total</th>
                                                                <th>Payment Method</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($orders as $order)
                                                                @if($order->user_cart_id == $cart->id)
                                                                    <tr>
                                                                        <td>{{$order->brand_name.' '.$order->name}}</td>
                                                                        <td><img src="{{$order->picture}}" style="width: 70px; height: 70px;"></td>
                                                                        <td>{{$order->price}}$</td>
                                                                        <td>{{$order->quantity}}</td>
                                                                        <td>{{$order->price*$order->quantity}}$</td>
                                                                        <td>{{$order->payment_method_name}}</td>
                                                                    </tr>

                                                                @endif
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
