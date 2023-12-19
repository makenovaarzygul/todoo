<?php

namespace App\Http\Controllers;

use App\Models\Todo;

class TodoExtendController extends Controller
{
    public function calendar()
    {
        $todos = Todo::orderBy('priority')->where('user_id', auth()->id())->get();

        return view('todo.calendar', compact('todos'));
    }
}
