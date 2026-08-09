@extends('layouts.app')

@section('title', 'Products')
@section('page-title', 'All Products')

@section('topbar-actions')
    <a href="{{ route('products.create') }}" class="ios-btn ios-btn-blue ios-btn-sm">
        <i class="bi bi-plus"></i> Add
    </a>
@endsection

@section('content')

    {{-- Compact Stats --}}
    <div class="ios-stats-grid">
        <div class="ios-stat-card">
            <div class="ios-stat-icon icon-blue"><i class="bi bi-box-seam"></i></div>
            <div class="ios-stat-value">{{ \App\Models\Product::count() }}</div>
            <div class="ios-stat-label">Total</div>
        </div>
        <div class="ios-stat-card">
            <div class="ios-stat-icon icon-green"><i class="bi bi-check-circle"></i></div>
            <div class="ios-stat-value">{{ \App\Models\Product::where('is_active', true)->count() }}</div>
            <div class="ios-stat-label">Active</div>
        </div>
        <div class="ios-stat-card">
            <div class="ios-stat-icon icon-red"><i class="bi bi-x-circle"></i></div>
            <div class="ios-stat-value">{{ \App\Models\Product::where('is_active', false)->count() }}</div>
            <div class="ios-stat-label">Inactive</div>
        </div>
        <div class="ios-stat-card">
            <div class="ios-stat-icon icon-orange"><i class="bi bi-exclamation-triangle"></i></div>
            <div class="ios-stat-value">{{ \App\Models\Product::where('stock_quantity', '<', 10)->count() }}</div>
            <div class="ios-stat-label">Low Stock</div>
        </div>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('products.index') }}">
        <div class="ios-search-wrap">
            <div class="ios-search">
                <i class="bi bi-search"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Search…">
                @if($search)
                    <a href="{{ route('products.index') }}"
                       style="color:var(--ios-gray);text-decoration:none;font-size:16px;line-height:1;">
                        <i class="bi bi-x-circle-fill"></i>
                    </a>
                @else
                    <button type="submit"
                            style="background:none;border:none;color:var(--ios-blue);font-size:13px;font-weight:600;cursor:pointer;font-family:inherit;padding:0;">
                        Search
                    </button>
                @endif
            </div>
        </div>
    </form>

    {{-- Product List --}}
    <div class="ios-section">
        @if($search)
            <div class="ios-section-header">Results for "{{ $search }}"</div>
        @else
            <div class="ios-section-header">Inventory ({{ $products->total() }})</div>
        @endif

        @if($products->isEmpty())
            <div class="ios-card">
                <div class="ios-empty">
                    <span class="empty-icon"><i class="bi bi-box-seam"></i></span>
                    <h3>No Products Found</h3>
                    <p>{{ $search ? 'Try a different search term.' : 'Add your first product.' }}</p>
                    <a href="{{ route('products.create') }}" class="ios-btn ios-btn-blue">
                        <i class="bi bi-plus"></i> Add Product
                    </a>
                </div>
            </div>
        @else
            <div class="ios-card">
                @foreach($products as $product)
                    <div class="ios-card-row">
                        {{-- Content --}}
                        <div class="row-content">
                            <div class="row-title">{{ $product->name }}</div>
                            <div class="row-subtitle">
                                <span class="sku-val">{{ $product->sku }}</span>
                                &nbsp;·&nbsp;
                                <span class="ios-badge badge-cat">{{ $product->category }}</span>
                            </div>
                        </div>

                        {{-- Price + Status --}}
                        <div class="row-right" style="flex-direction:column;align-items:flex-end;gap:4px;">
                            <span class="price-val" style="font-size:14px;">
                                ₱{{ number_format($product->price, 2) }}
                            </span>
                            <span class="ios-badge {{ $product->is_active ? 'badge-active' : 'badge-inactive' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>

                        {{-- Actions --}}
                        <div class="ios-row-actions" style="margin-left:6px;">
                            <a href="{{ route('products.show', $product) }}" class="ios-icon-btn view"
                               title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', $product) }}" class="ios-icon-btn edit"
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button class="ios-icon-btn delete" title="Delete"
                                onclick="openDeleteModal({{ $product->id }}, '{{ addslashes($product->name) }}')">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($products->hasPages())
                <div class="ios-pagination">
                    @if($products->onFirstPage())
                        <span class="page-disabled"><i class="bi bi-chevron-left"></i></span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}&search={{ $search }}" class="page-link-item">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    @endif

                    @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if($page == $products->currentPage())
                            <span class="page-current">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}&search={{ $search }}" class="page-link-item">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}&search={{ $search }}" class="page-link-item">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    @else
                        <span class="page-disabled"><i class="bi bi-chevron-right"></i></span>
                    @endif
                </div>
            @endif
        @endif
    </div>

@endsection
