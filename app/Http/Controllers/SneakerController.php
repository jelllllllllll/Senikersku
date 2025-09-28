<?php

namespace App\Http\Controllers;

use App\Models\Sneaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SneakerController extends Controller
{
    public function index()
    {
        $sneakers = Sneaker::all();
        return view('sneakers.index', compact('sneakers'));
    }

    public function create()
    {
        return view('sneakers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'brand' => 'required|string|max:255',
            'size' => 'required|string|max:50',
            'color' => 'required|string|max:100',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sneakers', 'public');
        }

        Sneaker::create($data);

        return redirect()->route('sneakers.index')->with('success', 'Sneaker added successfully!');
    }

    public function show(Sneaker $sneaker)
    {
        return view('sneakers.show', compact('sneaker'));
    }

    public function edit(Sneaker $sneaker)
    {
        return view('sneakers.edit', compact('sneaker'));
    }

    public function update(Request $request, Sneaker $sneaker)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'brand' => 'required|string|max:255',
            'size' => 'required|string|max:50',
            'color' => 'required|string|max:100',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($sneaker->image) {
                Storage::disk('public')->delete($sneaker->image);
            }
            $data['image'] = $request->file('image')->store('sneakers', 'public');
        }

        $sneaker->update($data);

        return redirect()->route('sneakers.index')->with('success', 'Sneaker updated successfully!');
    }

    public function destroy(Sneaker $sneaker)
    {
        if ($sneaker->image) {
            Storage::disk('public')->delete($sneaker->image);
        }

        $sneaker->delete();

        return redirect()->route('sneakers.index')->with('success', 'Sneaker deleted successfully!');
    }
}