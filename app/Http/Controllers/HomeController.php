<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Subject;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    //
    public function index(){
        $classes = ClassModel::limit(8)->get();
        $subjects = Subject::limit(8)->get();
        return view('client.home.index', compact(
            'classes',
            'subjects'
        ));
    }
}
