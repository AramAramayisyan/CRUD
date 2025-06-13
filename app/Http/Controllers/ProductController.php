<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        return view('index', compact('properties'));
    }

    public function create()
    {
        return view('create');
    }

    public function  edit($id)
    {
        dd($id);
        
    }
    public function store(Request $request)
    {
        return view('store');
    }


}
