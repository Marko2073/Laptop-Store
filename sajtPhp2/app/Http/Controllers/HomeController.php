<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends OsnovniController

{
    public function index(){



        $seed = date("Ymd");
        mt_srand($seed);





        $productsRandom = DB::table('model_specification')
            ->join('models', 'model_specification.model_id', '=', 'models.id')
            ->join('brands', 'models.brand_id', '=', 'brands.id')
            ->join('pictures', 'model_specification.id', '=', 'pictures.model_specification_id')
            ->join('prices', 'model_specification.id', '=', 'prices.model_specification_id')
            ->join('specifications_individually', 'model_specification.id', '=', 'specifications_individually.model_specification_id')
            ->join('specifications', 'specifications.id', '=', 'specifications_individually.specification_id')
            ->select('models.*', 'brands.name as brand_name', 'model_specification.id as model_specification_id', 'pictures.path as picture', 'prices.price as price', 'models.name as name', 'model_specification.stockQuantity as stock', 'prices.price as current_price')
            ->addSelect(DB::raw('(SELECT price FROM prices AS p2 WHERE p2.model_specification_id = model_specification.id AND p2.date_to < NOW() ORDER BY p2.date_to DESC LIMIT 1) AS old_price'))
            ->where('prices.date_to', '>', now())
            ->distinct()
            ->inRandomOrder($seed)
            ->take(3)
            ->get();


        return view('pages.main.index' , [ 'productsRandom' => $productsRandom]);
    }

    public function profile(){
        $info = DB::table('users')
            ->where('id', session()->get('user')->id)
            ->get()
            ->first();
        if (!empty(session()->get('user'))) {
            $usercard = User::find(session()->get('user')->id)->credit_cards;
        }
        else {
            $usercard = [];
        }
        $user_carts = DB::table('user_cart')
            ->where('user_id', session()->get('user')->id)

            ->get();

        $orders = DB::table('purchases')
            ->join('model_specification', 'purchases.model_specification_id', '=', 'model_specification.id')
            ->join('models', 'model_specification.model_id', '=', 'models.id')
            ->join('brands', 'models.brand_id', '=', 'brands.id')
            ->join('pictures', 'model_specification.id', '=', 'pictures.model_specification_id')
            ->join('prices', 'model_specification.id', '=', 'prices.model_specification_id')
            ->join('user_cart', 'purchases.user_cart_id', '=', 'user_cart.id')
            ->join('users', 'user_cart.user_id', '=', 'users.id')
            ->leftJoin('credit_cards', 'purchases.payment_method', '=', 'credit_cards.id')
            ->select('models.*', 'brands.name as brand_name', 'model_specification.id as model_specification_id', 'pictures.path as picture', 'prices.price as price', 'purchases.*', DB::raw("IF(purchases.payment_method = 0, 'Cash', credit_cards.card_name) as payment_method_name"


            ))
            ->whereIn('purchases.user_cart_id', $user_carts->pluck('id'))
            ->get();
        $picture= DB::table('users')
            ->where('id', session()->get('user')->id)
            ->select('path')
            ->get()
            ->first();






        return view('pages.main.profile', ['info' => $info, 'usercard' => $usercard, 'orders' => $orders, 'user_carts' => $user_carts, 'picture' => $picture]);
    }
}
