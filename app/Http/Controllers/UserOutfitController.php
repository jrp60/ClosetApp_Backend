<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserOutfit;

class UserOutfitController extends Controller
{
    //

    public function postCreate($id_user, $id_outfit){
        $uo = new UserOutfit();
        $uo->id_user = $id_user;
        $uo->id_outfit = $id_outfit;
        $uo->liked = 1;
        $uo->save();

        return response()->json($uo);
    }

    public function putChangelike($id_user, $id_outfit){
        $uo = UserOutfit::where('id_user', $id_user)->where('id_outfit', $id_outfit)->first();
        $uo->liked = !$uo->liked;
        $uo->save();

        return response()->json($uo);
    }

    public function getLiked($id_user, $id_outfit){
        $uo = UserOutfit::where('id_user', $id_user)->where('id_outfit', $id_outfit)->first();
        return response()->json($uo);
    }
}
