<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Brand;
use App\Models\ModelSpec;
use App\Models\Purchase;
use App\Models\Specification;
use App\Models\User;
use App\Models\User_cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Modeli;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
                ->join('prices', 'model_specification.id', '=', 'prices.model_specification_id')

                ->select('models.*', 'brands.name as brand_name', 'model_specification.id as model_specification_id',  'prices.price as current_price', 'model_specification.stockQuantity as stock')

                ->addSelect(DB::raw('(SELECT price FROM prices AS p2 WHERE p2.model_specification_id = model_specification.id AND p2.date_to < NOW() ORDER BY p2.date_to DESC LIMIT 1) AS old_price'))
                ->distinct()
                ->where('prices.date_to', '>', now())
                ->paginate(12);
            foreach ($products as $product){
                $picture = DB::table('pictures')
                    ->select('path')
                    ->where('model_specification_id', $product->model_specification_id)
                    ->first();
                $product->picture = $picture->path;

            }
            foreach ($products as $product){
                $product->rating = DB::table('reviews')
                    ->select(DB::raw('AVG(rating) as rating'))
                    ->where('model_specification_id', $product->model_specification_id)
                    ->first();
                $product->rating = $product->rating->rating;
                $numOfReviews = DB::table('reviews')
                    ->where('model_specification_id', $product->model_specification_id)
                    ->count();
                $product->numOfReviews = $numOfReviews;


            }

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

            $products=$products->select('models.*', 'brands.name as brand_name', 'model_specification.id as model_specification_id',  'prices.price as price', 'models.name as name', 'model_specification.stockQuantity as stock', 'prices.price as current_price')
                ->addSelect(DB::raw('(SELECT price FROM prices AS p2 WHERE p2.model_specification_id = model_specification.id AND p2.date_to < NOW() ORDER BY p2.date_to DESC LIMIT 1) AS old_price'));
            if($request->input('sort')!=null)
            {
                $sort = $request->input('sort');
                if($sort=='price'){
                    $products=$products->orderBy('prices.price', 'asc');
                }
                else if($sort=='name'){
                    $products=$products->orderBy('brands.name', 'asc');
                }
                else if($sort=='priceDesc'){
                    $products=$products->orderBy('prices.price', 'desc');
                }
                else if($sort=='nameDesc'){
                    $products=$products->orderBy('brands.name', 'desc');
                }
            }
            $products=$products->where('prices.date_to', '>', now());


            $products=$products->paginate(12);
            foreach ($products as $product){
                $picture = DB::table('pictures')
                    ->select('path')
                    ->where('model_specification_id', $product->model_specification_id)
                    ->first();
                $product->picture = $picture->path;

            }
            foreach ($products as $product) {
                $product->rating = DB::table('reviews')
                    ->select(DB::raw('AVG(rating) as rating'))
                    ->where('model_specification_id', $product->model_specification_id)
                    ->first();
                $product->rating = $product->rating->rating;
                $numOfReviews = DB::table('reviews')
                    ->where('model_specification_id', $product->model_specification_id)
                    ->count();
                $product->numOfReviews = $numOfReviews;
            }
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
            ->join('prices', 'model_specification.id', '=', 'prices.model_specification_id');
        $product=$product->select('models.*', 'brands.name as brand_name', 'model_specification.id as model_specification_id',  'prices.price as price', 'models.name as name', 'model_specification.stockQuantity as stock', 'prices.price as current_price')
            ->addSelect(DB::raw('(SELECT price FROM prices AS p2 WHERE p2.model_specification_id = model_specification.id AND p2.date_to < NOW() ORDER BY p2.date_to DESC LIMIT 1) AS old_price'));
        $product=$product->where('model_specification.id', $id);
            $product=$product->where('prices.date_to', '>', now())
            ->first();
        $pictures = DB::table('pictures')
            ->select('path')
            ->where('model_specification_id', $id)
            ->get();
        $ratings = DB::table('reviews')
            ->select(DB::raw('AVG(rating) as rating'))
            ->where('model_specification_id', $id)
            ->get();



        $specifications = DB::table('specifications')
            ->join('specifications_individually', 'specifications.id', '=', 'specifications_individually.specification_id')
            ->select('specifications.*')
            ->where('specifications_individually.model_specification_id', $id)
            ->distinct()
            ->get();
        $names = DB::table('specifications')->where('parent_id', null)->get();
        $data= [];
        $reviews = DB::table('reviews')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->select('reviews.*', 'users.firstname as name', 'users.lastname as surname', 'users.path as path')
            ->where('model_specification_id', $id)
            ->paginate(5);

        $countReviews = DB::table('reviews')
            ->where('model_specification_id', $id)
            ->count();
        $ratings=$ratings[0]->rating;
        $product->rating = $ratings;

        $numOfReviews = DB::table('reviews')
            ->where('model_specification_id', $id)
            ->count();





        return view('pages.main.show', ['product' => $product, 'specifications' => $specifications, 'names' => $names, 'data' => $data, 'reviews' => $reviews, 'countReviews' => $countReviews, 'pictures' => $pictures, 'ratings' => $ratings, 'numOfReviews' => $numOfReviews]);
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
            ->join('prices', 'model_specification.id', '=', 'prices.model_specification_id')

            ->select('models.*', 'brands.name as brand_name', 'model_specification.id as model_specification_id',  'prices.price as current_price', 'model_specification.stockQuantity as stock')

            ->addSelect(DB::raw('(SELECT price FROM prices AS p2 WHERE p2.model_specification_id = model_specification.id AND p2.date_to < NOW() ORDER BY p2.date_to DESC LIMIT 1) AS old_price'))
            ->distinct()
            ->where('prices.date_to', '>', now())
            ->get();
        foreach ($products as $product){
            $picture = DB::table('pictures')
                ->select('path')
                ->where('model_specification_id', $product->model_specification_id)
                ->first();
            $product->picture = $picture->path;

        }
        return response()->json($products);
    }
    public function orderproducts(Request $request){
        DB::beginTransaction();

        try {
            $data = $request->input('cart');
            $card = $request->input('card');
            $id = session()->get('user')->id;
            $idU = DB::table('user_cart')->insertGetId([
                'user_id' => $id,
                'created_at' => now(),
            ]);

            foreach ($data as $d) {
                DB::table('purchases')->insert([
                    'user_cart_id' => $idU,
                    'model_specification_id' => $d['id'],
                    'quantity' => $d['quantity'],
                    'payment_method' => $card
                ]);
            }

            foreach ($data as $d) {
                $quantity = DB::table('model_specification')
                    ->select('stockQuantity')
                    ->where('id', $d['id'])
                    ->lockForUpdate()
                    ->first();

                $newQuantity = $quantity->stockQuantity - $d['quantity'];
                DB::table('model_specification')
                    ->where('id', $d['id'])
                    ->update(['stockQuantity' => $newQuantity]);
            }

            DB::commit();
            $user = User::find($id);
            $subject = 'Order';

            $poruka = 'Your order has been successfully placed!';
            $mail = $user->email;
            $products = [];
            $total = 0;
            foreach ($data as $d) {
                $product = DB::table('model_specification')
                    ->join('models', 'model_specification.model_id', '=', 'models.id')
                    ->join('brands', 'models.brand_id', '=', 'brands.id')
                    ->join('pictures', 'model_specification.id', '=', 'pictures.model_specification_id')
                    ->join('prices', 'model_specification.id', '=', 'prices.model_specification_id')
                    ->select('models.*', 'brands.name as brand_name', 'model_specification.id as model_specification_id', 'pictures.path as picture', 'prices.price as price')
                    ->where('model_specification.id', $d['id'])
                    ->first();
                $product->quantity = $d['quantity'];
                array_push($products, $product);
                $total += $product->price * $d['quantity'];
            }



            DB::table('log')->insert([
                'log_type_id' => 4,
                'user_id' => $id,
                'description' => 'User ' . $user->firstname . ' ' . $user->lastname . ' has placed an order.',
                'created_at' => now()
            ]);

            Mail::to($mail)->send(new OrderMail($user, $subject, $poruka, $mail, $products, $data, $total));

            return response()->json(['message' => 'Success']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function search($param)
    {

        $products = DB::table('model_specification')
            ->join('models', 'model_specification.model_id', '=', 'models.id')
            ->join('brands', 'models.brand_id', '=', 'brands.id')
            ->join('prices', 'model_specification.id', '=', 'prices.model_specification_id')
            ->select('models.*', 'brands.name as brand_name', 'model_specification.id as model_specification_id',  'prices.price as current_price', 'model_specification.stockQuantity as stock')
            ->where('prices.date_to', '>', now())
            ->where(function($query) use ($param) {
                $query->where('models.name', 'like', '%'.$param.'%')
                    ->orWhere('brands.name', 'like', '%'.$param.'%');
            })
            ->get();

        foreach ($products as $product){
            $picture = DB::table('pictures')
                ->select('path')
                ->where('model_specification_id', $product->model_specification_id)
                ->first();
            $product->picture = $picture->path;

        }




        return response()->json($products);


    }


}
