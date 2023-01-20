<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outfit;
use Illuminate\Support\Facades\ Auth;

class OutfitController extends Controller
{
    public function index(){
        $outfits = Outfit::all();

        return response()->json($outfits);
        
    }

    public function postCreate(Request $request){
        $outfit = new Outfit();
        $outfit->name = $request->name;
        $outfit->description = $request->description;
        $outfit->image = $request->image;
        $outfit->category = $request->category;
        $outfit->price = $request->price;
        $outfit->size = $request->size;
        $outfit->color = $request->color;
        $outfit->likes = $request->likes;
        $outfit->imageBin = $request->imageBin;
        $outfit->save();
        Alert::success('Outfit', ' guardado correctamente');

        return response()->json($outfit);
    }
}
