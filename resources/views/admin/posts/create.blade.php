<x-admin-layout title="Create Post">
    <h2 class="mb-5">Create Posts</h2>
    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">

        @csrf
        @include('admin.posts._form')
    </form>
</x-admin-layout>
