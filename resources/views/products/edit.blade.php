@extends('layouts.app')

@section('title', 'Edit ' . $product->name)
@section('page-title', 'Edit Product')

@section('back-btn')
    <a href="{{ route('products.show', $product) }}" class="ios-back-btn">
        <i class="bi bi-chevron-left"></i> Detail
    </a>
@endsection

@section('content')

    <form id="editForm" method="POST" action="{{ route('products.update', $product) }}">
        @csrf
        @method('PUT')

        <div class="ios-form-wrap">

            {{-- Row 1: Name + SKU --}}
            <div class="ios-section-header" style="padding-left:4px;margin-bottom:10px;">Basic Info</div>
            <div class="form-grid-2" style="margin-bottom:14px;">
                <div class="ios-form-group" style="margin-bottom:0;">
                    <label class="ios-form-label">Name <span class="req">*</span></label>
                    <input type="text" name="name" class="ios-input"
                           value="{{ old('name', $product->name) }}" placeholder="Product name">
                    @error('name') <div class="ios-input-error">{{ $message }}</div> @enderror
                </div>
                <div class="ios-form-group" style="margin-bottom:0;">
                    <label class="ios-form-label">SKU <span class="req">*</span></label>
                    <input type="text" name="sku" class="ios-input"
                           value="{{ old('sku', $product->sku) }}" placeholder="SKU code">
                    @error('sku') <div class="ios-input-error">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Row 2: Category + Expiry --}}
            <div class="form-grid-2" style="margin-bottom:14px;">
                <div class="ios-form-group" style="margin-bottom:0;">
                    <label class="ios-form-label">Category <span class="req">*</span></label>
                    <select name="category" class="ios-input">
                        <option value="">Select…</option>
                        @foreach(['Electronics','Clothing','Food & Beverages','Health & Beauty','Home & Living','Books & Media','Toys & Games','Other'] as $cat)
                            <option value="{{ $cat }}"
                                {{ old('category', $product->category) == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                    @error('category') <div class="ios-input-error">{{ $message }}</div> @enderror
                </div>
                <div class="ios-form-group" style="margin-bottom:0;">
                    <label class="ios-form-label">Expiry Date</label>
                    <input type="date" name="expiry_date" class="ios-input"
                           value="{{ old('expiry_date', $product->expiry_date
                               ? \Carbon\Carbon::parse($product->expiry_date)->format('Y-m-d') : '') }}">
                    @error('expiry_date') <div class="ios-input-error">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Description full width --}}
            <div class="ios-form-group">
                <label class="ios-form-label">Description</label>
                <textarea name="description" class="ios-input"
                          placeholder="Product description…">{{ old('description', $product->description) }}</textarea>
                @error('description') <div class="ios-input-error">{{ $message }}</div> @enderror
            </div>

            {{-- Row 3: Price + Stock --}}
            <div class="ios-section-header" style="padding-left:4px;margin:4px 0 10px;">Pricing & Stock</div>
            <div class="form-grid-2" style="margin-bottom:14px;">
                <div class="ios-form-group" style="margin-bottom:0;">
                    <label class="ios-form-label">Price (₱) <span class="req">*</span></label>
                    <input type="number" name="price" class="ios-input"
                           step="0.01" min="0"
                           value="{{ old('price', $product->price) }}" placeholder="0.00">
                    @error('price') <div class="ios-input-error">{{ $message }}</div> @enderror
                </div>
                <div class="ios-form-group" style="margin-bottom:0;">
                    <label class="ios-form-label">Stock Qty <span class="req">*</span></label>
                    <input type="number" name="stock_quantity" class="ios-input"
                           min="0" value="{{ old('stock_quantity', $product->stock_quantity) }}"
                           placeholder="0">
                    @error('stock_quantity') <div class="ios-input-error">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Active toggle --}}
            <div class="ios-section-header" style="padding-left:4px;margin:4px 0 10px;">Status</div>
            <div class="ios-form-group">
                <div class="ios-toggle-row">
                    <span class="ios-toggle-label">Active Product</span>
                    <input type="checkbox" name="is_active" value="1"
                           class="ios-switch"
                           {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                </div>
            </div>

            {{-- Actions --}}
            <div style="margin-top:8px;margin-bottom:32px;display:flex;gap:10px;">
                <a href="{{ route('products.show', $product) }}"
                   class="ios-btn ios-btn-gray ios-btn-full" style="flex:1;justify-content:center;">
                    Cancel
                </a>
                <button type="submit"
                        class="ios-btn ios-btn-green ios-btn-full" style="flex:2;justify-content:center;">
                    <i class="bi bi-check-circle"></i> Save Changes
                </button>
            </div>

        </div>
    </form>

@endsection
