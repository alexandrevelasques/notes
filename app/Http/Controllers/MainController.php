<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $id = session('user.id');
        //Using softdelete in the model eliminates the need to include it here.
        $notes = User::find($id)->notes()->get()->toArray();
        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        return view('new_note');
    }

    public function newNoteSubmit(Request $request)
    {
        $request->validate(
            [
                //Validation Rules
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000'
            ],
            [
                //Personalized Messages
                'text_title.required' => 'O título é obrigatorio',
                'text_title.min' => 'O título deve ter pelo menos :min caracteres',
                'text_title.max' => 'O título deve ter no máximo:max caracteres',
                'text_note.required' => 'A nota é obrigatória',
                'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max' => 'A nota deve ter no máximo :max caracteres'

            ]
        );

        $id = session('user.id');


        //saving new note
        $note = New Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->route('home');


    }

    public function editNote($id)
    {

        $id = Operations::decryptId($id);

        if ($id === null) {
            return redirect()->route('home');
        }

        $note  = Note::find($id);

        return view('edit_note', ['note' => $note]);

    }

    public function editNoteSubmit(Request $request){
        $request->validate(
            [
                //Validation Rules
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000'
            ],
            [
                //Personalized Messages
                'text_title.required' => 'O título é obrigatorio',
                'text_title.min' => 'O título deve ter pelo menos :min caracteres',
                'text_title.max' => 'O título deve ter no máximo:max caracteres',
                'text_note.required' => 'A nota é obrigatória',
                'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max' => 'A nota deve ter no máximo :max caracteres'

            ]
        );

        if ($request->note_id == null) {
            return redirect()->route('home');
        }

        $id = Operations::decryptId($request->note_id);

        if ($id === null) {
            return redirect()->route('home');
        }

        //saving edits
        $note = Note::find($id);
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->route('home');
    }

    public function deleteNote($id)
    {

        $id = Operations::decryptId($id);

        if ($id === null) {
            return redirect()->route('home');
        }

        $note = Note::find($id);

        return view('delete_note', ['note' => $note]);

    }

    public function deleteNoteConfirm($id)
    {

        $id = Operations::decryptId($id);

        if ($id === null) {
            return redirect()->route('home');
        }

        $note = Note::find($id);

        //$note->deleted_at = date('Y-m-d H:i:s');
        //$note->save();

        //Using softdelete on the model will delete using softdelete.
        $note->delete();

        return redirect()->route('home');
    }


}
