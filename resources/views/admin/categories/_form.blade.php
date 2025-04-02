{{-- reading errors messages --}}
@if($errors->any())
 <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $message)
        <li>{{$message}}</li>
        @endforeach
    </ul>
 </div>
@endif

<div class="form-group">
    <label for="">Category Name</label><br><br>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name' , $category->name) }}"><br>
    @error('name')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="">Parent</label><br><br>
    <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror"><br>
        <option value="">No Parent</option>
        @foreach ($parent_categories as $parent)
            <option value="{{ $parent->id }}" @if($parent->id == old('parent_id' , $category->parent_id)) selected @endif>{{ $parent->name }}</option>
        @endforeach
    </select>
    @error('parent_id')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>

<div class="form-group"><br>
    <button type="submit" class="btn btn-primary">Save</button>
</div>
