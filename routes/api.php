<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// FUNCAO IRA RETORNAR UMA TAREFA POR ID
Route::get('/task/getTaskById/{id}', 'TaskController@getTaskById')->name('getTaskById');

// FUNCAO IRA RETORNAR TODAS AS TAREFAS 
Route::get('/task/getTasks', 'TaskController@getTasks')->name('getTasks');

// FUNCAO IRA ATUALIZAR OU SALVAR OS DADOS DE UMA TAREFA
Route::post('/task/salvar', 'TaskController@salvar')->name('salvar');

// FUNCAO IRA REMOVER UMA TAREFA
Route::any('/task/deletar/{id}', 'TaskController@deletar')->name('deletar');

// FUNCAO PARA ALTERACAO DE STATUS DE UMA TAREFA
Route::post('/task/alterar_status', 'TaskController@alterar_status')->name('alterar_status');