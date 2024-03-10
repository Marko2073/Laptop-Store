
@extends('layouts.layout')

@section('title') Home @endsection
@section('description') The main page of the shop. @endsection
@section('keywords') shop, online, home, best, sellers @endsection


@section('content')
<div class="sub-banner">
</div>
<div class="about">
    <div class="container">
        <h3 class="text-center">Abouth author</h3>
        <div class="row">
            <div class="col-md-6">
                <img src="{{asset('assets/img/products-resize/author.jpeg')}}" alt="author" class="img-fluid" >
            </div>
            <div class="col-md-6">
                <p class="text-justify">
                    33/21
                </p>
                <p class="text-justify">

                    My name is Marko Marković, I am a second-year student at ICT University and this is my project from the subject web programming php2.

                </p>
            </div>
        </div>
    </div>
</div>
<!-- //about -->


@endsection
