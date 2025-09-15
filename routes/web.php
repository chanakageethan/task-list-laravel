<?php
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Task;





Route::get('/',function(){
  return redirect()->route('tasks.index');
});


Route::get('/tasks', function (){
    return view('index',[
        'tasks' => \App\Models\Task::latest()->where('completed',true)->get()
    ]);
})->name('tasks.index');

Route::view('/tasks/create','create')->name('tasks.create');

Route::get('/tasks/{id}/edit', function ($id) {
    return view('edit', [
        'task' => Task::findOrFail($id)
    ]);
})->name('tasks.edit');



Route::get('/tasks/{id}',function($id) {
   return view('show',['task'=> Task::findOrFail($id)]);
})->name('tasks.show');


Route::post('/tasks',function (Request $request){
  $data = $request->validate([
    'title' => 'required|max:255',
    'description' => 'required',
    'long_description' => 'required'
  ]);


  $task = new Task;
  $task->title = $data['title'];
  $task->description = $data['description'];
  $task->long_description = $data['long_description'];
  $task->save();


  
  return redirect()->route('tasks.show',['id' =>$task->id])
  ->with('success','Task created successfully!');
})->name('tasks.store');



Route::put('/tasks/{id}',function ($id,Request $request){
  $data = $request->validate([
    'title' => 'required|max:255',
    'description' => 'required',
    'long_description' => 'required'
  ]);


  $task = Task::findOrFail($id);
  $task->title = $data['title'];
  $task->description = $data['description'];
  $task->long_description = $data['long_description'];
  $task->save();


  
  return redirect()->route('tasks.show',['id' =>$task->id])
  ->with('success','Task Updated successfully!');
})->name('tasks.update');



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