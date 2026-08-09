@extends('layouts.app')

@section('title', $product->name)
@section('page-title', 'Product Detail')

@section('back-btn')
    <a href="{{ route('products.index') }}" class="ios-back-btn">
        <i class="bi bi-chevron-left"></i> Products
    </a>
@endsection

@section('topbar-actions')
    <a href="{{ route('products.edit', $product) }}" class="ios-btn ios-btn-ghost ios-btn-sm">
        <i class="bi bi-pencil"></i> Edit
    </a>
@endsection

@section('content')

    {{-- Hero Card --}}
    <div class="ios-section">
        <div class="ios-card" style="margin-bottom:0;">
            <div style="padding: 20px; display:flex; gap:16px; align-items:center; border-bottom: 0.5px solid var(--ios-separator-s);">
                @if($product->image && file_exists(storage_path('app/public/' . $product->image)))
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                         style="width:72px;height:72px;border-radius:16px;object-fit:cover;flex-shrink:0;">
                @else
                    <div style="width:72px;height:72px;border-radius:16px;background:var(--ios-pink-light);display:flex;align-items:center;justify-content:center;font-size:32px;flex-shrink:0;">📦</div>
                @endif
                <div style="flex:1;">
                    <div style="font-size:20px;font-weight:700;color:var(--ios-label);margin-bottom:4px;">
                        {{ $product->name }}
                    </div>
                    <div class="sku-val">{{ $product->sku }}</div>
                    <div style="margin-top:6px; display:flex; gap:6px; flex-wrap:wrap;">
                        <span class="ios-badge badge-cat">{{ $product->category }}</span>
                        <span class="ios-badge {{ $product->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Price + Stock Row --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;border-bottom:0.5px solid var(--ios-separator-s);">
                <div style="padding:16px;border-right:0.5px solid var(--ios-separator-s);text-align:center;">
                    <div style="font-size:24px;font-weight:700;color:var(--ios-pink);">
                        ₱{{ number_format($product->price, 2) }}
                    </div>
                    <div style="font-size:12px;color:var(--ios-label2);margin-top:2px;">Price · DECIMAL</div>
                </div>
                <div style="padding:16px;text-align:center;">
                    <div style="font-size:24px;font-weight:700;color:{{ $product->stock_quantity < 10 ? 'var(--ios-red)' : 'var(--ios-green)' }};">
                        {{ $product->stock_quantity }}
                    </div>
                    <div style="font-size:12px;color:var(--ios-label2);margin-top:2px;">Stock · INT</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Type Details --}}
    <div class="ios-section">
        <div class="ios-section-header">Field Details & Data Types</div>
        <div class="ios-detail-card">

            <div class="ios-detail-row">
                <span class="ios-detail-label">Name</span>
                <span class="ios-detail-value">{{ $product->name }}</span>
                <span class="ios-detail-type">VARCHAR</span>
            </div>

            <div class="ios-detail-row">
                <span class="ios-detail-label">SKU</span>
                <span class="ios-detail-value sku-val">{{ $product->sku }}</span>
                <span class="ios-detail-type">VARCHAR</span>
            </div>

            <div class="ios-detail-row">
                <span class="ios-detail-label">Category</span>
                <span class="ios-detail-value">{{ $product->category }}</span>
                <span class="ios-detail-type">ENUM</span>
            </div>

            <div class="ios-detail-row">
                <span class="ios-detail-label">Price</span>
                <span class="ios-detail-value price-val">₱{{ number_format($product->price, 2) }}</span>
                <span class="ios-detail-type">DECIMAL</span>
            </div>

            <div class="ios-detail-row">
                <span class="ios-detail-label">Stock</span>
                <span class="ios-detail-value">{{ $product->stock_quantity }}</span>
                <span class="ios-detail-type">INT</span>
            </div>

            <div class="ios-detail-row">
                <span class="ios-detail-label">Active</span>
                <span class="ios-detail-value">{{ $product->is_active ? 'Yes' : 'No' }}</span>
                <span class="ios-detail-type">BOOLEAN</span>
            </div>

            <div class="ios-detail-row">
                <span class="ios-detail-label">Expiry Date</span>
                <span class="ios-detail-value">{{ $product->expiry_date ? \Carbon\Carbon::parse($product->expiry_date)->format('M d, Y') : '—' }}</span>
                <span class="ios-detail-type">DATE</span>
            </div>

            <div class="ios-detail-row">
                <span class="ios-detail-label">Created</span>
                <span class="ios-detail-value">{{ $product->created_at->format('M d, Y h:i A') }}</span>
                <span class="ios-detail-type">DATETIME</span>
            </div>

            <div class="ios-detail-row">
                <span class="ios-detail-label">Updated</span>
                <span class="ios-detail-value">{{ $product->updated_at->format('M d, Y h:i A') }}</span>
                <span class="ios-detail-type">DATETIME</span>
            </div>

            @if($product->description)
            <div class="ios-detail-row" style="flex-direction:column; gap:6px;">
                <div style="display:flex;align-items:center;justify-content:space-between;width:100%;">
                    <span class="ios-detail-label">Description</span>
                    <span class="ios-detail-type">TEXT</span>
                </div>
                <span class="ios-detail-value" style="font-size:14px;color:var(--ios-label2);line-height:1.5;">
                    {{ $product->description }}
                </span>
            </div>
            @endif

        </div>
    </div>

    {{-- Actions --}}
    <div style="padding: 0 16px 32px; display:flex; gap:12px;">
        <a href="{{ route('products.edit', $product) }}" class="ios-btn ios-btn-ghost" style="flex:1;justify-content:center;">
            <i class="bi bi-pencil"></i> Edit Product
        </a>
        <button onclick="openDeleteModal({{ $product->id }}, '{{ addslashes($product->name) }}')"
                class="ios-btn ios-btn-danger" style="flex:1;justify-content:center;">
            <i class="bi bi-trash3"></i> Delete
        </button>
    </div>

@endsection
