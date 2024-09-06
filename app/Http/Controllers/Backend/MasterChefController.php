<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterChef;
use Illuminate\Support\Facades\Auth;

class MasterChefController extends Controller
{
    public function index()
    {
        $chefs = MasterChef::orderBy('name')->get();
        return view('backend.masterchefs.index', compact('chefs'));
    }

    public function create()
    {
        return view('backend.masterchefs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'photo' => 'required|file|mimes:jpg,jpeg,bmp,png|max:10000'
        ]);

        $data = $request->only(['name', 'specialty']);
        $data['created_by'] = Auth::id();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/masterchefs');
            $file->move($destinationPath, $fileName);
            $data['photo'] = $fileName;
        }
        else {
            return redirect()->route('backend.masterchefs.index')->with('error', 'Image is required.');
        }

        if (MasterChef::create($data)) {
            return redirect()->route('backend.masterchefs.index')->with('success', 'Master chef created successfully.');
        } else {
            return redirect()->route('backend.masterchefs.index')->with('error', 'Master chef creation failed.');
        }
    }

    public function edit($id)
    {
        $chef = MasterChef::findOrFail($id);
        return view('backend.masterchefs.edit', compact('chef'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $chef = MasterChef::findOrFail($id);

        $data = $request->only(['name', 'specialty']);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/masterchefs');
            $file->move($destinationPath, $fileName);
            $data['photo'] = $fileName;
        }

        $chef->update($data);
        return redirect()->route('backend.masterchefs.index')->with('success', 'Master chef updated successfully.');
    }

    public function destroy($id)
    {
        $chef = MasterChef::findOrFail($id);
        $chef->delete();
        return redirect()->route('backend.masterchefs.index')->with('success', 'Master chef deleted successfully.');
    }
}
