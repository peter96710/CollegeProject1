<?php

namespace App\Http\Controllers;

use App\Courses;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiakController extends Controller
{
    public function home(){
        $signedSubjects = Courses::where('student_id', Auth::id())->pluck('subject_id');
        $subjects = Subject::whereIn('id', $signedSubjects)->get();
        return view('diak/home',array('subjects' =>$subjects));
    }
    public function newcourses(){
        $signedSubjects = Courses::where('student_id', Auth::id())->pluck('subject_id');
        $subjects = Subject::with('user')->whereNotIn('id', $signedSubjects)->where('published', true)->get();
        return view('diak/newcourses',array('subjects' =>$subjects));
    }
    public function pickup($id){

        $flight = new Courses;

        $flight->subject_id = $id;
        $flight->student_id = Auth::id();

        $flight->save();
        return redirect('diak/home');
    }
    public function destroy($id)
    {
        Courses::where('student_id',Auth::id())->where('subject_id',$id)->delete();
        return redirect('/diak/home');
    }

    public function list(Subject $subjects){
        $courses = Courses::where('subject_id',$subjects->id)->pluck('student_id');
        $students = User::whereIn('id', $courses)->get();
        $teachers = User::where('id',$subjects->teacher_id)->pluck('name');
        $teachers2 = User::where('id',$subjects->teacher_id)->pluck('email');
        return view('/diak/subject',array('subjects'=>$subjects,'courses'=>$courses,'students'=>$students,'teachers'=>$teachers,'teachers2'=>$teachers2));
    }

}
