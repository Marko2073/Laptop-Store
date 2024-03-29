@extends('layouts.layout')

@section('title') Register @endsection
@section('description') Register page @endsection
@section('keywords') shop, online, home, best, sellers @endsection


@section('content')


    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Register account</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row ">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li> {{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('store')}}" method="POST" class="row" >
                                @csrf

                            <div class="col-md-6 form-group">
                                <label>First Name</label>
                                <input class="form-control" type="text" placeholder="John" name="firstname" value="{{old('firstname')}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" placeholder="Doe" name="lastname" value="{{old('lastname')}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" placeholder="example@email.com" name="email" value="{{old('email')}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input class="form-control" type="text" placeholder="+123 456 789" name="phone" value="{{old('phone')}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address</label>
                                <input class="form-control" type="text" placeholder="123 Street" name="address" value="{{old('address')}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" type="text" placeholder="New York" name="city" value="{{old('city')}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Password</label>
                                <input class="form-control" type="password"  name="password" >
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Retype password</label>
                                <input class="form-control" type="password"  name="passwordc">
                            </div>
                            <div class="col-md-6 form-group mx-auto">

                                <input type="submit" value="Register" class="btn btn-block btn-primary font-weight-bold py-3">
                            </div>



                        </form>




                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
