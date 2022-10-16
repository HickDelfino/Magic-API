<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\User;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $param =  isset($_GET['test']) ? $_GET['test'] : null;
        return [
            'hello' => "world",
            'returned' => $param
        ];
    }

    /**
     * Generate a new random card for the user
     */
    public function generate()
    {
        //Generate a new card object for the user
        return [
            'generated' => rand(1, 10)
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //Store a card for related user
        $card = new Card;

        $card->classe = $request->classe;
        $card->arma = $request->arma;
        $card->hp = $request->hp;
        $card->mana = $request->mana;
        $card->stamina = $request->stamina;
        $card->forca = $request->forca;
        $card->qi = $request->qi;

        $user = User::find($id)->first();

        $user->cards()->save($card);

        return ["success"=>"card succesfully saved"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get all cards of the related user
        $user = User::find($id);
        if ($user) return $user->cards()->get();
        else return ["error" => "user does not exist"];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId, $cardId)
    {
        //Delete a specific card of related user

        $user = User::find((int) $userId);
        if (!$user) return ["error" => "user does not exist"];

        $card = $user->cards()->find((int)$cardId);

        if(!$card) return ["error" => "card does not exist"];

        $card->delete();

        return ["succesful"=>"card succesfully deleted"];
    }
}
