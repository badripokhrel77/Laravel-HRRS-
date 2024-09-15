<?php

namespace App\Http\Controllers\Admin;

use App\Models\RoomCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = RoomCategory::query();

        // Check if a search query is present
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->input('search');
            $query->where('title', 'LIKE', "%{$searchTerm}%");
        }

        // Retrieve categories with pagination
        $categories = $query->orderBy('id', 'desc')->paginate(5);

        return view('admin/room-category/index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('admin/room-category/create');
    }

    public function store(Request $request)
    {
        $category = new RoomCategory();
        $category->title = $request->title;
        $category->description = $request->description;

        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $imagename = time() . $file->getClientOriginalName();
            $file->move('room_files', $imagename);
            $category->image = 'room_files/' . $imagename;
        }
        $category->save();
        return redirect(route('roomcategory.index'))->with('success', 'Room added successfully!');
    }

    public function edit($id)
    {
        return view('admin/room-category/edit', [
            'category' => RoomCategory::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = RoomCategory::findOrFail($id);
        $category->title = $request->title;
        $category->description = $request->description;
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $imagename = time() . $file->getClientOriginalName();
            $file->move('room_files', $imagename);
            $category->image = 'room_files/' . $imagename;
        }
        $category->update();

        return redirect(route('roomcategory.index'))->with('success', 'Room updated successfully!');
    }

    public function destroy($id)
    {
        $category = RoomCategory::findOrFail($id);
        $category->delete();
        return redirect(route('roomcategory.index'))->with('success', 'Room deleted successfully!');
    }
}
