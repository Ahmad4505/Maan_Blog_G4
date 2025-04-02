{{-- @extends('layouts.admin')

@section('content') --}}

<x-admin-layout title="Categories">
    <h2 class="mb-4">Categories</h2>
    <div class="mb-3">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-outline-primary">Create New Category</a>
    </div>

{{-- reading from session : --}}
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{-- {{ session('success') }} --}}
        {{ session()->get('success') }}

    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                {{-- <th>ID</th> --}}
                <th>Name</th>
                <th>Slug</th>
                <th>Parent</th>
                <th>Posts Number</th>
                <th>Created At</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (count($categories) > 0)
                @foreach ($categories as $category)
                    <tr>
                        {{-- <td>{{ $loop->index }}</td> --}}
                        <td>{{ $loop->iteration }}</td>
                        {{-- <td>{{ $loop->first? 'First' : ''}}</td>  --}}
                        {{-- <td>{{ $loop->last? 'Last' : ''}}</td>  --}}
                        {{-- <td>{{ $category->id }}</td> --}}
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        {{-- <td>{{ $category->parent_name }}</td> --}}
                        <td>{{ $category->parent->name }}</td>
                        {{-- <td>{{ $category->products_count }}</td> --}}
                        <td>{{ $category->posts_count }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td><a href="{{ route('admin.categories.edit' , [$category->id]) }}" class="btn btn-sm btn-outline-success">Edit Category</a></td>
                        <td><form action="{{ route('admin.categories.destroy' , [$category->id]) }}" method="post">
                            @csrf {{-- token --}}
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete Category</button>
                        </form></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8">No Categories.</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{-- pagenate --}}{{$categories->links('vendor.pagination.bootstrap-5')}}
    {{-- @endsection --}}

</x-admin-layout>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
