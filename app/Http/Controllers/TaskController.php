<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('welcome');
    }

    public function index()
    {
        $tasks=Task::orderBy('priority', 'asc')->get();
        $categories = Category::all();

        return view('index', compact('tasks','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasks=Task::all();

        return view('index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required',
            'priority' => 'required'
        ]);

        $task = new Task;
        $task->task_name = $request->task_name;
        $task->priority = $request->priority;
        $task->project_id = $request->project_id;
        $task->status = 'Pending';
        $task->save();


        return redirect()->route('task.index')->with('success','Task created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);

        return view('edit-task', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $task = Task::find($id);

        // dd($task);

        return view('edit-task', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task_name' => 'required',
            'priority' => 'required'
        ]);

        $task->task_name = $request->task_name;
        $task->priority = $request->priority;
        $task->project_id = $request->project_id;
        $task->status = $request->status;
        $task->save();

        $task->update($request->all());

        return redirect()->route('task.index')->with('success','Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::where('id',$id)->delete();

        return redirect()->route('task.index')->with('deleted','Journal deleted successfully');
    }
}
