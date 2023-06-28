<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDo;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $todos = ToDo::where('active', 1)->paginate(10);

        return response()->json($todos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = ToDo::create($request->all());
        return response()->json($todo, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ToDo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(ToDo $todo)
    {
        return response()->json($todo, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ToDo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToDo $todo)
    {
        $todo->update($request->all());
        return response()->json($todo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ToDo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToDo $todo)
    {
        abort(404);
    }
}
