<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
//Sanctum
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function test_task_list_can_be_retrieved_by_authenticated_user()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->get('/api/tasks');
        $response->assertOk();
    }

    // public function token(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         // Authentication passed...
    //         //Generate users session
    //         //$request->session()->regenerate();

    //         $token = $request->user()->createToken('token')->plainTextToken;
    //         return response()->json($data, 200);
    //     }else{
    //         return response()->json(['message' => 'Login incorrecto'], 401);
    //     }
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            //Generate users session
            //$request->session()->regenerate();

            $token = $request->user()->createToken('token')->plainTextToken;
            $data = [
                "status" => 200,
                "data" => [
                    'message' => 'Login correcto',
                    'user' => Auth::user(),
                    'token' => $token,
                ]
            ];
            return response()->json($data, 200);
        }else{
            return response()->json(['message' => 'Login incorrecto'], 401);
        }
    }
}
