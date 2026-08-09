@extends('layouts.app')

@section('title', 'Edit ' . $product->name)
@section('page-title', 'Edit Product')

@section('back-btn')
    <a href="{{ route('products.show', $product) }}" class="ios-back-btn">
        <i class="bi bi-chevron-left"></i> Detail
    </a>
@endsection

@section('topbar-actions')
    <button type="submit" form="editForm" class="ios-btn ios-btn-primary ios-btn-sm">
        Save
    </button>
@endsection

@section('content')

    <form id="editForm" method="POST"
          action="{{ route('products.update', $product) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="ios-form-wrap">

            {{-- Basic Info --}}
            <div class="ios-section-header" style="padding-left:4px; margin-bottom:12px;">Basic Info</div>

            <div class="ios-form-group">
                <label class="ios-form-label">Product Name <span class="req">*</span></label>
                <input type="text" name="name" class="ios-input"
                       value="{{ old('name', $product->name) }}" placeholder="Product name">
                @error('name') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            <div class="ios-form-group">
                <label class="ios-form-label">SKU <span class="req">*</span></label>
                <input type="text" name="sku" class="ios-input"
                       value="{{ old('sku', $product->sku) }}" placeholder="SKU code">
                @error('sku') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            <div class="ios-form-group">
                <label class="ios-form-label">Category <span class="req">*</span></label>
                <select name="category" class="ios-input">
                    <option value="">Select category…</option>
                    @foreach(['Electronics','Clothing','Food & Beverages','Health & Beauty','Home & Living','Books & Media','Toys & Games','Other'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
                @error('category') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            <div class="ios-form-group">
                <label class="ios-form-label">Description</label>
                <textarea name="description" class="ios-input" placeholder="Product description…">{{ old('description', $product->description) }}</textarea>
                @error('description') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            {{-- Pricing & Stock --}}
            <div class="ios-section-header" style="padding-left:4px; margin:20px 0 12px;">Pricing & Stock</div>

            <div class="ios-form-group">
                <label class="ios-form-label">Price (₱) <span class="req">*</span></label>
                <input type="number" name="price" class="ios-input" step="0.01" min="0"
                       value="{{ old('price', $product->price) }}" placeholder="0.00">
                @error('price') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            <div class="ios-form-group">
                <label class="ios-form-label">Stock Quantity <span class="req">*</span></label>
                <input type="number" name="stock_quantity" class="ios-input" min="0"
                       value="{{ old('stock_quantity', $product->stock_quantity) }}" placeholder="0">
                @error('stock_quantity') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            <div class="ios-form-group">
                <label class="ios-form-label">Expiry Date</label>
                <input type="date" name="expiry_date" class="ios-input"
                       value="{{ old('expiry_date', $product->expiry_date ? \Carbon\Carbon::parse($product->expiry_date)->format('Y-m-d') : '') }}">
                @error('expiry_date') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            {{-- Image & Status --}}
            <div class="ios-section-header" style="padding-left:4px; margin:20px 0 12px;">Image & Status</div>

            @if($product->image)
                <div class="ios-form-group">
                    <label class="ios-form-label">Current Image</label>
                    <div style="display:flex;align-items:center;gap:12px;background:var(--ios-card);padding:12px;border-radius:var(--radius-md);box-shadow:var(--shadow-card);">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             style="width:56px;height:56px;border-radius:10px;object-fit:cover;">
                        <span style="font-size:14px;color:var(--ios-label2);">Upload a new image to replace</span>
                    </div>
                </div>
            @endif

            <div class="ios-form-group">
                <label class="ios-form-label">{{ $product->image ? 'Replace Image' : 'Product Image' }}</label>
                <input type="file" name="image" class="ios-input" accept="image/*">
                @error('image') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            <div class="ios-form-group">
                <div class="ios-toggle-row">
                    <span class="ios-toggle-label">Active Product</span>
                    <input type="checkbox" name="is_active" value="1" class="ios-switch"
                           {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                </div>
            </div>

            {{-- Submit --}}
            <div style="margin-top:12px; margin-bottom:32px; display:flex; gap:12px;">
                <a href="{{ route('products.show', $product) }}"
                   class="ios-btn ios-btn-gray ios-btn-full" style="flex:1;justify-content:center;">
                    Cancel
                </a>
                <button type="submit" class="ios-btn ios-btn-primary ios-btn-full" style="flex:2;justify-content:center;">
                    <i class="bi bi-check-circle"></i> Save Changes
                </button>
            </div>

        </div>
    </form>

@endsection
