<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $notes = Note::where('user_id', $request->user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return response(['data' => $notes], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'   => 'nullable|exists:users,id',
            'title'     => 'required|string|max:255',
            'note'      => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $note = new Note();
        $note->user_id  = $request->user()->id;
        $note->title    = $request->title;
        $note->note     = $request->note;
        $note->save();

        return response(['data' => $note], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return response(['data' => $note], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $validator = Validator::make($request->all(), [
            'user_id'   => 'nullable|exists:users,id',
            'title'     => 'required|string|max:255',
            'note'      => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $note->update([
            'user_id'   => $request->user()->id,
            'title'     => $request->title,
            'note'      => $request->note,
        ]);

        return response(['data' => $note], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return response(['data' => $note], 200);
    }
}
