<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        dd($projects);
        return view('index', compact('projects'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        return view('store');
    }
}
