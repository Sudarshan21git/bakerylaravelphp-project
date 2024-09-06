<?php
namespace App\Http\Controllers\Backend;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['records']=Category::all();
        return view('backend.category.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $request->request->add(['created_by' => auth()->user()->id]);

        if ($request->hasFile('icon_file')) {
            $iconfile = $request->file('icon_file');
            $iconname = time() . '_' . $iconfile->getClientOriginalName();
            $iconfile->move('assets/images/category', $iconname);
            $request->request->add(['icon' => $iconname]);
        }

        $record = Category::create($request->all());

        if ($record) {
            $request->session()->flash('success', 'Category created successfully');
        } else {
            $request->session()->flash('error', 'Category creation failed');
        }

        return redirect()->route('backend.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        
        if ($category == null) {
            request()->session()->flash('error', 'Category not found');
            return view('backend.category.show', ['category' => null]);
        }
    
        return view('backend.category.show', ['category' => $category]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Implementation for editing a specific category can go here
        $category = Category::find($id);
        
        if ($category == null) {
            request()->session()->flash('error', 'Category not found');
            return view('backend.category.edit', ['category' => null]);
        }
    
        return view('backend.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
 
        $category = Category::find($id);
        if ($category == null) {
            $request->session()->flash('error', 'Category not found');
            return redirect()->route('backend.category.index');
        }
    
        if ($request->hasFile('icon_file')) {
            $iconfile = $request->file('icon_file');
            $iconname = time() . '_' . $iconfile->getClientOriginalName();
            $iconfile->move('assets/images/category', $iconname);
            $request->request->add(['icon' => $iconname]);
            if (file_exists(public_path('assets/images/category/'.$category->icon))) {
                unlink(public_path('assets/images/category/'.$category->icon));
            }
        }
    
        $request->request->add(['updated_by' => auth()->user()->id]);
    
        if ($category->update($request->all())) {
            $request->session()->flash('success', 'Category updated successfully');
        } else {
            $request->session()->flash('error', 'Category updation failed');
        }
    
        return redirect()->route('backend.category.index');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        
        if ($category == null) {
            request()->session()->flash('error', 'Category not found');
        } else {
            if ($category->delete()) {
                request()->session()->flash('success', 'Category deleted');
            } else {
                request()->session()->flash('error', 'Category deletion failed');
            }
        }
        return redirect()->route('backend.category.index');
    }
   
    
}    