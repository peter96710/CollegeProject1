<?php

namespace App\Http\Controllers;

use App\Subject;
use App\User;
use App\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanarController extends Controller
{
    public function home()
    {
        $subjects = Subject::where('teacher_id',Auth::user()->id)->get();
        return view('tanar/home', array('subjects'=> $subjects ));
    }

    public function newcourse()
    {
        return view('tanar/newcourse');
    }

    public function newcoursefunction(Request $request){

        $this->validate($request, [
            'name' =>['required', 'string', 'max:191'],
            'code' =>['required', 'string', 'max:12','regex:/IK-[A-Z]{3}[0-9]{3}/i'],
            'credit' =>['required', 'integer', 'max:30'],
        ]);

        $request->request->add(['teacher_id'=>Auth::user()->id]);
        Subject::create($request->all());

        return redirect('/home');
    }
    public function list(Subject $subjects){
        $courses = Courses::where('subject_id',$subjects->id)->pluck('student_id');
        $students = User::whereIn('id', $courses)->get();
        return view('/tanar/subject',array('subjects'=>$subjects,'courses'=>$courses,'students'=>$students));
    }

    public function publish($id)
    {
        Subject::where('id', $id)->update(['published' => true,]);
        return redirect('/list/' . $id);
    }

    public function unpublish($id)
    {
        Subject::where('id', $id)->update(['published' => false,]);
        return redirect('/list/' . $id);
    }
    public function destroy(Subject $subjects)
    {
        Subject::find($subjects->id)->delete();
        return redirect('/tanar/home');
    }

    public function updateing(Request $request, $id){

        $this->validate($request, [
            'name' =>['required', 'string', 'max:191'],
            'code' =>['required', 'string', 'max:12','regex:/IK-[A-Z]{3}[0-9]{3}/i'],
            'credit' =>['required', 'integer', 'max:30'],
        ]);

        Subject::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'desc' => $request->input('desc'),
                'code' => $request->input('code'),
                'credit' => $request->input('credit')
            ]);

        return redirect('/list/'.$id);
    }
    public function update(Subject $subjects){
        return view('/tanar/update',array('subjects' =>$subjects));
    }


}
