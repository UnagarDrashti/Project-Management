<?php

namespace App\Http\Controllers;

use App\Models\Project;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projects = Project::with(['employee', 'users'])->where('emp_id', auth()->user()->id)->get();
        return view('employee.home', compact('projects'));
    }



    public function logout()
    {  
        return redirect('login')->with(Auth::logout());
    }
}
