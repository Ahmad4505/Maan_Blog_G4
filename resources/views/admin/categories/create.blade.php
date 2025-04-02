{{-- @extends('layouts.admin')

@section('content') --}}


<x-admin-layout title="Create Category">
    <h2 class="mb-5">Create Category</h2>
    <form action="{{ route('admin.categories.store') }}" method="post">
        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{ csrf_field() }} --}}
        @csrf
        {{-- <div class="form-group">
            <label for="">Category Name</label><br><br>
            <input type="text" name="name" class="form-control"><br>
        </div>

        <div class="form-group">
            <label for="">Parent</label><br><br>
            <select name="parent_id" class="form-control"><br>
                <option value="">No Parent</option>
                @foreach ($parent_categories as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach

            </select>
        </div>

        <div class="form-group"><br>
            <button type="submit" class="btn btn-primary">Save</button>
        </div> --}}



        {{-- @include('admin.categories._form',[
            'category' => new App\Models\Category(),
        ]) --}}

       @include('admin.categories._form')
    </form>

    {{-- @endsection --}}

</x-admin-layout>
