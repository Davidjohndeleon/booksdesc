<?php

namespace App\Http\Controllers;
use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    //a function which show all books
    public function index(){
        $book = Books::all();
        return response($book);
    }
    //a function which shows a specific book
    public function show($id){//finds the id of the books 
        $book = Books::find($id);
        return response($book);//displays the book with the input id
    }
    //stores an inputed data
    public function store(Request $request)
    {
        //stores in database table
        $book=new Books();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->published_at = $request->published_at;
    //saves the input in database
        $book->save();
        //a response when books are added in database
        return response([
            "message"=>"Books added in database!!"
        ]);
    }
    //function that updates an existing data in books table
    public function update(Request $request)
    {   //checks th database to find the correct data input
        $book = Books::findorfail($request->id);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->published_at = $request->published_at;
        //updates the data

        $book->update();
        return response([
            "message"=>"Updated Succesfully"
        ]);
    }
    //function that deletes the corespondent data
    public function destroy($id){
        //find the data u want to delete
        $user = Books::find($id);
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
