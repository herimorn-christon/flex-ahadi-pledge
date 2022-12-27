<?php

namespace App\Http\Controllers\Admin;

use App\Models\Card;
use App\Models\CardMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\cardMemberFormRequest;

class CardMemberController extends Controller
{
    // assigning card method function
    public function save(cardMemberFormRequest $request)
    {
        $data=$request->validated();

        $card_no=$data['card_no'];
        $card =Card::find($card_no);
        $card->status=1;
        $card->update();
        
        $cardMember =new CardMember;
        $cardMember->card_no=$data['card_no'];
        $cardMember->user_id=$data['user_id'];
        $cardMember->save();



        return redirect('admin/all-cards')->with('status','Card was Assigned Successfully');
    }
    

}