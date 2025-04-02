{{-- reading errors messages --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for=""><b>Title</b></label><br><br>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $post->title) }}"><br>
    @error('title')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
{{-- <div class="form-group">
    <label for=""><b>Slug</b></label><br><br>
    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug' , $post->slug) }}"><br>
    @error('slug')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div> --}}


<div class="form-group">
    <label for=""><b>Category</b></label><br><br>
    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror"><br>
        <option value="">No Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if ($category->id == old('category_id', $post->category_id)) selected @endif>{{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="form-group"><br>
    <label for=""><b>Content</b></label><br><br>
    <textarea rows="10" name="content" class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea><br>
    @error('content')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>


<div class="form-group">
    <label for=""><b>Image</b></label><br><br>
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"><br>
    @error('image')
        <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="">Status</label>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="draft" @if(old('status', $post->status) == 'draft') checked @endif>
            <label class="form-check-label">Draft</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="published"  @if(old('status', $post->status) == 'published') checked @endif>
            <label class="form-check-label" for="exampleRadios2">Published</label>
        </div>
    </div>
</div>
<div class="form-group">
    <label for=""><b>Tags</b></label><br><br>
    <div>
        @foreach ($tags as $tag)
            <label for="" class="d-inline-block mx-2">
                <input type="checkbox" name="tag[]" value="{{ $tag->id }}" @if(in_array($tag->id,$post_tags)) checked @endif>
                {{ $tag->name }}
            </label>
        @endforeach
    </div>
</div>


<div class="form-group"><br>
    <button type="submit" class="btn btn-primary">Save</button>
</div>
