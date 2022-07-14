<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskAddController extends Controller
{
    public function create()
    {
        return view('report');
    }

   public function addTask(Request $request)
   {
       Task::create($request->all());

       return redirect('/report-form')->with('status','Data added successfully');
   }

}
