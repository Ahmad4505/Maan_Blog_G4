<x-admin-layout title="Edit Category">
    <h2 class="mb-5">Edit Category</h2>
    <form action="{{ route('admin.categories.update' , [$category->id]) }}" method="post">
        @csrf
        @method('put')
        {{-- @method('put') => <input type="hidden" name="_method" value="put"> --}}
        @include('admin.categories._form')

    </form>

</x-admin-layout>
