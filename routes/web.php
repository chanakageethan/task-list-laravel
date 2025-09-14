<?php
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;






Route::get('/',function(){
  return redirect()->route('tasks.index');
});


Route::get('/tasks', function (){
    return view('index',[
        'tasks' => \App\Models\Task::latest()->where('completed',true)->get()
    ]);
})->name('tasks.index');

Route::get('/tasks/{id}',function($id) {
   return view('show',['task'=> \App\Models\Task::findOrFail($id)]);
})->name('tasks.show');

// Route::get('/hello', function () {
//     return 'Hello';
// })->name('hello');


// Route::get('/halo',function(){
//     return redirect()->route('hello');
// });


// Route::get('/greet/{name}', function ($name) {
//     return 'Hel
//     lo' . $name . '!';
// });


Route::fallback(function(){
    return 'still got somewhere!';
});