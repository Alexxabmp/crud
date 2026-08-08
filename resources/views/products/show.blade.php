@extends('layouts.app')

@section('title', $product->name . ' — Details')
@section('page-title', 'Product Details')
@section('page-subtitle', 'Complete information for this product')

@section('topbar-actions')
    <a href="{{ route('products.edit', $product) }}" class="btn-primary-custom" id="btn-edit-product">
        <i class="bi bi-pencil"></i> Edit
    </a>
    <a href="{{ route('products.index') }}" class="btn-outline-custom" id="btn-back-from-show">
        <i class="bi bi-arrow-left"></i> Back
    </a>
@endsection

@section('content')
<div class="row g-4">
    {{-- Left: Image + Quick Info --}}
    <div class="col-lg-4">
        <div class="card-glass h-100">
            <div class="card-body" style="text-align:center; padding:32px 24px;">
                {{-- Product Image --}}
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         style="width:180px; height:180px; object-fit:cover; border-radius:16px; border:1px solid var(--border-color); margin-bottom:20px;">
                @else
                    <div style="width:180px; height:180px; background:rgba(108,99,255,0.08); border-radius:16px; border:2px dashed rgba(108,99,255,0.3); display:flex; flex-direction:column; align-items:center; justify-content:center; margin: 0 auto 20px; color:var(--accent-1);">
                        <i class="bi bi-image" style="font-size:3rem; opacity:0.5;"></i>
                        <span style="font-size:0.72rem; color:var(--text-muted); margin-top:8px;">No image</span>
                    </div>
                @endif

                <h4 style="font-weight:700; font-size:1.2rem; margin-bottom:6px;">{{ $product->name }}</h4>
                <div class="sku-text mb-3">{{ $product->sku }}</div>

                <span class="badge-category" style="font-size:0.82rem; padding:5px 14px;">{{ $product->category }}</span>

                <div style="margin-top:24px; padding-top:20px; border-top:1px solid var(--border-color);">
                    <div style="font-size:2rem; font-weight:800; color:var(--success-color);">
                        ₱{{ number_format($product->price, 2) }}
                    </div>
                    <div style="font-size:0.75rem; color:var(--text-muted); margin-top:4px;">Unit Price</div>
                </div>

                <div style="margin-top:16px; display:flex; gap:12px; justify-content:center; flex-wrap:wrap;">
                    <div style="background:var(--bg-card); border:1px solid var(--border-color); border-radius:10px; padding:10px 18px; text-align:center;">
                        <div style="font-size:1.4rem; font-weight:700; color: {{ $product->stock_quantity < 10 ? 'var(--warning-color)' : 'var(--text-primary)' }}">
                            {{ number_format($product->stock_quantity) }}
                        </div>
                        <div style="font-size:0.7rem; color:var(--text-muted);">In Stock</div>
                    </div>
                    <div style="background:var(--bg-card); border:1px solid var(--border-color); border-radius:10px; padding:10px 18px; text-align:center;">
                        @if($product->is_active)
                            <div style="font-size:1.1rem; color:var(--success-color);"><i class="bi bi-check-circle-fill"></i></div>
                            <div style="font-size:0.7rem; color:var(--text-muted);">Active</div>
                        @else
                            <div style="font-size:1.1rem; color:var(--danger-color);"><i class="bi bi-x-circle-fill"></i></div>
                            <div style="font-size:0.7rem; color:var(--text-muted);">Inactive</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Right: Full Details --}}
    <div class="col-lg-8">
        <div class="card-glass">
            <div class="card-header">
                <h5 style="font-weight:700; font-size:1rem; margin:0;">Product Specifications</h5>
                <p style="font-size:0.75rem; color:var(--text-secondary); margin:4px 0 0;">All fields with their database data types</p>
            </div>
            <div class="card-body">
                <div class="detail-row">
                    <div class="detail-label">
                        <div>Product ID</div>
                        <div style="color:var(--accent-1); font-size:0.65rem; margin-top:2px; font-family:monospace;">INT (PK)</div>
                    </div>
                    <div class="detail-value">
                        <span style="font-family:monospace; background:var(--bg-card); padding:2px 8px; border-radius:6px; border:1px solid var(--border-color);">#{{ $product->id }}</span>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">
                        <div>Name</div>
                        <div style="color:var(--accent-1); font-size:0.65rem; margin-top:2px; font-family:monospace;">VARCHAR(150)</div>
                    </div>
                    <div class="detail-value" style="font-weight:600;">{{ $product->name }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">
                        <div>SKU</div>
                        <div style="color:var(--accent-1); font-size:0.65rem; margin-top:2px; font-family:monospace;">VARCHAR(50)</div>
                    </div>
                    <div class="detail-value"><span class="sku-text">{{ $product->sku }}</span></div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">
                        <div>Category</div>
                        <div style="color:var(--accent-1); font-size:0.65rem; margin-top:2px; font-family:monospace;">ENUM</div>
                    </div>
                    <div class="detail-value"><span class="badge-category">{{ $product->category }}</span></div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">
                        <div>Price</div>
                        <div style="color:var(--accent-1); font-size:0.65rem; margin-top:2px; font-family:monospace;">DECIMAL(10,2)</div>
                    </div>
                    <div class="detail-value price-text">₱{{ number_format($product->price, 2) }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">
                        <div>Stock Quantity</div>
                        <div style="color:var(--accent-1); font-size:0.65rem; margin-top:2px; font-family:monospace;">INT</div>
                    </div>
                    <div class="detail-value">{{ number_format($product->stock_quantity) }} units</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">
                        <div>Expiry Date</div>
                        <div style="color:var(--accent-1); font-size:0.65rem; margin-top:2px; font-family:monospace;">DATE</div>
                    </div>
                    <div class="detail-value">
                        {{ $product->expiry_date ? $product->expiry_date->format('F d, Y') : '—' }}
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">
                        <div>Status</div>
                        <div style="color:var(--accent-1); font-size:0.65rem; margin-top:2px; font-family:monospace;">BOOLEAN</div>
                    </div>
                    <div class="detail-value">
                        @if($product->is_active)
                            <span class="badge-active"><i class="bi bi-circle-fill" style="font-size:0.5rem;"></i> Active</span>
                        @else
                            <span class="badge-inactive"><i class="bi bi-circle-fill" style="font-size:0.5rem;"></i> Inactive</span>
                        @endif
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">
                        <div>Description</div>
                        <div style="color:var(--accent-1); font-size:0.65rem; margin-top:2px; font-family:monospace;">TEXT</div>
                    </div>
                    <div class="detail-value" style="color:var(--text-secondary); line-height:1.6;">
                        {{ $product->description ?: '—' }}
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">
                        <div>Image Path</div>
                        <div style="color:var(--accent-1); font-size:0.65rem; margin-top:2px; font-family:monospace;">VARCHAR(255)</div>
                    </div>
                    <div class="detail-value" style="color:var(--text-secondary); font-size:0.8rem; font-family:monospace;">
                        {{ $product->image ?: '—' }}
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">
                        <div>Created At</div>
                        <div style="color:var(--accent-1); font-size:0.65rem; margin-top:2px; font-family:monospace;">DATETIME</div>
                    </div>
                    <div class="detail-value" style="color:var(--text-secondary);">
                        {{ $product->created_at->format('F d, Y h:i A') }}
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">
                        <div>Updated At</div>
                        <div style="color:var(--accent-1); font-size:0.65rem; margin-top:2px; font-family:monospace;">DATETIME</div>
                    </div>
                    <div class="detail-value" style="color:var(--text-secondary);">
                        {{ $product->updated_at->format('F d, Y h:i A') }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div style="display:flex; gap:12px; margin-top:16px;">
            <a href="{{ route('products.edit', $product) }}" class="btn-primary-custom" id="btn-edit-from-show">
                <i class="bi bi-pencil-square"></i> Edit Product
            </a>
            <button class="btn-danger-custom"
                    style="padding:9px 18px;"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteModal"
                    data-product-id="{{ $product->id }}"
                    data-product-name="{{ $product->name }}"
                    id="btn-delete-from-show">
                <i class="bi bi-trash3-fill"></i> Delete
            </button>
            <a href="{{ route('products.index') }}" class="btn-outline-custom" id="btn-back-from-show2">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
</div>
@endsection
