<x-admin-layout title="Edit Post">
    <h2 class="mb-5">Edit Posts</h2>
    <form action="{{ route('admin.posts.update' , [$post->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        {{-- @method('put') => <input type="hidden" name="_method" value="put"> --}}
        @include('admin.posts._form')

    </form>

</x-admin-layout>
