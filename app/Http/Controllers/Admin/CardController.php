<?php

namespace App\Http\Controllers\Admin;

use App\Models\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\cardFormRequest;

class CardController extends Controller
{
    // for index function
    public function index()
    {
        $cards=Card::all();
        return view('admin.cards.index',compact('cards'));
    }
    // saving card method function
    public function save(cardFormRequest $request)
    {
        $data=$request->validated();
        $card =new Card;
        $card->card_no=$data['card_no'];
        $card->membership_no=$data['membership_no'];
        $card->save();

        return redirect('admin/all-cards')->with('status','Card was Created Successfully');
    }


    // edit card page function
    public function edit($card_id)
    {
        $card=Card::find($card_id);
        return view('admin.cards.edit',compact('card'));
    }

  // update payment method function
  public function update(cardFormRequest $request,$card_id)
  {
      $data=$request->validated();
      $card =Card::find($card_id);
      $card->card_no=$data['card_no'];
      $card->membership_no=$data['membership_no'];
      // saving data
      $card->update();

      return redirect('admin/all-cards')->with('status','Card was Updated Successfully');
  }

// delete  card method function
    public function destroy($card_id)
    {
        $card=Card::find($card_id);

        if($card){
            $card->delete();
            return redirect('admin/all-cards')->with('status','Card method was deleted Successfully');
        }
        else{
            return redirect('admin/all-cards')->with('status','No Card method ID was found !');
        }
    }
}
