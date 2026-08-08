@extends('layouts.app')

@section('title', 'Products')
@section('page-title', 'Product Inventory')
@section('page-subtitle', 'Browse, search, and manage all products')

@section('topbar-actions')
    <a href="{{ route('products.create') }}" class="btn-primary-custom" id="btn-add-product">
        <i class="bi bi-plus-lg"></i> Add Product
    </a>
@endsection

@section('content')
{{-- Stats Row --}}
<div class="row g-3 mb-4">
    @php
        $total    = \App\Models\Product::count();
        $active   = \App\Models\Product::where('is_active', true)->count();
        $inactive = $total - $active;
        $lowStock = \App\Models\Product::where('stock_quantity', '<', 10)->count();
    @endphp
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon purple"><i class="bi bi-box-seam"></i></div>
            <div class="stat-info">
                <div class="stat-value">{{ number_format($total) }}</div>
                <div class="stat-label">Total Products</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-check-circle"></i></div>
            <div class="stat-info">
                <div class="stat-value">{{ number_format($active) }}</div>
                <div class="stat-label">Active Products</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon red"><i class="bi bi-x-circle"></i></div>
            <div class="stat-info">
                <div class="stat-value">{{ number_format($inactive) }}</div>
                <div class="stat-label">Inactive Products</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon yellow"><i class="bi bi-exclamation-triangle"></i></div>
            <div class="stat-info">
                <div class="stat-value">{{ number_format($lowStock) }}</div>
                <div class="stat-label">Low Stock (&lt;10)</div>
            </div>
        </div>
    </div>
</div>

{{-- Data Table Card --}}
<div class="card-glass">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h5 style="font-weight:700; font-size:1rem; margin:0;">All Products</h5>
            <p style="font-size:0.75rem; color:var(--text-secondary); margin:0;">
                {{ $products->total() }} record(s) found
                @if($search) for "<strong>{{ $search }}</strong>" @endif
            </p>
        </div>
        {{-- Search Form --}}
        <form method="GET" action="{{ route('products.index') }}" id="searchForm" style="display:flex; gap:10px; align-items:center;">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input
                    type="text"
                    name="search"
                    id="searchInput"
                    class="search-input form-control"
                    placeholder="Search name, SKU, category..."
                    value="{{ $search }}"
                    autocomplete="off"
                    style="width: 260px;"
                >
            </div>
            <button type="submit" class="btn-primary-custom" id="btn-search">
                <i class="bi bi-search"></i> Search
            </button>
            @if($search)
                <a href="{{ route('products.index') }}" class="btn-outline-custom" id="btn-clear-search">
                    <i class="bi bi-x-lg"></i> Clear
                </a>
            @endif
        </form>
    </div>

    <div class="card-body" style="padding:0;">
        @if($products->count() > 0)
        <div style="overflow-x:auto;">
            <table class="data-table" id="productsTable">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th style="width:50px;">Image</th>
                        <th>Product Name</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Expiry</th>
                        <th>Status</th>
                        <th style="width:130px; text-align:center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $index => $product)
                    <tr>
                        <td style="color:var(--text-muted); font-size:0.78rem;">
                            {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                        </td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="product-img">
                            @else
                                <div class="product-img-placeholder">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight:600; font-size:0.88rem;">{{ $product->name }}</div>
                            <div style="font-size:0.72rem; color:var(--text-muted); margin-top:2px;">
                                Added {{ $product->created_at->diffForHumans() }}
                            </div>
                        </td>
                        <td><span class="sku-text">{{ $product->sku }}</span></td>
                        <td><span class="badge-category">{{ $product->category }}</span></td>
                        <td><span class="price-text">₱{{ number_format($product->price, 2) }}</span></td>
                        <td>
                            @if($product->stock_quantity < 10)
                                <span style="color:var(--warning-color); font-weight:600;">
                                    <i class="bi bi-exclamation-triangle-fill" style="font-size:0.75rem;"></i>
                                    {{ number_format($product->stock_quantity) }}
                                </span>
                            @else
                                {{ number_format($product->stock_quantity) }}
                            @endif
                        </td>
                        <td style="font-size:0.82rem; color:var(--text-secondary);">
                            {{ $product->expiry_date ? $product->expiry_date->format('M d, Y') : '—' }}
                        </td>
                        <td>
                            @if($product->is_active)
                                <span class="badge-active"><i class="bi bi-circle-fill" style="font-size:0.5rem;"></i> Active</span>
                            @else
                                <span class="badge-inactive"><i class="bi bi-circle-fill" style="font-size:0.5rem;"></i> Inactive</span>
                            @endif
                        </td>
                        <td style="text-align:center;">
                            <div style="display:flex; gap:6px; justify-content:center;">
                                {{-- View --}}
                                <a href="{{ route('products.show', $product) }}"
                                   class="action-btn view"
                                   title="View Details"
                                   id="btn-view-{{ $product->id }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                                {{-- Edit --}}
                                <a href="{{ route('products.edit', $product) }}"
                                   class="action-btn edit"
                                   title="Edit"
                                   id="btn-edit-{{ $product->id }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                {{-- Delete --}}
                                <button class="action-btn delete"
                                        title="Delete"
                                        id="btn-delete-{{ $product->id }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
        <div style="padding: 16px 24px; border-top: 1px solid var(--border-color); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
            <div style="font-size:0.78rem; color:var(--text-muted);">
                Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} products
            </div>
            {{ $products->links() }}
        </div>
        @endif

        @else
        <div class="empty-state">
            <div class="empty-icon"><i class="bi bi-inbox"></i></div>
            <h5>No products found</h5>
            <p>
                @if($search)
                    No results for "{{ $search }}". Try a different keyword.
                @else
                    Get started by adding your first product.
                @endif
            </p>
            @if(!$search)
            <a href="{{ route('products.create') }}" class="btn-primary-custom mt-3 d-inline-flex" id="btn-add-first">
                <i class="bi bi-plus-lg"></i> Add First Product
            </a>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Override Bootstrap pagination */
    .pagination { margin: 0; }
    nav[aria-label="pagination"] ul { margin:0; }
</style>
@endpush
