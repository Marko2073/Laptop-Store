@extends('layouts.adminlayout')

@section('title') Home @endsection
@section('description') The main page of the shop. @endsection
@section('keywords') shop, online, home, best, sellers @endsection


@section('content')
<div class="min-vh-100 mt-4">
    <div class="col-sm-12 col-xl-6 mx-auto">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">Insert</h6>
            <form action="{{route($name.'.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                @foreach($columns as $c)
                    @if($c=='name' || $c=='route' || $c=='price' || $c=='firstname' || $c=='lastname'  || $c=='phone' || $c=='address' || $c=='city' || $c=='stockQuantity')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{$c}}</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="{{$c}}" value="{{old($c)}}">
                        </div>

                    @endif
                        @if($c=='password')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">{{$c}}</label>
                                <input type="password" class="form-control" id="exampleInputEmail1" name="{{$c}}" value="{{old($c)}}">
                            </div>

                        @endif
                        @if($c=='email')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">{{$c}}</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="{{$c}}" value="{{old($c)}}">
                            </div>



                        @endif
                    @if($c=='brand_id')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{$c}}</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="{{$c}}" id="{{$c}}">
                                <option value="0">Choose...</option>
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if($c=='model_id')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label
                            ">{{$c}}</label>
                            <select class="form-select mb-3" aria-label="Default select example" name="{{$c}}" id="{{$c}}">
                                <option value="0">Choose...</option>
                                @foreach($models as $model)
                                    <option value="{{$model->id}}">{{$model->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if($c=='path')
                        <div class="mb-3">
                            <label for="formFile" class="form-label">{{$c}}</label>
                            <input class="form-control bg-dark" type="file" id="formFileMultiple" multiple="true" name="{{$c}}" />
                        </div>
                    @endif
                    @if($c=='model_specification_id')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{$c}}</label>
                            <select class="form-select mb-3 resizePicture" aria-label="Default select example" name="{{$c}}" id="{{$c}}">
                                <option value="0">Choose...</option>
                                @foreach($model_specification as $model_specification)
                                    <option value="{{$model_specification->id}}">{{$model_specification->model_name. ' ' . $model_specification->brand_name}}</option>
                                @endforeach

                            </select>
                        </div>
                    @endif
                    @if($c=='parent_id')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{$c}}</label>
                            <select class="form-select mb-3" aria-label="Default select example" name="{{$c}}" id="{{$c}}">
                                <option value="0">Choose...</option>
                                <option value="null">None</option>

                                @foreach($parentElements as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    @endif
                    @if($c=='specification_id')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{$c}}</label>
                            <select class="form-select mb-3" aria-label="Default select example" name="{{$c}}" id="{{$c}}">
                                <option value="0">Choose...</option>
                                @foreach($specifications as $specification)
                                    <option value="{{$specification->id}}">{{$specification->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if($c=='role_id')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{$c}}</label>
                            <select class="form-select mb-3" aria-label="Default select example" name="{{$c}}" id="{{$c}}">
                                <option value="0">Choose...</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif





                @endforeach
                <input type="submit" class="btn btn-success" value="Submit">

            </form>
        </div>
    </div>
</div>
    @foreach($columns as $c)

    @endforeach
@endsection
