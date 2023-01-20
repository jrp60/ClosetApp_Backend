<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outfit;
use Illuminate\Support\Facades\ Auth;

class OutfitController extends Controller
{
    public function index(){
        // if( Auth::check() ) {
        //     // El usuario está correctamente autenticado
        //     echo "El usuario está correctamente autenticado";
        //     if(Auth::user() == null){
        //         echo "El usuario es null";
        //         return response()->json(
        //             ['error'=>true,
        //             'msg'=>'Unauthenticated']
        //             , 401 );
        //     }
        //     else{
        //         echo "El usuario no es null";
        //         $outfits = Outfit::all();

        //     return response()->json($outfits);
        //     }
            
        // }
        // else {
        //     // El usuario no está autenticado
        //     echo "El usuario no está autenticado";
        //     //return response()->json(['error' => 'Unauthenticated.'], 401);
        //     return response()->json(
        //         ['error'=>true,
        //         'msg'=>'Unauthenticated']
        //         , 401 );
        // }
        $outfits = Outfit::all();

        if($outfits == null){
            return response()->json(
                ['error'=>true,
                'msg'=>'Unauthenticated']
                , 401 );
        }
        else{
            return response()->json($outfits);
        }

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

    //TODO - maybe make putLikesPlus and putLikesLess
    public function putLikes($id_outfit, $quantity){
        $outfit = Outfit::find($id_outfit);
        $outfit->likes = $outfit->likes + $quantity;
        $outfit->save();
        Alert::success('Outfit', ' guardado correctamente');

        return response()->json($outfit);
    }
}
