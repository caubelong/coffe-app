<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserValidated;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::orderBy('created_at','desc')->get();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserValidated $request)
    {
        //
        $request->validated();
        $newUser = new User();
        $newUser->name=$request->get('name');
        $newUser->email=$request->get('email');
        $newUser->role_id=$request->get('role_id');
        $newUser->password=Hash::make($request->get('password'));
        $newUser->isActive=$request->get('isActive');
        $newUser->save();
        return response()->json($newUser);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserValidated $request, $id)
    {
        //
        $request->validated();
        $userUpdate = User::find($id);
        if($userUpdate){
            $userUpdate->name = $request->get('name');
            $userUpdate->email = $request->get('email');
            $userUpdate->role_id = $request->get('role_id');
            $userUpdate->isActive=$request->get('isActive');
            $userUpdate->save();
        }
        return response()->json($userUpdate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        $user->delete();
        return response()->json('delete succsess');
    }
}
