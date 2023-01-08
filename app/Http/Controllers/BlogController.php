<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['blog'] = Blog::with('category')->get();
        // dd($blog[8]->category->name);
        return view('index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['category'] = Category::get();
        return view('add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image' => 'required',
        ]);

        $storeData['slug'] = Str::slug($request->title);

        $finalPath = '';
        if ($request->hasFile('image')) {
            $image_name = $request->file('image');
            $image_original_name = $request->file('image')->getClientOriginalName();
            $img_extention = $request->file('image')->getClientOriginalExtension();
            $img_size = $request->file('image')->getSize();

            $disk = Storage::disk('public');
            $finalPath = $disk->put('blog', $image_name);
            $storeData['image'] = $finalPath;
        }
        // dd($storeData);
        $blog = Blog::create($storeData);
        return redirect('/blog')->with('completed', 'Blog has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['blog'] = Blog::findOrFail($id);
        $data['category'] = Category::get();
        return view('edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $storeData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        $storeData['slug'] = Str::slug($request->title);
        $storeData['status'] = $request->status;
        $finalPath = '';
        if ($request->hasFile('image')) {
            $image_name = $request->file('image');
            $image_original_name = $request->file('image')->getClientOriginalName();
            $img_extention = $request->file('image')->getClientOriginalExtension();
            $img_size = $request->file('image')->getSize();

            $disk = Storage::disk('public');
            $finalPath = $disk->put('blog', $image_name);
            $storeData['image'] = $finalPath;
        }
        Blog::whereId($id)->update($storeData);
        return redirect('/blog')->with('completed', 'Blog has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Blog::findOrFail($id);
        $student->delete();
        return redirect('/blog')->with('completed', 'blog has been deleted');
    }
}
