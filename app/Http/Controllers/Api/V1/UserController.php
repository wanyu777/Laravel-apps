<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UpdateUserRequest;
use App\Http\Requests\V1\StoreUserRequest;
use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\UserCollection;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        // $users = User::all();
        return new UserCollection(User::all());
    }

    public function store(StoreUserRequest $request){
        return new UserResource(User::create($request->all()));
    }
    public function show($id){      
        // return new UserResource($user);
    return User::findOrFail($id);
    }
    public function update(UpdateUserRequest $request, User $user){
        $user->update($request->all());
    }
    public function destroy(User $user){
        $user->delete();
    }
}
