@extends('layouts.app')

@section('content')
<h3>Add Product</h3>

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  @include('products.partials.form', ['product' => null])

  <button class="btn btn-success">Save Product</button>
  <a class="btn btn-secondary" href="{{ route('products.index') }}">Back</a>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const cat = document.getElementById('category_id');
    const sub = document.getElementById('subcategory_id');

    if (!cat) return;

    cat.addEventListener('change', async function(){
        const id = this.value;
        sub.innerHTML = '<option>Loading...</option>';
        if (!id) { sub.innerHTML = '<option value="">-- Select Subcategory --</option>'; return; }
        const res = await fetch('/api/categories/' + id + '/subcategories');
        const data = await res.json();
        sub.innerHTML = '<option value="">-- Select Subcategory --</option>';
        data.forEach(s => {
            const opt = document.createElement('option');
            opt.value = s.id; opt.textContent = s.name;
            sub.appendChild(opt);
        });
    });
});
</script>
@endpush
