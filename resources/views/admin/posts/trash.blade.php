
<x-admin-layout title="Deleted Posts">
    <h2 class="mb-4">Deleted Posts</h2>
    <div class="mb-3">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-outline-primary">Create New Post</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                {{-- <th>ID</th> --}}
                <th>Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Created At</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{route('admin.posts.download',[$post->id])}}"><img src="{{$post->image_url}}" height="65" alt=""></a></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->status }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td><a href="{{ route('admin.posts.edit' , [$post->id]) }}" class="btn btn-sm btn-outline-success">Edit Posts</a></td>
                        <td><form action="{{ route('admin.posts.restore' , [$post->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-outline-success">Restore Posts</button>
                        </form></td>
                        <td><form action="{{ route('admin.posts.forceDelete' , [$post->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete for ever</button>
                        </form></td>
                        {{-- <td><form action="{{ route('admin.posts.destroy' , [$post->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete Posts</button>
                        </form></td> --}}
                    </tr>
                @empty
                <tr>
                    <td colspan="9">No Posts.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
        {{-- pagenate --}}{{$posts->links('vendor.pagination.bootstrap-5')}}

</x-admin-layout>
