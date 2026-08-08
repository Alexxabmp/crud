@extends('layouts.app')

@section('title', 'Add Product')
@section('page-title', 'Add New Product')
@section('page-subtitle', 'Fill in the details to add a new product to inventory')

@section('topbar-actions')
    <a href="{{ route('products.index') }}" class="btn-outline-custom" id="btn-back-to-list">
        <i class="bi bi-arrow-left"></i> Back to List
    </a>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card-glass">
            <div class="card-header">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="width:38px;height:38px;background:var(--accent-grad);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;">
                        📦
                    </div>
                    <div>
                        <h5 style="font-weight:700; font-size:1rem; margin:0;">Product Information</h5>
                        <p style="font-size:0.75rem; color:var(--text-secondary); margin:0;">Fields marked with <span style="color:var(--danger-color);">*</span> are required</p>
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

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="createProductForm">
                    @csrf

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
                                   value="{{ old('name') }}"
                                   placeholder="e.g. Apple iPhone 15 Pro"
                                   maxlength="150"
                                   required>
                            @error('name')
                                <div style="color:var(--danger-color); font-size:0.78rem; margin-top:5px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom" for="sku">
                                SKU <span class="required">*</span>
                                <span style="color:var(--text-muted); font-weight:400;">(unique)</span>
                            </label>
                            <input type="text"
                                   id="sku"
                                   name="sku"
                                   class="form-control form-control-custom @error('sku') border-danger @enderror"
                                   value="{{ old('sku') }}"
                                   placeholder="e.g. APL-IP15P"
                                   maxlength="50"
                                   required
                                   style="font-family:monospace;">
                            @error('sku')
                                <div style="color:var(--danger-color); font-size:0.78rem; margin-top:5px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Row 2: Category --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label-custom" for="category">
                                Category <span class="required">*</span>
                            </label>
                            <select id="category"
                                    name="category"
                                    class="form-control form-control-custom @error('category') border-danger @enderror"
                                    required>
                                <option value="" disabled {{ old('category') ? '' : 'selected' }}>— Select Category —</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
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
                                   value="{{ old('price') }}"
                                   placeholder="0.00"
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
                                   value="{{ old('stock_quantity', 0) }}"
                                   min="0"
                                   required>
                            @error('stock_quantity')
                                <div style="color:var(--danger-color); font-size:0.78rem; margin-top:5px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Row 3: Expiry Date + is_active --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label-custom" for="expiry_date">
                                Expiry Date
                                <span style="color:var(--text-muted); font-weight:400;">(optional)</span>
                            </label>
                            <input type="date"
                                   id="expiry_date"
                                   name="expiry_date"
                                   class="form-control form-control-custom @error('expiry_date') border-danger @enderror"
                                   value="{{ old('expiry_date') }}"
                                   min="{{ date('Y-m-d') }}">
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
                                               {{ old('is_active', true) ? 'checked' : '' }}
                                               style="width:42px; height:22px; cursor:pointer;">
                                        <label class="form-check-label" for="is_active"
                                               style="font-size:0.87rem; color:var(--text-secondary); margin-left:8px; line-height:22px;">
                                            Product is <strong id="activeLabel">Active</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Row 4: Description --}}
                    <div class="mb-3">
                        <label class="form-label-custom" for="description">
                            Description
                            <span style="color:var(--text-muted); font-weight:400;">(optional)</span>
                        </label>
                        <textarea id="description"
                                  name="description"
                                  class="form-control form-control-custom @error('description') border-danger @enderror"
                                  rows="4"
                                  placeholder="Enter product description..."
                                  maxlength="2000">{{ old('description') }}</textarea>
                        @error('description')
                            <div style="color:var(--danger-color); font-size:0.78rem; margin-top:5px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Row 5: Image Upload --}}
                    <div class="mb-4">
                        <label class="form-label-custom" for="image">
                            Product Image
                            <span style="color:var(--text-muted); font-weight:400;">(jpg, png, webp · max 2MB)</span>
                        </label>
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
                            <img id="imagePreview" src="" alt="Preview"
                                 style="width:100px; height:100px; object-fit:cover; border-radius:10px; border:1px solid var(--border-color);">
                        </div>
                    </div>

                    {{-- Submit Buttons --}}
                    <div style="display:flex; gap:12px; justify-content:flex-end; padding-top:8px; border-top:1px solid var(--border-color);">
                        <a href="{{ route('products.index') }}" class="btn-outline-custom" id="btn-cancel-create">
                            <i class="bi bi-x-lg"></i> Cancel
                        </a>
                        <button type="submit" class="btn-primary-custom" id="btn-submit-create">
                            <i class="bi bi-plus-circle-fill"></i> Create Product
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

    // Toggle active label
    const toggle = document.getElementById('is_active');
    const label  = document.getElementById('activeLabel');
    if (toggle) {
        toggle.addEventListener('change', function() {
            label.textContent = this.checked ? 'Active' : 'Inactive';
            label.style.color = this.checked ? 'var(--success-color)' : 'var(--danger-color)';
        });
        // Initial color
        label.style.color = toggle.checked ? 'var(--success-color)' : 'var(--danger-color)';
    }
</script>
@endpush
