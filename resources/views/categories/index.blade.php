@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Categories</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
</div>

<table class="table table-bordered">
  <thead><tr><th>#</th><th>Name</th><th>Slug</th><th>Subcategories</th><th>Actions</th></tr></thead>
  <tbody>
    @forelse($categories as $k => $cat)
      <tr>
        <td>{{ $k + $categories->firstItem() }}</td>
        <td>{{ $cat->name }}</td>
        <td>{{ $cat->slug }}</td>
        <td>
          @foreach($cat->subcategories as $s)
            <span class="badge bg-info">{{ $s->name }}</span>
          @endforeach
        </td>
        <td>
          <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-sm btn-warning">Edit</a>

          <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" style="display:inline-block;">
            @csrf @method('DELETE')
            <button onclick="return confirm('Delete category?')" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="5" class="text-center">No categories found</td></tr>
    @endforelse
  </tbody>
</table>

{{ $categories->links() }}
@endsection
