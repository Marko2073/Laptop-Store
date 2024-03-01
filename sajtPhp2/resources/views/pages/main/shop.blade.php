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
                    <span class="breadcrumb-item active">Shop</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->


                <div class="accordion col-12" id="accordionExample">

                    <form action="{{route('shop')}}" method="get" >

                        <div class="card-header col-12 d-flex justify-content-center" id="heading">
                            <div class="row col-12 ">

                                <input class="btn btn-secondary col-6 px" type="submit" value="Filter"/>
                                <a class="btn btn-secondary col-6" href="{{route('shop')}}">Reset</a>

                            </div>
                        </div>
                        <div class="card-header col-12">
                            <select class="form-control btn-secondary col-12" name="sort" id="sort">
                                <option value="0" @if(request()->input('sort') == '0') selected @endif>Sort by</option>
                                <option value="price" @if(request()->input('sort') == 'price') selected @endif>Price</option>
                                <option value="name" @if(request()->input('sort') == 'name') selected @endif>Name</option>
                            </select>
                        </div>
                        @foreach($names as $index => $n)
                            @if($n->name!='New arrivals')
                                <div class="card">
                                    <div class="card-header" id="heading{{$index}}">
                                        <h5 class="mb-0">
                                            <button class="btn btn-secondary text-uppercase btn-block" type="button" data-toggle="collapse" data-target="#collapse{{$index}}" aria-expanded="true" aria-controls="collapse{{$index}}">
                                                Filter by {{$n->name}} <i class="fas fa-chevron-down ml-auto"></i>
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse{{$index}}" class="collapse @if($index == 0) show @endif" aria-labelledby="heading{{$index}}" data-parent="#accordionExample">
                                        <div class="card-body">


                                            @foreach($specifications as $s)
                                                @if($s->parent_id == $n->id)
                                                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                                        <input type="checkbox" class="custom-control-input chc-filter" id="price-{{$s->id}}" name="checkbox{{$n->name}}[]" value="{{$s->id}}"

                                                            @if(request()->input('checkbox'.$n->name))
                                                                @foreach(request()->input('checkbox'.$n->name) as $c)
                                                                    @if($c == $s->id)
                                                                        checked
                                                                    @endif
                                                                @endforeach
                                                            @endif






                                                        />
                                                        <label class="custom-control-label" for="price-{{$s->id}}">{{$s->name}}</label>
                                                        <span class="badge border font-weight-normal">150</span>
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </form>

                </div>

                <script>

</script>



                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">

                    @if($products->isEmpty())
                        <div class="col-12">
                            <div class="alert alert-primary text-center" role="alert">
                                <h3>No products found</h3>
                            </div>
                        </div>

                    @endif

                    @foreach($products as $index=>$product)


                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4 position-relative">

                                @if($new[$index]->name == 'Yes')
                                    <span class="badge badge-primary position-absolute" style="z-index: 2; left: -10px; top:-10px ; padding: 10px 20px; clip-path: polygon(0 0, 100% 0, 85% 50%, 100% 100%, 0 100%);">New Arrival</span>
                                @endif
                                    @if($product->stock == 0)
                                        <span class="badge badge-danger position-absolute" style="z-index: 2; right: -10px; top: -10px; padding: 10px 20px; clip-path: polygon(100% 0, 100% 100%, 0 100%, 15% 50%, 0 0);">Out of stock</span>
                                    @endif

                                    <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="{{$product->picture}}" alt="">
                                    <div class="product-action">
                                        @if($product->stock != 0)
                                        <input type="hidden" class="BrojStock" data-id="{{$product->model_specification_id}}" value="{{$product->stock}}">
                                        <a class="btn btn-outline-dark btn-square addCart" data-ProductId="{{$product->model_specification_id}}" ><i class="fa fa-shopping-cart"></i></a>
                                        @endif
                                        <a class="btn btn-outline-dark btn-square" href="{{route('show',$product->model_specification_id)}}"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="{{route('show',$product->model_specification_id)}}">{{$product->brand_name. ' ' . $product->name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{$product->price}}</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                                    </div>

                                </div>
                            </div>
                        </div>



                    @endforeach
                   {{$products->appends(request()->except('page'))->links() }}
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
