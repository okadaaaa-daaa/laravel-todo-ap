<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::latest()->get();
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable'
        ]);

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => false
        ]);

        return redirect()->route('todos.index')->with('success', 'TODOが作成されました！');
    }

    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable'
        ]);

        $todo->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->route('todos.index')->with('success', 'TODOが更新されました！');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')->with('success', 'TODOが削除されました！');
    }

    public function toggle(Todo $todo)
    {
        $todo->update(['completed' => !$todo->completed]);
        return redirect()->route('todos.index');
    }
}