<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;

class TaskManager extends Controller
{
    function listTask()
    {
        $task = Tasks::where("userid", auth()->user()->id)->where("status", NULL)->paginate(5);
        return view("welcome", compact('task'));
    }
    function addTask()
    {
        return view(view:'tasks.add');
    }
    function addTaskPost(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'deadline'=>'required',
        ]);
        $task               = new Tasks();
        $task->title        = $request->title;
        $task->description  = $request->description;
        $task->deadline     = $request->deadline;
        $task->userid       = auth()->user()->id;
        if($task->save()){
            return redirect(route(name:"home"))->with("sucess", "Task added successfully");
        }
        return redirect(route("task.add"))->with("error", "Task not Added");
    }

    function updateTaskStatus($id)
    {
        if(Tasks::where("userid", auth()->user()->id)->where('id', $id)->update(['status' => "completed"])){
            return redirect(route("home"))->with("success", "Task Completed");
        }
        return redirect(route("home"))->with("error", "Error Occured! Try again.");
    }

    function deteleTask($id)
    {
        if(Tasks::where("userid", auth()->user()->id)->where('id', $id)->delete(['status' => "completed"])){
            return redirect(route("home"))->with("success", "Task Deleted");
        }
        return redirect(route("home"))->with("error", "Error Occured! Try again.");
    }

}
