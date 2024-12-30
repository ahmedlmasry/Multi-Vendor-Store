<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $records = Product::where(function ($query) use ($request) {
            if ($request->search) {
                $query->where('name', 'like', '%' . $request->search . '%');
            }
            if($request->category_id){
                $query->where('category_id', 'like', '%' . $request->category_id . '%');
            }
        })->latest()->paginate(3);
        return view('products.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('products', $image, 'public');
        }
        $record = Product::create([
            'name' => $request->get('name'),
            'image' => $imagePath,
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'category_id' => $request->get('category_id'),

        ]);
        session()->flash('success','Product created successfully!');
        return redirect()->route('products.index');
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
        $record = Product::findOrfail($id);
        return view('products.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:products,name,'.$id,

        ]);
        $record = Product::findOrfail($id);
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($record->image) {
                Storage::disk('public')->delete($record->image);
            }
            $image = $request->file('image')->getClientOriginalName();
            $record->image = $request->file('image')->storeAs('products', $image, 'public');
        }
        $record->name = $request->name;
        $record->save();
        session()->flash('edit','Product Edited successfully!');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $record = Product::findorfail($id);
        if ($record->image) {
            // Delete the image from storage
            Storage::disk('public')->delete($record->image);
        }
        $record->delete();
        session()->flash('error','Product Deleted successfully!');
        return back();
    }
}
