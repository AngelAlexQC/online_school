<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseClassTask;
use Illuminate\Http\Request;

class CourseClassTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the tasks
        $courseClassTask = CourseClassTask::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'endline' => 'required',
            'course_class_id' => 'required',
        ]);

        // Create a new task
        $courseClassTask = new CourseClassTask();
        $courseClassTask->name = $request->name;
        $courseClassTask->description = $request->description;
        $courseClassTask->endline = $request->endline;
        $courseClassTask->course_class_id = $request->course_class_id;
        $courseClassTask->save();

        // Return the newly created task
        return $courseClassTask;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseClassTask  $courseClassTask
     * @return \Illuminate\Http\Response
     */
    public function show($courseClassTask)
    {
        // Return the specified task
        return CourseClassTask::find($courseClassTask);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseClassTask  $courseClassTask
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseClassTask $courseClassTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $courseClassTask)
    {
        $task = CourseClassTask::find($courseClassTask);
        // Validate the request
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'content' => 'required',
            'endline' => 'required',
            'course_class_id' => 'required',
        ]);

        // Update the task
        $task->name = $request->name;
        $task->description = $request->description;
        $task->content = $request->content;
        $task->endline = $request->endline;
        $task->course_class_id = $request->course_class_id;
        $task->save();

        // Return the updated task
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($courseClassTask)
    {
        // Delete the task
        $task = CourseClassTask::find($courseClassTask);
        // Return a no content as response
        return response()->json($task->delete(), 200);
    }
}
