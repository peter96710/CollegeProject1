<?php

namespace App\Http\Controllers;

use App\Courses;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (Auth::check()) {
            if (Auth::user()->roles->first()->name == "tanar") {
                $subjects = Subject::where('teacher_id',Auth::user()->id)->get();
                return view('tanar/home', array('subjects'=> $subjects ));
            }
            if (Auth::user()->roles->first()->name == "diak") {
                $signedSubjects = Courses::where('student_id', Auth::id())->pluck('subject_id');
                $subjects = Subject::whereIn('id', $signedSubjects)->get();
                return view('diak/home',array('subjects' =>$subjects));

            }
        } else {
            $students = User::whereHas('roles', function($q){$q->where('name', 'diak');})->get();
            $teachers = User::whereHas('roles', function($q){$q->where('name', 'tanar');})->get();
            return view('/home',array('students'=>$students,'teachers'=>$teachers));
        }
    }
    public function homepage(){
        $students = User::whereHas('roles', function($q){$q->where('name', 'diak');})->get();
        $teachers = User::whereHas('roles', function($q){$q->where('name', 'tanar');})->get();
        return view('/home',array('students'=>$students,'teachers'=>$teachers));
    }

    public function profile()
    {
        return view('profile');
    }

    public function contact()
    {
        return view('kapcsolat');
    }



}
