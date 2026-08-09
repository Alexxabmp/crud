@extends('layouts.app')

@section('title', $product->name)
@section('page-title', 'Product Detail')

@section('back-btn')
    <a href="{{ route('products.index') }}" class="ios-back-btn">
        <i class="bi bi-chevron-left"></i> Products
    </a>
@endsection

@section('topbar-actions')
    <a href="{{ route('products.edit', $product) }}" class="ios-btn ios-btn-blue ios-btn-sm">
        <i class="bi bi-pencil"></i> Edit
    </a>
@endsection

@section('content')

    {{-- Hero Summary Card --}}
    <div class="ios-section">
        <div class="ios-card" style="margin-bottom:0;">
            <div style="padding:16px 16px 14px; border-bottom:0.5px solid var(--ios-separator);">
                <div style="font-size:19px;font-weight:700;color:var(--ios-label);margin-bottom:4px;">
                    {{ $product->name }}
                </div>
                <div class="sku-val">{{ $product->sku }}</div>
                <div style="margin-top:8px;display:flex;gap:6px;flex-wrap:wrap;">
                    <span class="ios-badge badge-cat">{{ $product->category }}</span>
                    <span class="ios-badge {{ $product->is_active ? 'badge-active' : 'badge-inactive' }}">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            {{-- Price + Stock --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;">
                <div style="padding:14px 16px;border-right:0.5px solid var(--ios-separator);text-align:center;">
                    {{-- Blue = informational/value --}}
                    <div style="font-size:22px;font-weight:700;color:var(--ios-blue);">
                        ₱{{ number_format($product->price, 2) }}
                    </div>
                    <div style="font-size:11px;color:var(--ios-label2);margin-top:2px;">Price · DECIMAL</div>
                </div>
                <div style="padding:14px 16px;text-align:center;">
                    <div style="font-size:22px;font-weight:700;
                        color:{{ $product->stock_quantity < 10 ? 'var(--ios-red)' : 'var(--ios-green)' }};">
                        {{ $product->stock_quantity }}
                    </div>
                    <div style="font-size:11px;color:var(--ios-label2);margin-top:2px;">Stock · INT</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Field Details --}}
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
                <span class="ios-detail-value" style="color:var(--ios-blue);font-weight:700;">
                    ₱{{ number_format($product->price, 2) }}
                </span>
                <span class="ios-detail-type">DECIMAL</span>
            </div>

            <div class="ios-detail-row">
                <span class="ios-detail-label">Stock Qty</span>
                <span class="ios-detail-value"
                      style="color:{{ $product->stock_quantity < 10 ? 'var(--ios-red)' : 'var(--ios-green)' }};font-weight:600;">
                    {{ $product->stock_quantity }}
                </span>
                <span class="ios-detail-type">INT</span>
            </div>

            <div class="ios-detail-row">
                <span class="ios-detail-label">Active</span>
                {{-- Green = yes/confirmed, Red = no/warning --}}
                <span class="ios-detail-value"
                      style="color:{{ $product->is_active ? 'var(--ios-green)' : 'var(--ios-red)' }};font-weight:600;">
                    {{ $product->is_active ? 'Yes' : 'No' }}
                </span>
                <span class="ios-detail-type">BOOLEAN</span>
            </div>

            <div class="ios-detail-row">
                <span class="ios-detail-label">Expiry Date</span>
                <span class="ios-detail-value">
                    {{ $product->expiry_date
                        ? \Carbon\Carbon::parse($product->expiry_date)->format('M d, Y')
                        : '—' }}
                </span>
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
            <div class="ios-detail-row" style="flex-direction:column;gap:6px;">
                <div style="display:flex;align-items:center;justify-content:space-between;width:100%;">
                    <span class="ios-detail-label">Description</span>
                    <span class="ios-detail-type">TEXT</span>
                </div>
                <span style="font-size:14px;color:var(--ios-label2);line-height:1.5;">
                    {{ $product->description }}
                </span>
            </div>
            @endif

        </div>
    </div>

    {{-- Bottom Actions --}}
    <div style="padding:0 16px 32px;display:flex;gap:10px;">
        {{-- Blue = actionable/edit --}}
        <a href="{{ route('products.edit', $product) }}"
           class="ios-btn ios-btn-blue ios-btn-full" style="flex:2;justify-content:center;">
            <i class="bi bi-pencil"></i> Edit Product
        </a>
        {{-- Red = destructive/delete --}}
        <button onclick="openDeleteModal({{ $product->id }}, '{{ addslashes($product->name) }}')"
                class="ios-btn ios-btn-red ios-btn-full" style="flex:1;justify-content:center;">
            <i class="bi bi-trash3"></i> Delete
        </button>
    </div>

@endsection
