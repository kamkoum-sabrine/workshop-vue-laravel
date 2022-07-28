<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function create(Request $request){
        $todo = Todo::create(
            [
                "title" => $request->input('title'),
                "description" => $request->input('description'),
                "priority" => $request->input('priority'),
            ]
        );
        return response()->json(["data" => $todo], 201);
    }
}
