<?php

use App\CaffeinatedMenu;
use App\Http\Controllers;


/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => 'cors','prefix' => 'apiv1'], function () use ($router) {
    $router->get('getTags',  ['uses' => 'TagsController@getTags']);
    $router->get('getTag/{id}', ['uses' => 'TagsController@getTag']);
    $router->post('createTag', ['uses' => 'TagsController@createTag']);
    $router->post('updateTag', ['uses' => 'TagsController@updateTag']);
    $router->get('deleteTag/{id}', ['uses' => 'TagsController@deleteTag']);

    $router->get('getNotes',  ['uses' => 'NotesController@getNotes']);
    $router->get('getNote/{id}', ['uses' => 'NotesController@getNote']);
    $router->post('createNote', ['uses' => 'NotesController@createNote']);
    $router->post('updateNote', ['uses' => 'NotesController@updateNote']);
    $router->get('deleteNote/{id}', ['uses' => 'NotesController@deleteNote']);

});
