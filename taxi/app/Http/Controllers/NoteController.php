<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Exception, DB, Auth, Hash, Validator;

class NoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getNote()
    {
        return view('note.note');
    }

    public function getNoteNew()
    {
        return view('note.note-new');
    }

    public function getNoteCategory()
    {
        return view('note.note-category');
    }

}
