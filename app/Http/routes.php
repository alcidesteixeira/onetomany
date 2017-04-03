<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Post;
use App\User;

Route::get('/', function () {
    return view('welcome');
});

//create many posts - onetomany
Route::get('create', function(){

//Criar usar a partir do tinker
//  App\User::create(['name=>'Alcides','email'=>'adm@adm.com','password'=>bcrypt("123")]);

    $user = User::findOrFail(1);

    $post = new Post(['title'=>'new title', 'body'=>'body of post']);

    $user->posts()->save($post);
});
//read - onetomany
Route::get('read', function(){

    $user = User::findOrFail(1);

    foreach($user->posts as $post){

        echo $post->title. "<br>";
    }
    //return $user->posts;
});
//update - onetomany
Route::get('update', function(){

    $user = User::findOrFail(1);

    $user->posts()->whereId(1)->update(['title'=>'i love laravel', 'body'=>'another body stuff']);
    //return $user->posts;
});

//delete
Route::get('delete', function(){

    $user = User::findOrFail(1);

    $user->posts()->whereId(1)->delete();
    //return $user->posts;
});

//////////////////////////////
//Many to many - attach or detach data; sync data
//////////////////////////////
Route::get('attach', function(){

    $user = User::findOrFail(1);
//atribuir um role ao user com o attach
    $user->roles()->attach(2);

//retirar o role do user com detach
    $user->roles()->detach(2);

//sincroniza os roles: adiciona os q faltam, apaga os que nao são passados se já existirem
    $user->roles()->sync([1,2]);
});