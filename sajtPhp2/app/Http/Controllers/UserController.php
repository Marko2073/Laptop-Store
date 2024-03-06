<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardRequest;
use App\Http\Requests\CreditCardRequest;
use App\Models\Credit_card;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function usercard()
    {

        if (!empty(session()->get('user'))) {
            $usercard = User::find(session()->get('user')->id)->credit_cards;
        }
        else {
            $usercard = [];
        }


        return $usercard;

    }
    public function storecard(CardRequest $request)
    {
        $card = new Credit_card();
        $card->card_number = $request->input('cardnumber');
        $card->card_name = $request->input('cardname');
        $card->expiration_date = $request->input('expirationdate');
        $card->cvv = $request->input('cvv');
        $card->user_id = session()->get('user')->id;
        $card->save();
        DB::table('log')->insert([
            'log_type_id' => 6,
            'user_id' => session()->get('user')->id,
            'description' => 'User ' . session()->get('user')->firstname . ' ' . session()->get('user')->lastname . ' has added a new credit card.',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('profile');
    }
    public function updatecard(CardRequest $request)
    {
        $card = Credit_card::find($request->input('cardid'));
        $card->card_number = $request->input('cardnumber');
        $card->card_name = $request->input('cardname');
        $card->expiration_date = $request->input('expirationdate');
        $card->cvv = $request->input('cvv');
        $card->save();
        DB::table('log')->insert([
            'log_type_id' => 7,
            'user_id' => session()->get('user')->id,
            'description' => 'User ' . session()->get('user')->firstname . ' ' . session()->get('user')->lastname . ' has updated his credit card.',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->route('profile');

    }

    public function addreview(Request $request)
    {
        $review = new Review();
        $review->user_id = session()->get('user')->id;
        $review->model_specification_id = $request->input('product_id');
        $review->content = $request->input('userreview');
        $review->rating = $request->input('rating');
        $review->save();
        return redirect()->route('show', $request->input('product_id'));
    }


}
