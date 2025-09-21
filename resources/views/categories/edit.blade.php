@extends('layouts.app')

@section('content')
<h3>Edit Category</h3>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
  @csrf @method('PUT')
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input name="name" value="{{ old('name', $category->name) }}" class="form-control" required>
    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
  </div>

  <button class="btn btn-primary">Update</button>
  <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
