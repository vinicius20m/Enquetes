<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class VoteController extends Controller
{

    /**
     * Vote.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function vote($id)
    {

        $option = Option::find($id);
        $enquete = $option->enquete ;
        if($enquete->status == 'STARTED')
            $option->update(['votes' => $option->votes +1])
        ;

        return response()->json(['sucesso' => true]) ;
    }
}
