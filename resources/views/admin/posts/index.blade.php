{{-- @extends('layouts.admin')

@section('content') --}}

<x-admin-layout title="Posts">
    <h2 class="mb-4">Posts</h2>
    <div class="mb-3">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-outline-primary">Create New Post</a>
    </div>

    {{-- total post --}}
    {{-- <div class="alert alert-info">
        <div class="h1">
            {{$total_posts}}Posts
        </div>
    </div> --}}

    {{-- reading from session : --}}
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{-- {{ session('success') }} --}}
            {{ session()->get('success') }}

        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                {{-- <th>ID</th> --}}
                <th>Title</th>
                <th>Slug</th>
                <th>Category</th>
                <th>Tags</th>
                <th>Status</th>
                <th>Created At</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    {{-- <td>{{ $loop->index }}</td> --}}
                    <td><a href="{{ route('admin.posts.download', [$post->id]) }}"><img src="{{ $post->image_url }}"
                                height="65" alt=""></a></td>
                    {{-- <td><img src="{{asset('storage/'.$post->image)}}" height="65" alt=""></td> --}}
                    {{-- <td>
                            @if ($post->image)
                                <img src="{{asset('uploads/'.$post->image)}}" height="65" alt="">
                                @else
                                <img src="https://placehold.co/600x400?text=No+Image"  height="65" alt="">
                                @endif
                            </td> --}}
                    {{-- <td>{{ $post->id }}</td> --}}
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->category_name }}</td>
                    <td>
                        @foreach ($post->tags as $tag)
                            <span class="btn btn-sm btn-info">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td>{{ $post->status }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td><a href="{{ route('admin.posts.edit', [$post->id]) }}"
                            class="btn btn-sm btn-outline-success">Edit Posts</a></td>
                    <td>
                        {{-- @if(Auth::user()->can('posts.delete')) --}}
                        @can('posts.delete')
                        <form action="{{ route('admin.posts.destroy', [$post->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete Posts</button>
                        </form>
                        {{-- @endif --}}
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No Posts.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{-- pagenate --}}{{ $posts->links('vendor.pagination.bootstrap-5') }}

</x-admin-layout>
