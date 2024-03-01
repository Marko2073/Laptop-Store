@extends('layouts.layout')

@section('title') Home @endsection
@section('description') The main page of the shop. @endsection
@section('keywords') shop, online, home, best, sellers @endsection


@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12 mx-auto">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Login</span></h5>
                <div class="bg-light p-30 mb-5 mx-auto">
                    <div class="col-lg-6 mx-auto">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li> {{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('login')}}" method="POST" class="row" >
                            @csrf


                            <div class="col-md-12 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" placeholder="example@email.com" name="email" value="{{old('email')}}">
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Password</label>
                                <input class="form-control" type="text"  name="password" >
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
