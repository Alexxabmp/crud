@extends('layouts.app')

@section('title', 'Edit — ' . $product->name)
@section('page-title', 'Edit Product')
@section('page-subtitle', 'Modify the details of ' . $product->name)

@section('topbar-actions')
    <a href="{{ route('products.show', $product) }}" class="btn-outline-custom" id="btn-back-to-show">
        <i class="bi bi-arrow-left"></i> View Details
    </a>
    <a href="{{ route('products.index') }}" class="btn-outline-custom" id="btn-back-to-list-edit">
        <i class="bi bi-grid-3x3-gap"></i> All Products
    </a>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card-glass">
            <div class="card-header">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="width:38px;height:38px;background:rgba(251,191,36,0.15);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--warning-color);font-size:1.1rem;">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div>
                        <h5 style="font-weight:700; font-size:1rem; margin:0;">Edit: {{ $product->name }}</h5>
                        <p style="font-size:0.75rem; color:var(--text-secondary); margin:0;">
                            ID: <span style="font-family:monospace;">#{{ $product->id }}</span> ·
                            SKU: <span style="font-family:monospace;">{{ $product->sku }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if($errors->any())
                <div class="flash-error mb-4">
                    <div style="font-weight:600; margin-bottom:8px;"><i class="bi bi-exclamation-triangle-fill"></i> Please fix the following errors:</div>
                    <ul style="margin:0; padding-left:16px; font-size:0.85rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" id="editProductForm">
                    @csrf
                    @method('PUT')

                    {{-- Row 1: Name + SKU --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label-custom" for="name">
                                Product Name <span class="required">*</span>
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control form-control-custom @error('name') border-danger @enderror"
                                   value="{{ old('name', $product->name) }}"
                                   maxlength="150"
                                   required>
                            @error('name')
                                <div style="color:var(--danger-color); font-size:0.78rem; margin-top:5px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom" for="sku">
                                SKU <span class="required">*</span>
                            </label>
                            <input type="text"
                                   id="sku"
                                   name="sku"
                                   class="form-control form-control-custom @error('sku') border-danger @enderror"
                                   value="{{ old('sku', $product->sku) }}"
                                   maxlength="50"
                                   required
                                   style="font-family:monospace;">
                            @error('sku')
                                <div style="color:var(--danger-color); font-size:0.78rem; margin-top:5px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Row 2: Category + Price + Stock --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label-custom" for="category">
                                Category <span class="required">*</span>
                            </label>
                            <select id="category"
                                    name="category"
                                    class="form-control form-control-custom @error('category') border-danger @enderror"
                                    required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div style="color:var(--danger-color); font-size:0.78rem; margin-top:5px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom" for="price">
                                Price (₱) <span class="required">*</span>
                            </label>
                            <input type="number"
                                   id="price"
                                   name="price"
                                   class="form-control form-control-custom @error('price') border-danger @enderror"
                                   value="{{ old('price', $product->price) }}"
                                   min="0"
                                   max="99999999.99"
                                   step="0.01"
                                   required>
                            @error('price')
                                <div style="color:var(--danger-color); font-size:0.78rem; margin-top:5px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label-custom" for="stock_quantity">
                                Stock Qty <span class="required">*</span>
                            </label>
                            <input type="number"
                                   id="stock_quantity"
                                   name="stock_quantity"
                                   class="form-control form-control-custom @error('stock_quantity') border-danger @enderror"
                                   value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                   min="0"
                                   required>
                            @error('stock_quantity')
                                <div style="color:var(--danger-color); font-size:0.78rem; margin-top:5px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Row 3: Expiry + Status --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label-custom" for="expiry_date">Expiry Date</label>
                            <input type="date"
                                   id="expiry_date"
                                   name="expiry_date"
                                   class="form-control form-control-custom @error('expiry_date') border-danger @enderror"
                                   value="{{ old('expiry_date', $product->expiry_date ? $product->expiry_date->format('Y-m-d') : '') }}">
                            @error('expiry_date')
                                <div style="color:var(--danger-color); font-size:0.78rem; margin-top:5px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <div style="padding-bottom:4px;">
                                <label class="form-label-custom">Status</label>
                                <div class="toggle-wrapper">
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               role="switch"
                                               id="is_active"
                                               name="is_active"
                                               {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                                               style="width:42px; height:22px; cursor:pointer;">
                                        <label class="form-check-label" for="is_active"
                                               style="font-size:0.87rem; color:var(--text-secondary); margin-left:8px; line-height:22px;">
                                            Product is <strong id="activeLabel">{{ $product->is_active ? 'Active' : 'Inactive' }}</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label-custom" for="description">Description</label>
                        <textarea id="description"
                                  name="description"
                                  class="form-control form-control-custom @error('description') border-danger @enderror"
                                  rows="4"
                                  maxlength="2000">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div style="color:var(--danger-color); font-size:0.78rem; margin-top:5px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Image Upload --}}
                    <div class="mb-4">
                        <label class="form-label-custom" for="image">
                            Product Image
                            <span style="color:var(--text-muted); font-weight:400;">(leave blank to keep current)</span>
                        </label>

                        {{-- Current Image --}}
                        @if($product->image)
                        <div style="margin-bottom:12px; display:flex; align-items:center; gap:12px;">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="Current image"
                                 style="width:70px; height:70px; object-fit:cover; border-radius:10px; border:1px solid var(--border-color);">
                            <div>
                                <div style="font-size:0.75rem; color:var(--text-secondary);">Current image</div>
                                <div style="font-size:0.72rem; color:var(--text-muted); font-family:monospace;">{{ $product->image }}</div>
                            </div>
                        </div>
                        @endif

                        <input type="file"
                               id="image"
                               name="image"
                               class="form-control form-control-custom @error('image') border-danger @enderror"
                               accept="image/jpeg,image/png,image/webp"
                               onchange="previewImage(this)">
                        @error('image')
                            <div style="color:var(--danger-color); font-size:0.78rem; margin-top:5px;">{{ $message }}</div>
                        @enderror
                        <div id="imagePreviewContainer" style="display:none; margin-top:12px;">
                            <div style="font-size:0.75rem; color:var(--text-secondary); margin-bottom:6px;">New image preview:</div>
                            <img id="imagePreview" src="" alt="Preview"
                                 style="width:100px; height:100px; object-fit:cover; border-radius:10px; border:1px solid var(--border-color);">
                        </div>
                    </div>

                    {{-- Submit Buttons --}}
                    <div style="display:flex; gap:12px; justify-content:flex-end; padding-top:8px; border-top:1px solid var(--border-color);">
                        <a href="{{ route('products.show', $product) }}" class="btn-outline-custom" id="btn-cancel-edit">
                            <i class="bi bi-x-lg"></i> Cancel
                        </a>
                        <button type="submit" class="btn-primary-custom" id="btn-submit-edit">
                            <i class="bi bi-floppy-fill"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        const container = document.getElementById('imagePreviewContainer');
        const preview   = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                container.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    const toggle = document.getElementById('is_active');
    const label  = document.getElementById('activeLabel');
    if (toggle) {
        const setColor = () => {
            label.textContent = toggle.checked ? 'Active' : 'Inactive';
            label.style.color = toggle.checked ? 'var(--success-color)' : 'var(--danger-color)';
        };
        toggle.addEventListener('change', setColor);
        setColor();
    }
</script>
@endpush
