<div class="mb-3">
    <label class="form-label">Category</label>
    <select id="category_id" name="category_id" class="form-control" required>
        <option value="">-- Select Category --</option>
        @foreach(\App\Models\Category::all() as $cat)
            <option value="{{ $cat->id }}" @if(old('category_id', $product->category_id ?? '') == $cat->id) selected @endif>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
    @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Subcategory</label>
    <select id="subcategory_id" name="subcategory_id" class="form-control" required>
        <option value="">-- Select Subcategory --</option>
        @if(isset($subcategories))
            @foreach($subcategories as $s)
                <option value="{{ $s->id }}" @if(old('subcategory_id', $product->subcategory_id ?? '') == $s->id) selected @endif>
                    {{ $s->name }}</option>
            @endforeach
        @elseif(isset($product) && $product)
            @foreach(\App\Models\Subcategory::where('category_id', $product->category_id)->get() as $s)
                <option value="{{ $s->id }}" @if(old('subcategory_id', $product->subcategory_id) == $s->id) selected @endif>
                    {{ $s->name }}</option>
            @endforeach
        @endif
    </select>
    @error('subcategory_id') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Product Name</label>
    <input name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Old Price (optional)</label>
        <input name="old_price" type="number" step="0.01" class="form-control"
            value="{{ old('old_price', $product->old_price ?? '') }}">
        @error('old_price') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">New Price</label>
        <input name="new_price" type="number" step="0.01" class="form-control"
            value="{{ old('new_price', $product->new_price ?? '') }}" required>
        @error('new_price') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Image</label>
    <input name="image" type="file" class="form-control">
    @if(!empty($product) && $product->image)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $product->image) }}" width="120" style="object-fit:cover" class="rounded">
        </div>
    @endif
    @error('image') <div class="text-danger">{{ $message }}</div> @enderror
</div>