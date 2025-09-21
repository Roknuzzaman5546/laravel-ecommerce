@extends('layouts.app')

@section('content')
<h3>Add Category</h3>

<form action="{{ route('categories.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input name="name" value="{{ old('name') }}" class="form-control" required>
    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
  </div>

  <button class="btn btn-success">Save</button>
  <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
