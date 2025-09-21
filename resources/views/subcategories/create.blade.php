@extends('layouts.app')

@section('content')
<h3>Add Subcategory</h3>

<form action="{{ route('subcategories.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label class="form-label">Category</label>
    <select name="category_id" class="form-control">
      <option value="">-- Select Category --</option>
      @foreach($categories as $cat)
        <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
      @endforeach
    </select>
    @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Subcategory Name</label>
    <input name="name" value="{{ old('name') }}" class="form-control">
    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
  </div>

  <button class="btn btn-success">Save</button>
  <a class="btn btn-secondary" href="{{ route('subcategories.index') }}">Back</a>
</form>
@endsection
