@extends('layouts.app')

@section('content')
<h3>Edit Subcategory</h3>

<form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST">
  @csrf @method('PUT')

  <div class="mb-3">
    <label class="form-label">Category</label>
    <select name="category_id" class="form-control" required>
      @foreach($categories as $cat)
        <option value="{{ $cat->id }}" @selected($cat->id == $subcategory->category_id)>{{ $cat->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Subcategory Name</label>
    <input name="name" value="{{ old('name', $subcategory->name) }}" class="form-control" required>
  </div>

  <button class="btn btn-primary">Update</button>
  <a class="btn btn-secondary" href="{{ route('subcategories.index') }}">Back</a>
</form>
@endsection
