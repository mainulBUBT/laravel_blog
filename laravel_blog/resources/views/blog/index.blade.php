@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="mt-4 p-5 bg-white shadow-sm  rounded">
                <h1>Blog Posts</h1>
                @if(Auth::check())
                <a href="{{route('blogs.create')}}" class="btn btn-primary">Create a Blog</a>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                {{ session()->get('message') }}
            </div>
            @endif
        </div>
        @foreach($posts as $post)
        <div class="col-md-6">
            <div class="card">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{url('blog_images', $post->image_path)}}" alt="" style="width: 200px; height:200px;">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <a href="{{route('blogs.show', $post->slug)}}" class="h4 text-decoration-none">{{ \Illuminate\Support\Str::limit($post->title, 20, $end='...')}}</a>
                            <h6><span class="text-secondary">Posted By</span> {{$post->user->name}}</h6>
                            <h6>Published On: <span style="color:grey;">{{ date('jS M Y', strtotime($post->created_at)) }}</span></h6>
                            <p>{{ \Illuminate\Support\Str::limit($post->description, 30, $end='...')}}</p>
                            <a href="{{route('blogs.show', $post->slug)}}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>


@endsection