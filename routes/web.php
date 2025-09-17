<?php
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Task;





Route::get('/', function () {
  return redirect()->route('tasks.index');
});


Route::get('/tasks', function () {
  return view('index', [
    // 'tasks' => \App\Models\Task::latest()->where('completed', true)->paginate(5)
    'tasks' => \App\Models\Task::latest()->paginate(5)
  ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function (Task $task) {
  return view('edit', [
    'task' => $task
  ]);
})->name('tasks.edit');



Route::get('/tasks/{task}', function (Task $task) {
  return view('show', ['task' => $task]);
})->name('tasks.show');


Route::post('/tasks', function (TaskRequest $request) {

  // $data = ;

  // $task = new Task;
  // $task->title = $data['title'];
  // $task->description = $data['description'];
  // $task->long_description = $data['long_description'];
  // $task->save();

  $task = Task::create($request->validated());



  return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success', 'Task created successfully!');
})->name('tasks.store');



Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {

  // $data = ;

  // $task = $task;
  // $task->title = $data['title'];
  // $task->description = $data['description'];
  // $task->long_description = $data['long_description'];
  // $task->save();

  $task->update($request->validated());

  return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success', 'Task Updated successfully!');
})->name('tasks.update');


Route::delete('tasks/{task}', function (Task $task) {
  $task->delete();

  return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
})->name('tasks.destroy');


Route::put('tasks/{task}/toggle-complete', function (Task $task) {
  $task->toggleComplete();


  return redirect()->back()->with('success', 'Task updated successuflly');

})->name('tasks.toggle-complete');



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


Route::fallback(function () {
  return 'still got somewhere!';
});