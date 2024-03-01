<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ModelSpec;
use App\Models\Purchase;
use App\Models\Specification;
use App\Models\User;
use App\Models\User_cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Modeli;
use Illuminate\Support\Str;
use Illuminate\Database\Query\Builder;


class ShopController extends OsnovniController
{
    public function index(Request $request){
        $niz = $request->input();

        if($niz==null){
        $names = Specification::all()->where('parent_id', null);
        $specifications = Specification::all()->where('parent_id','!=',null);

        $products = DB::table('model_specification')
            ->join('models', 'model_specification.model_id', '=', 'models.id')
            ->join('brands', 'models.brand_id', '=', 'brands.id')
            ->join('pictures', 'model_specification.id', '=', 'pictures.model_specification_id')
            ->join('prices', 'model_specification.id', '=', 'prices.model_specification_id')

            ->select('models.*', 'brands.name as brand_name', 'model_specification.id as model_specification_id', 'pictures.path as picture', 'prices.price as price', 'model_specification.stockQuantity as stock')
            ->distinct()
            ->paginate(12);

        $new = DB::table('model_specification')
            ->join('specifications_individually', 'model_specification.id', '=', 'specifications_individually.model_specification_id')
            ->join('specifications', 'specifications.id', '=', 'specifications_individually.specification_id')
            ->whereIn('specifications.name', ['Yes', 'No'])
            ->select('specifications.name', 'model_specification.id')

            ->get();
            return view('pages.main.shop', ['specifications' => $specifications, 'names' => $names, 'products' => $products, 'new' => $new]);
        }
        else{
            $names = Specification::all()->where('parent_id', null);
            $specifications = Specification::all()->where('parent_id','!=',null);



            $data=$request->input();
            $products = DB::table('model_specification')
                ->join('models', 'model_specification.model_id', '=', 'models.id')
                ->join('brands', 'models.brand_id', '=', 'brands.id')
                ->join('pictures', 'model_specification.id', '=', 'pictures.model_specification_id')
                ->join('prices', 'model_specification.id', '=', 'prices.model_specification_id')
                ->distinct();
            foreach ($data as $key => $value){



                $tmp = [];
                if (!is_array($value)) {
                    // Preskoči iteraciju ako je $value nije niz
                    continue;
                }

                foreach ($value as $v){
                    $tmp[] = $v;
                }
                if($key== 0){
                    $products=$products->whereIn('specifications_individually.specification_id', $tmp);
                }
                else{
                    $products=$products->whereExists(function ($query) use ($tmp) {
                        $query->select(DB::raw(1))
                            ->from('specifications_individually')
                            ->whereRaw('specifications_individually.model_specification_id = model_specification.id')
                            ->whereIn('specifications_individually.specification_id', $tmp);
                    });
                }

            }

            $products=$products->select('models.*', 'brands.name as brand_name', 'model_specification.id as model_specification_id', 'pictures.path as picture', 'prices.price as price', 'models.name as name', 'model_specification.stockQuantity as stock');
            if($request->input('sort')!=null)
            {
                $sort = $request->input('sort');
                if($sort=='price'){
                    $products=$products->orderBy('prices.price', 'desc');
                }
                else if($sort=='name'){
                    $products=$products->orderBy('brands.name', 'desc');
                }
            }

            $products=$products->paginate(12);
            $new = [];
            foreach ($products as $product){
                $n = DB::table('model_specification')
                    ->join('specifications_individually', 'model_specification.id', '=', 'specifications_individually.model_specification_id')
                    ->join('specifications', 'specifications.id', '=', 'specifications_individually.specification_id')
                    ->select('specifications.name', 'model_specification.id')
                    ->whereIn('specifications.name', ['Yes', 'No'])
                    ->where('model_specification.id', $product->model_specification_id)
                    ->get();
                array_push($new, $n[0]);

            }



            return view('pages.main.shop', ['specifications' => $specifications, 'names' => $names, 'products' => $products, 'new' => $new, 'checkboxes'=>$niz]);

        }

    }
    public function show($id){
        $product = DB::table('model_specification')
            ->join('models', 'model_specification.model_id', '=', 'models.id')
            ->join('brands', 'models.brand_id', '=', 'brands.id')
            ->join('pictures', 'model_specification.id', '=', 'pictures.model_specification_id')
            ->join('prices', 'model_specification.id', '=', 'prices.model_specification_id')
            ->select('models.*', 'brands.name as brand_name', 'model_specification.id as model_specification_id', 'pictures.path as picture', 'prices.price as price', 'model_specification.stockQuantity as stock')
            ->where('model_specification.id', $id)
            ->first();
        $specifications = DB::table('specifications')
            ->join('specifications_individually', 'specifications.id', '=', 'specifications_individually.specification_id')
            ->select('specifications.*')
            ->where('specifications_individually.model_specification_id', $id)
            ->get();
        $names = DB::table('specifications')->where('parent_id', null)->get();
        $data= [];




        return view('pages.main.show', ['product' => $product, 'specifications' => $specifications, 'names' => $names, 'data' => $data]);
    }

    public function cart(){

        return view('pages.main.cart');
    }
    public function checkout(){
        $id = session()->get('user')->id;
        $info = User::find($id);
        return view('pages.main.checkout', ['info' => $info]);
    }
    public function api(){
        $products = DB::table('model_specification')
            ->join('models', 'model_specification.model_id', '=', 'models.id')
            ->join('brands', 'models.brand_id', '=', 'brands.id')
            ->join('pictures', 'model_specification.id', '=', 'pictures.model_specification_id')
            ->join('prices', 'model_specification.id', '=', 'prices.model_specification_id')
            ->select('models.*', 'brands.name as brand_name', 'model_specification.id as model_specification_id', 'pictures.path as picture', 'prices.price as price')
            ->distinct()
            ->get();
        return response()->json($products);
    }
    public function orderproducts(Request $request){
        $data= $request->input('cart');
        $card=$request->input('card');
        $id = session()->get('user')->id;
        $idU=DB::table('user_cart')->insertGetId([
            'user_id' => $id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
         foreach ($data as $d){
             DB ::table('purchases')->insert([
                 'user_cart_id' => $idU,
                 'model_specification_id' => $d['id'],
                 'quantity' => $d['quantity'],
                 'payment_method' => $card
             ]);
         }
         foreach ($data as $d){
             $quantity = DB::table('model_specification')
                 ->select('stockQuantity')
                 ->where('id', $d['id'])
                 ->get()
                 ->first();
             $newQuantity = $quantity->stockQuantity - $d['quantity'];
             DB::table('model_specification')
                 ->where('id', $d['id'])
                 ->update(['stockQuantity' => $newQuantity]);
         }

        return response()->json(['message' => 'Success']);




    }

}
