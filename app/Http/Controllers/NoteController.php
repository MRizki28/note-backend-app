<?php

namespace App\Http\Controllers;

use App\Models\NoteModel;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    //
    public function index()
    {
        $note = NoteModel::all();

        return response()->json([
            'message' => "Success Tampilkan Data",
            'data' => $note
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'title' => 'required',
            'note' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Failed',
                'errors' => $validator->errors()
            ], Response::HTTP_NOT_ACCEPTABLE);
        }

        $validator = $validator->validate();
        try {
            $createdNote = NoteModel::create($validator);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed',
                'errors' => $th->getMessage()
            ]);
        }
        
        return response()->json([
            "message" => "Success add data",
            "data" => $createdNote
        ]);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
        [
            'title' => '',
            'note' => ''

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'failed',
                'errors' =>$validator->errors()
            ], Response::HTTP_NOT_ACCEPTABLE);
        }

        $validated = $validator->validate();

        try {
            $note = NoteModel::findOrFail($id);
            $note->update($validated);
        } catch (\Throwable $th) {

            return response()->json([
                'message' =>'failed',
                'error' => $th->getMessage()
            ]);
            //throw $th;
        }

        return response()->json([
            'message' => 'succes update data',
            'data' => $note
        ]);
    }
}


