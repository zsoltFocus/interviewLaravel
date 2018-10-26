<?php

namespace App\Http\Controllers;

use App\ToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ToDoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Auth::user()->todos->all();

        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
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
            'todo' => 'required|max:255',
        ]);

        $todo = new ToDo;
        $todo->todo = $request->todo;

        Auth::user()->todos()->save($todo);

        $request->session()->flash('alert-success', 'ToDo was successful added!');
        return redirect()->action('ToDoController@create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = ToDo::where('id', $id)->first();

        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'todo' => 'required|max:255',
        ]);

        $todo = Auth::user()->todos()->where('id', $id)->first();
        $todo->todo = $request->todo;

        $todo->save();

        Session::flash('alert-success', 'ToDo was successful updated!');
        return redirect()->action('ToDoController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Auth::user()->todos->where('id', $id)->first();
        $todo->delete();

        Session::flash('alert-success', 'ToDo was successful deleted!');
        return redirect()->action('ToDoController@index');
    }

    /**
     * Mark the specified resource as done.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function done($id)
    {
        $todo = Auth::user()->todos->where('id', $id)->first();
        $todo->done = true;
        $todo->save();

        $todos = Auth::user()->todos->all();

        return view('todo.index', compact('todos'));
    }

    /**
     * Mark the specified resource as not done.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function undone($id)
    {
        $todo = Auth::user()->todos->where('id', $id)->first();
        $todo->done = false;
        $todo->save();

        $todos = Auth::user()->todos->all();

        return view('todo.index', compact('todos'));
    }
}
