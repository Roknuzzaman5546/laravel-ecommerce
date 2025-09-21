@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h2>Products (grouped by Subcategory)</h2>
  <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
</div>

@foreach($subcategories as $sub)
  <div class="mb-4">
    <h4>{{ $sub->name }} <small class="text-muted">({{ $sub->category->name ?? '-' }})</small></h4>
    <div class="row">
      @forelse($sub->products as $p)
        <div class="col-md-3 mb-3">
          <div class="card h-100">
            @if($p->image)
              <img src="{{ asset('storage/' . $p->image) }}" class="card-img-top product-image" alt="">
            @else
              <div class="bg-light d-flex align-items-center justify-content-center" style="height:140px">No Image</div>
            @endif
            <div class="card-body">
              <h5 class="card-title">{{ $p->name }}</h5>
              <p class="card-text small">{{ Str::limit($p->description, 80) }}</p>
              <p class="mb-1">
                @if($p->old_price) <del class="text-muted">${{ $p->old_price }}</del> @endif
                <strong>${{ $p->new_price }}</strong>
              </p>
              <div class="d-flex gap-2">
                <a href="{{ route('products.show', $p->slug) }}" class="btn btn-sm btn-success">View</a>
                <a href="{{ route('products.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('products.destroy', $p->id) }}" method="POST" style="display:inline-block;">
                  @csrf @method('DELETE')
                  <button onclick="return confirm('Delete product?')" class="btn btn-sm btn-danger">Delete</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12"><p class="text-muted">No products in this subcategory.</p></div>
      @endforelse
    </div>
  </div>
@endforeach
@endsection
