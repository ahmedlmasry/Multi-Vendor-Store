<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $records = Category::where(function ($query) use ($request) {
            if ($request->search) {
                $query->where('name', 'like', '%' . $request->search . '%');
            }
        })->latest()->paginate(3);
        return view('categories.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('categories', $image, 'public');
        }
        $record = Category::create([
            'name' => $request->get('name'),
            'image' => $imagePath,
            'description' => $request->get('description')

        ]);
        session()->flash('success','Category created successfully!');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = Category::findOrfail($id);
        return view('categories.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,

        ]);
        $record = Category::findOrfail($id);
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($record->image) {
                Storage::disk('public')->delete($record->image);
            }
            $image = $request->file('image')->getClientOriginalName();
            $record->image = $request->file('image')->storeAs('categories', $image, 'public');
        }
        $record->name = $request->name;
        $record->save();
        session()->flash('edit','Category Edited successfully!');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $record = Category::findorfail($id);
        if ($record->image) {
            // Delete the image from storage
            Storage::disk('public')->delete($record->image);
        }
        $record->delete();
        session()->flash('error','Category Deleted successfully!');
        return back();
    }
}
