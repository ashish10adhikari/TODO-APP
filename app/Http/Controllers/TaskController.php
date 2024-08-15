<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(){
        $tasks= Task::all();
        return view('index',compact('tasks'));
    }

    public function addtask(Request $request){
        $task= new Task;
        $task->title= $request->title;
        $task->save();

        return response()->json(['title' => $task->title, 'id' => $task->id]);
    }

    public function delete($id){
        $task= Task::find($id);
        $task->delete();
        return redirect('/');
    }

    public function update(Request $request, $id){
        $task= Task::find($id);
        $task->completed=$request->completed? 1:0;
        $task->save();
        return redirect('/');
    }
}
