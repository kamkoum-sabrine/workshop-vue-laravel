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

    public function read(){
        $todos = Todo::all();
        if (empty($todos)){
            return response()->json(["message" => "Auncune tache trouvée"]);
        }
        else {
            return response()->json(["data" => $todos], 200);
        }
    }
    public function update(Request $request, $id){
        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json([
                "message" => "Tache non trouvée",
            ], 404);
        }
        else {
            $todo->update(
                [
                    "title" => $request->input('title'),
                    "description" => $request->input('description'),
                    "priority" => $request->input('priority'),
                ]
            );
            return response()->json(["data" => $todo], 200);
        }
    }
}
