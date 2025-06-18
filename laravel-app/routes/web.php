<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

// ルートページをTODO一覧にリダイレクト
Route::get('/', function () {
    return redirect()->route('todos.index');
});

// TODOのリソースルート
Route::resource('todos', TodoController::class);

// TODO完了状態切り替え用の追加ルート
Route::patch('todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');
