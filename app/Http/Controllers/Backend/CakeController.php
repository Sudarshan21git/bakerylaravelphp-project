<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cake;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CakeController extends Controller
{
    public function index()
    {
        $cakes = Cake::orderBy('name')->get();
        $categories = Category::orderBy('title')->get();
        return view('backend.cake.index', compact('cakes', 'categories'));
    }

    public function destroy($id)
    {
        $cake = Cake::findOrFail($id);
        $cake->delete();
        return redirect()->route('backend.cake.index')->with('success', 'Cake item deleted successfully');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'category_id' => 'required|exists:categories,id',
        //     'price' => 'required|numeric',
        //     'image' => 'required|file|mimes:jpg,jpeg,bmp,png|max:10000'
        // ]);

        $data = $request->only(['name', 'category_id', 'price']);
        $data['created_by'] = Auth::id();

        if ($request->hasFile('cake_image')) {
            $file = $request->file('cake_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('assets/images/CakeItems');
            $file->move($destinationPath, $fileName);
            $data['img'] = $fileName;
        } else {
            return redirect()->route('backend.cake.index')->with('error', 'Image is required.');
        }

        if (Cake::create($data)) {
            return redirect()->route('backend.cake.index')->with('success', 'Cake item created successfully');
        } else {
            return redirect()->route('backend.cake.index')->with('error', 'Cake item creation failed');
        }
    }

    public function edit($id)
    {
        $cake = Cake::findOrFail($id);
        $categories = Category::orderBy('title')->get();
        return view('backend.cake.edit', compact('cake', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'image' => 'nullable|file|mimes:jpg,jpeg,bmp,png|max:10000'
        ]);

        $cake = Cake::findOrFail($id);

        $data = $request->only(['name', 'category_id', 'price']);

        if ($request->hasFile('cake_image')) {
            $file = $request->file('cake_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('assets/images/CakeItems');
            $file->move($destinationPath, $fileName);
            $data['img'] = $fileName;
        }

        $cake->update($data);
        return redirect()->route('backend.cake.index')->with('success', 'Cake item updated successfully');
    }
}
