<?php

namespace App\Http\Controllers;

use App\Models\Credit_card;
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
    public function storecard(Request $request)
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
    public function updatecard(Request $request)
    {
        $card = Credit_card::find($request->input('cardid'));
        $card->card_number = $request->input('cardnumber');
        $card->card_name = $request->input('cardname');
        $card->expiration_date = $request->input('expirationdate');
        $card->cvv = $request->input('cvv');
        $card->save();
        return redirect()->route('profile');
    }


}
