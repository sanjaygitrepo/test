<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Traits\ThrottlesAttempts;
use Auth;
class UserController extends Controller
{
    use ThrottlesAttempts;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['message'=>'users list','users'=>User::all()],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return response()->json(['message'=>'register successfully'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json(['user'=>$user],200);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message'=>'User deleted successfully'],200);

    }

    public function login(Request $request)
    {
          if($this->hasTooManyAttempts($request))
                {
                    return $this->sendLockoutResponse($request);
                }
                $credentials=['email'=>$request->email,'password'=>$request->password];
                if (!Auth::attempt($credentials)) {
                    $this->incrementAttempts($request);

                    return response()->json([
                        'status_code' => 401,
                        'message' => 'Unauthorized'
                    ]);
                }
                //auth attempt good
                $user=User::where('email',$request->email)->first();
                $this->clearAttempts($request);

                return response()->json([
                        'status_code' => 200,
                        'user' => $user
                    ],200);

                //w.e else you do
    }
}
