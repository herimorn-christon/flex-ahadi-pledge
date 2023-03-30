<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;

class reportProblemController extends Controller
{
    //
    public function InterProblems(Request $request){
        //then make validation and send the form in the database using the model of the problem
        $ploblems=new Problem();
        $ploblems->user_id=$request->user_id;
        $ploblems->problem=$request->problem;
        $ploblems->detail=$request->description;
        $ploblems->attachment='no image';
        $ploblems->save();
        return redirect()->back()->with('message',"problem reported successfully");
        //$ploblem-=$request->ploblem;
        //$description=$request->description;
        
    }
    public function deleteProblem($id){
          $problem=Problem::find($id);
          $problem->delete();
          return redirect()->back()->with('message',"problem has been successfully deleted");
    }
}
