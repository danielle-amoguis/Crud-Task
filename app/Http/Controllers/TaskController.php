<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Events\TaskCreated;
use App\Events\TaskUpdated;
use App\Events\TaskDeleted;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
 
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
 
            'task' => 'required',
     
            'description' => 'required',
     
            ]);
     
            $task = Task::create($request->all());
            event(new TaskCreated($task));

            return redirect()->route('tasks.index')
                    ->with('success','Task created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $Task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show',compact('task'));
    }

    /**
     * Show algorithm.
     *
     * @param  \App\Task  $Task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit',compact('task'));
    }

    /**
     * Update algorithm for specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $Task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task' => 'required',
            'description' => 'required',
            ]);
     
            $task->update($request->all());
            event(new TaskUpdated($task));
            
            return redirect()->route('tasks.index')->with('success','Task updated successfully');
    }

    /**
     * Deletion algorithm
     *
     * @param  \App\Task  $Task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        event(new TaskDeleted($task->id));

        return redirect()->route('tasks.index')
                ->with('success','Task deleted successfully');
    }
}
