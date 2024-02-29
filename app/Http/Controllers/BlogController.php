<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Blogs::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required'
            ]
        );
        return  Blogs::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Blogs::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = Blogs::find($id);
        $update->update($request->all());
        return $update;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Blogs::destroy($id);
    }


    /**
     * Search the specified resource from storage.
     */

    public function search(string $title)
    {
        return Blogs::where('title', 'like', '%' . $title . '%')->get();
    }
}
