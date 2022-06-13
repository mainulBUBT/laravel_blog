<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('blog.index')
            ->with('posts', Post::orderBy('updated_at', 'DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5084',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $ImageName = uniqid() . '-' . $request->title . '.' . $request->image->extension();
            $request->image->move(public_path('blog_images'), $ImageName);

            Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'slug' => Str::slug($request->title, "-"),
                'image_path' => $ImageName,
                'user_id' => auth()->user()->id
            ]);

            return response()->json([
                'status' => 200,
                'message' => "Your Blog has been added!"
            ]);

            // return redirect('/blogs')->with('message', 'Your Blog has been added!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('blog.show')->with('post', Post::where('slug', $slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('blog.edit')->with('post', Post::where('slug', $slug)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',

        ]);
        $ImageName = '';

        if ($request->hasFile('new_image')) {
            $ImageName = uniqid() . '-' . $request->title . '.' . $request->new_image->extension();
            $request->new_image->move(public_path('blog_images'), $ImageName);
            unlink('blog_images/' . $request->image);
        } else {
            $ImageName = $request->image;
        }


        Post::where('slug', $slug)->update([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title, "-"),
            'image_path' => $ImageName,
            'user_id' => auth()->user()->id
        ]);
        return redirect('/blogs')->with('message', 'Your Blog updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug);
        $post->delete();
        return redirect('/blogs')->with('message', 'Blog has been deleted!');
    }
}
