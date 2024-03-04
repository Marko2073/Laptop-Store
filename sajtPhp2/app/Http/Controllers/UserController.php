<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardRequest;
use App\Http\Requests\CreditCardRequest;
use App\Models\Credit_card;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

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
        return redirect()->route('profile');
    }

    public function addreview(Request $request)
    {
        $review = new Review();
        $review->user_id = session()->get('user')->id;
        $review->model_specification_id = $request->input('product_id');
        $review->content = $request->input('userreview');
        $review->save();
        return redirect()->route('show', $request->input('product_id'));
    }


}
