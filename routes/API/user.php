<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//create user
Route::get('/create/users',function (Request $request){
    $key = 'Alpha-254-1991-34171163';


    if($request['users']){
        $users = collect($request['users']);

        $users->each(function ($user) use ($key){
            if (!$user['key'] || !($user['key'] == $key)) {
                abort("403", "UNAUTHORIZED");
            }

            try {
                return User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'account_type' => $user['account_type'],
                    'password' => bcrypt($user['password']
                    )]
                );
            } catch (Exception $e) {
                return "Error adding user";
            }
        });
    }



//

});


//get all users
Route::middleware('auth:sanctum')->group(function (){

    //get user by id
    Route::get('/user/{user}',function (Request $request,User $user){
        return $user;
    });

    //get authenticated user
    Route::get('/getCurrentUser',function (Request $request){
        return \Illuminate\Support\Facades\Auth::user();
    });

    //get all users
    Route::get('/users',function (Request $request){
        return User::all();
    });
});



