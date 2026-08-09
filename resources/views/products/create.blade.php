@extends('layouts.app')

@section('title', 'Add Product')
@section('page-title', 'New Product')

@section('back-btn')
    <a href="{{ route('products.index') }}" class="ios-back-btn">
        <i class="bi bi-chevron-left"></i> Products
    </a>
@endsection

@section('topbar-actions')
    <button type="submit" form="createForm" class="ios-btn ios-btn-primary ios-btn-sm">
        Save
    </button>
@endsection

@section('content')

    <form id="createForm" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="ios-form-wrap">

            {{-- Basic Info --}}
            <div class="ios-section-header" style="padding-left:4px; margin-bottom:12px;">Basic Info</div>

            <div class="ios-form-group">
                <label class="ios-form-label">Product Name <span class="req">*</span></label>
                <input type="text" name="name" class="ios-input" value="{{ old('name') }}"
                       placeholder="e.g. iPhone 15 Pro">
                @error('name') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            <div class="ios-form-group">
                <label class="ios-form-label">SKU <span class="req">*</span></label>
                <input type="text" name="sku" class="ios-input" value="{{ old('sku') }}"
                       placeholder="e.g. APL-IP15P-128">
                @error('sku') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            <div class="ios-form-group">
                <label class="ios-form-label">Category <span class="req">*</span></label>
                <select name="category" class="ios-input">
                    <option value="">Select category…</option>
                    @foreach(['Electronics','Clothing','Food & Beverages','Health & Beauty','Home & Living','Books & Media','Toys & Games','Other'] as $cat)
                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            <div class="ios-form-group">
                <label class="ios-form-label">Description</label>
                <textarea name="description" class="ios-input"
                          placeholder="Product description…">{{ old('description') }}</textarea>
                @error('description') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            {{-- Pricing & Stock --}}
            <div class="ios-section-header" style="padding-left:4px; margin:20px 0 12px;">Pricing & Stock</div>

            <div class="ios-form-group">
                <label class="ios-form-label">Price (₱) <span class="req">*</span></label>
                <input type="number" name="price" class="ios-input" step="0.01" min="0"
                       value="{{ old('price') }}" placeholder="0.00">
                @error('price') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            <div class="ios-form-group">
                <label class="ios-form-label">Stock Quantity <span class="req">*</span></label>
                <input type="number" name="stock_quantity" class="ios-input" min="0"
                       value="{{ old('stock_quantity', 0) }}" placeholder="0">
                @error('stock_quantity') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            <div class="ios-form-group">
                <label class="ios-form-label">Expiry Date</label>
                <input type="date" name="expiry_date" class="ios-input" value="{{ old('expiry_date') }}">
                @error('expiry_date') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            {{-- Image & Status --}}
            <div class="ios-section-header" style="padding-left:4px; margin:20px 0 12px;">Image & Status</div>

            <div class="ios-form-group">
                <label class="ios-form-label">Product Image</label>
                <input type="file" name="image" class="ios-input" accept="image/*">
                @error('image') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            <div class="ios-form-group">
                <div class="ios-toggle-row">
                    <span class="ios-toggle-label">Active Product</span>
                    <input type="checkbox" name="is_active" value="1" class="ios-switch"
                           {{ old('is_active', 1) ? 'checked' : '' }}>
                </div>
            </div>

            {{-- Submit --}}
            <div style="margin-top:12px; margin-bottom:32px;">
                <button type="submit" class="ios-btn ios-btn-primary ios-btn-full">
                    <i class="bi bi-plus-circle"></i> Save Product
                </button>
            </div>

        </div>
    </form>

@endsection
