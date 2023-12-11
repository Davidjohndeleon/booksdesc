<?php

namespace App\Http\Controllers;
use App\Models\Students;
use Illuminate\Http\Request;

class StudentController extends Controller
{
     //a function which show all books
     public function index(){
        $student = Students::all();
        return response($student);
    }
    //a function which shows a specific student
    public function show($id){//finds the id of the students 
        $student = Students::find($id);
        return response($student);//displays the book with the input id
    }
    //stores an inputed data
    public function store(Request $request)
    {
        //stores in database table
        $student=new Students();
        $student->name = $request->name;
        $student->student_id = $request->student_id;
        $student->created_at = $request->created_at;
    //saves the input in database
        $student->save();
        //a response when student are added in database
        return response([
            "message"=>"students added in database!!"
        ]);
    }
    //function that updates an existing data in students table
    public function update(Request $request)
    {   //checks th database to find the correct data input
        $student = Students::findorfail($request->id);

        $student->name = $request->name;
        $student->student_id = $request->student_id;
        $student->created_at = $request->created_at;
        //updates the data

        $student->update();
        return response([
            "message"=>"Updated Succesfully"
        ]);
    }
    //function that deletes the corespondent data
    public function destroy($id){
        //find the data u want to delete
        $user = Students::find($id);
        //displays if it found the data and if it is deleted or invalid
        if ($user == null){
            return response([
                "message"=>"Record not found"
            ],404);
        }
        else{
            $user->delete();
            return response([
                "message"=>"Deleted succesfully!"
            ],200);
        }
    }
}
