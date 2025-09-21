@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Subcategories</h2>
    <a href="{{ route('subcategories.create') }}" class="btn btn-primary">Add Subcategory</a>
</div>

<table class="table table-bordered">
  <thead><tr><th>#</th><th>Name</th><th>Category</th><th>Slug</th><th>Actions</th></tr></thead>
  <tbody>
    @forelse($subcategories as $k => $s)
      <tr>
        <td>{{ $k + $subcategories->firstItem() }}</td>
        <td>{{ $s->name }}</td>
        <td>{{ $s->category->name ?? '-' }}</td>
        <td>{{ $s->slug }}</td>
        <td>
          <a href="{{ route('subcategories.edit', $s->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('subcategories.destroy', $s->id) }}" method="POST" style="display:inline-block;">
            @csrf @method('DELETE')
            <button onclick="return confirm('Delete subcategory?')" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="5" class="text-center">No subcategories</td></tr>
    @endforelse
  </tbody>
</table>

{{ $subcategories->links() }}
@endsection
