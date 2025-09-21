@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <h3>{{ $product->name }}</h3>
    <p><strong>Category:</strong> {{ $product->category->name ?? '-' }} / <strong>Subcategory:</strong> {{ $product->subcategory->name ?? '-' }}</p>
    @if($product->image)
      <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid mb-3" style="max-height:350px;object-fit:cover">
    @endif
    <p>{{ $product->description }}</p>

    <p>
      @if($product->old_price) <del>${{ $product->old_price }}</del> @endif
      <strong class="ms-2">${{ $product->new_price }}</strong>
    </p>

    <a class="btn btn-secondary" href="{{ route('products.index') }}">Back</a>
  </div>
</div>
@endsection
