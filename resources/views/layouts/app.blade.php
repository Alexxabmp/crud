<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Product Inventory Management — a powerful CRUD system built with Laravel and MySQL.">
    <title>@yield('title', 'Product Inventory') — InvenTrack</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --bg-primary:     #0d0f1a;
            --bg-secondary:   #12162b;
            --bg-card:        rgba(255,255,255,0.04);
            --bg-card-hover:  rgba(255,255,255,0.07);
            --border-color:   rgba(255,255,255,0.08);
            --accent-1:       #6c63ff;
            --accent-2:       #9b8bff;
            --accent-grad:    linear-gradient(135deg, #6c63ff 0%, #a78bfa 100%);
            --success-color:  #22d3a8;
            --danger-color:   #f87171;
            --warning-color:  #fbbf24;
            --text-primary:   #f0f2ff;
            --text-secondary: #94a3b8;
            --text-muted:     #4b5563;
            --sidebar-w:      260px;
            --radius:         14px;
            --shadow:         0 8px 32px rgba(0,0,0,0.4);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
        }

        /* ─── Sidebar ─────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--bg-secondary);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            padding: 28px 24px 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-brand .brand-icon {
            width: 40px; height: 40px;
            background: var(--accent-grad);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .sidebar-brand h1 {
            font-size: 1.25rem;
            font-weight: 700;
            background: var(--accent-grad);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.3px;
        }

        .sidebar-brand p {
            font-size: 0.72rem;
            color: var(--text-secondary);
            margin-top: 2px;
        }

        .sidebar-nav {
            padding: 20px 16px;
            flex: 1;
        }

        .nav-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 0 8px;
            margin-bottom: 8px;
        }

        .nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 12px;
            border-radius: 10px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 4px;
            transition: all 0.2s;
        }

        .nav-item:hover, .nav-item.active {
            background: var(--bg-card);
            color: var(--text-primary);
        }

        .nav-item.active {
            background: rgba(108, 99, 255, 0.15);
            color: var(--accent-2);
        }

        .nav-item .bi { font-size: 1.05rem; }

        .sidebar-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--border-color);
        }

        .sidebar-footer small {
            color: var(--text-muted);
            font-size: 0.7rem;
        }

        /* ─── Main Content ─────────────────────────────── */
        .main-content {
            margin-left: var(--sidebar-w);
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ─── Top Bar ──────────────────────────────────── */
        .topbar {
            padding: 20px 32px;
            border-bottom: 1px solid var(--border-color);
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(13, 15, 26, 0.8);
            backdrop-filter: blur(20px);
            position: sticky; top: 0; z-index: 50;
        }

        .topbar-title h2 {
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: -0.4px;
        }

        .topbar-title p {
            font-size: 0.78rem;
            color: var(--text-secondary);
            margin-top: 2px;
        }

        .topbar-actions { display: flex; gap: 12px; align-items: center; }

        /* ─── Page Body ─────────────────────────────────── */
        .page-body {
            padding: 32px;
            flex: 1;
        }

        /* ─── Cards / Glass ─────────────────────────────── */
        .card-glass {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            backdrop-filter: blur(16px);
        }

        .card-glass .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 18px 24px;
        }

        .card-glass .card-body { padding: 24px; }

        /* ─── Stats Cards ─────────────────────────────── */
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            padding: 20px;
            display: flex; gap: 16px; align-items: center;
            transition: all 0.2s;
        }

        .stat-card:hover {
            background: var(--bg-card-hover);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
        }

        .stat-icon.purple { background: rgba(108,99,255,0.15); color: var(--accent-1); }
        .stat-icon.green  { background: rgba(34,211,168,0.15); color: var(--success-color); }
        .stat-icon.yellow { background: rgba(251,191,36,0.15); color: var(--warning-color); }
        .stat-icon.red    { background: rgba(248,113,113,0.15); color: var(--danger-color); }

        .stat-info .stat-value {
            font-size: 1.6rem;
            font-weight: 700;
            line-height: 1;
        }

        .stat-info .stat-label {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        /* ─── Buttons ───────────────────────────────────── */
        .btn-primary-custom {
            background: var(--accent-grad);
            border: none;
            color: #fff;
            padding: 9px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-primary-custom:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(108,99,255,0.4);
            color: #fff;
        }

        .btn-outline-custom {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            padding: 8px 18px;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.85rem;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-outline-custom:hover {
            background: var(--bg-card-hover);
            border-color: rgba(255,255,255,0.15);
            color: var(--text-primary);
        }

        .btn-danger-custom {
            background: rgba(248,113,113,0.15);
            border: 1px solid rgba(248,113,113,0.3);
            color: var(--danger-color);
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 0.82rem;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            display: inline-flex; align-items: center; gap: 6px;
            transition: all 0.2s;
        }

        .btn-danger-custom:hover {
            background: rgba(248,113,113,0.25);
        }

        /* ─── Table ─────────────────────────────────────── */
        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .data-table thead th {
            background: rgba(255,255,255,0.03);
            padding: 12px 16px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--text-secondary);
            border-bottom: 1px solid var(--border-color);
            white-space: nowrap;
        }

        .data-table tbody tr {
            transition: background 0.15s;
        }

        .data-table tbody tr:hover td {
            background: rgba(255,255,255,0.03);
        }

        .data-table tbody td {
            padding: 14px 16px;
            font-size: 0.855rem;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            vertical-align: middle;
            color: var(--text-primary);
        }

        .data-table tbody tr:last-child td { border-bottom: none; }

        /* ─── Badges ─────────────────────────────────────── */
        .badge-active {
            background: rgba(34,211,168,0.15);
            color: var(--success-color);
            border: 1px solid rgba(34,211,168,0.3);
            padding: 3px 10px; border-radius: 20px;
            font-size: 0.72rem; font-weight: 600;
        }

        .badge-inactive {
            background: rgba(248,113,113,0.1);
            color: var(--danger-color);
            border: 1px solid rgba(248,113,113,0.2);
            padding: 3px 10px; border-radius: 20px;
            font-size: 0.72rem; font-weight: 600;
        }

        .badge-category {
            background: rgba(108,99,255,0.12);
            color: var(--accent-2);
            border: 1px solid rgba(108,99,255,0.2);
            padding: 3px 10px; border-radius: 20px;
            font-size: 0.72rem; font-weight: 500;
        }

        /* ─── Search / Form ─────────────────────────────── */
        .search-box {
            position: relative;
        }

        .search-box .bi-search {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.9rem;
            pointer-events: none;
        }

        .search-input, .form-control-custom {
            background: var(--bg-card) !important;
            border: 1px solid var(--border-color) !important;
            color: var(--text-primary) !important;
            border-radius: 10px !important;
            font-family: 'Inter', sans-serif !important;
            font-size: 0.87rem !important;
            padding: 9px 14px !important;
        }

        .search-input { padding-left: 40px !important; }

        .search-input::placeholder, .form-control-custom::placeholder {
            color: var(--text-muted) !important;
        }

        .search-input:focus, .form-control-custom:focus {
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(108,99,255,0.2) !important;
            border-color: var(--accent-1) !important;
        }

        /* ─── Form Labels ────────────────────────────────── */
        .form-label-custom {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-secondary);
            letter-spacing: 0.3px;
            margin-bottom: 6px;
            display: block;
        }

        .form-label-custom .required { color: var(--danger-color); margin-left: 3px; }

        /* ─── Alerts / Flash ────────────────────────────── */
        .flash-success {
            background: rgba(34,211,168,0.1);
            border: 1px solid rgba(34,211,168,0.25);
            color: var(--success-color);
            padding: 12px 18px; border-radius: 10px;
            font-size: 0.87rem; font-weight: 500;
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 24px;
            animation: slideIn 0.3s ease;
        }

        .flash-error {
            background: rgba(248,113,113,0.1);
            border: 1px solid rgba(248,113,113,0.25);
            color: var(--danger-color);
            padding: 12px 18px; border-radius: 10px;
            font-size: 0.87rem;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── Action Buttons in Table ─────────────────── */
        .action-btn {
            width: 32px; height: 32px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: var(--text-secondary);
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .action-btn:hover { transform: translateY(-1px); }
        .action-btn.view:hover   { background: rgba(108,99,255,0.15); color: var(--accent-2); border-color: rgba(108,99,255,0.3); }
        .action-btn.edit:hover   { background: rgba(251,191,36,0.15); color: var(--warning-color); border-color: rgba(251,191,36,0.3); }
        .action-btn.delete:hover { background: rgba(248,113,113,0.15); color: var(--danger-color); border-color: rgba(248,113,113,0.3); }

        /* ─── Pagination ─────────────────────────────────── */
        .pagination { gap: 4px; }

        .pagination .page-link {
            background: var(--bg-card) !important;
            border-color: var(--border-color) !important;
            color: var(--text-secondary) !important;
            border-radius: 8px !important;
            font-size: 0.82rem;
            padding: 6px 12px;
            transition: all 0.2s;
        }

        .pagination .page-link:hover {
            background: var(--bg-card-hover) !important;
            color: var(--text-primary) !important;
        }

        .pagination .page-item.active .page-link {
            background: var(--accent-grad) !important;
            border-color: transparent !important;
            color: #fff !important;
        }

        /* ─── Product Image Preview ─────────────────────── */
        .product-img {
            width: 44px; height: 44px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid var(--border-color);
        }

        .product-img-placeholder {
            width: 44px; height: 44px;
            border-radius: 10px;
            background: rgba(108,99,255,0.1);
            border: 1px solid rgba(108,99,255,0.2);
            display: flex; align-items: center; justify-content: center;
            color: var(--accent-1);
            font-size: 1.2rem;
        }

        /* ─── Delete Modal ───────────────────────────────── */
        .modal-custom .modal-content {
            background: #1a1d2e;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            color: var(--text-primary);
        }

        .modal-custom .modal-header {
            border-bottom: 1px solid var(--border-color);
            padding: 20px 24px;
        }

        .modal-custom .modal-body { padding: 24px; }
        .modal-custom .modal-footer {
            border-top: 1px solid var(--border-color);
            padding: 16px 24px;
        }

        .modal-custom .btn-close {
            filter: invert(1) opacity(0.5);
        }

        /* ─── Detail View ────────────────────────────────── */
        .detail-row {
            display: flex;
            padding: 14px 0;
            border-bottom: 1px solid rgba(255,255,255,0.04);
        }

        .detail-row:last-child { border-bottom: none; }

        .detail-label {
            width: 160px;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            flex-shrink: 0;
        }

        .detail-value {
            font-size: 0.9rem;
            color: var(--text-primary);
            flex: 1;
        }

        /* ─── Responsive ─────────────────────────────────── */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
            .page-body { padding: 20px 16px; }
            .topbar { padding: 16px; }
        }

        /* ─── Form Select ────────────────────────────────── */
        select.form-control-custom option {
            background: #1a1d2e;
            color: var(--text-primary);
        }

        /* ─── Toggle Switch ──────────────────────────────── */
        .toggle-wrapper {
            display: flex; align-items: center; gap: 12px;
        }

        .form-check-input:checked {
            background-color: var(--accent-1) !important;
            border-color: var(--accent-1) !important;
        }

        /* ─── Empty State ─────────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state .empty-icon {
            font-size: 3.5rem;
            color: var(--text-muted);
            margin-bottom: 16px;
        }

        .empty-state h5 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-secondary);
        }

        .empty-state p {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-top: 6px;
        }

        /* ─── SKU code style ─────────────────────────────── */
        .sku-text {
            font-family: 'Courier New', monospace;
            font-size: 0.78rem;
            color: var(--text-secondary);
        }

        /* ─── Price ──────────────────────────────────────── */
        .price-text {
            font-weight: 700;
            color: var(--success-color);
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">📦</div>
            <h1>InvenTrack</h1>
            <p>Product Inventory System</p>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">Main Menu</div>
            <a href="{{ route('products.index') }}"
               class="nav-item {{ request()->routeIs('products.index') ? 'active' : '' }}">
                <i class="bi bi-grid-3x3-gap"></i>
                <span>All Products</span>
            </a>
            <a href="{{ route('products.create') }}"
               class="nav-item {{ request()->routeIs('products.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle"></i>
                <span>Add Product</span>
            </a>

            <div class="nav-label mt-4">Data Types Used</div>
            <div class="nav-item" style="cursor:default; font-size:0.75rem; flex-direction:column; align-items:flex-start; gap:4px; padding: 8px 12px;">
                <span style="color:var(--text-muted)"><i class="bi bi-hash"></i> INT — stock, id</span>
                <span style="color:var(--text-muted)"><i class="bi bi-fonts"></i> VARCHAR — name, sku</span>
                <span style="color:var(--text-muted)"><i class="bi bi-list-ul"></i> ENUM — category</span>
                <span style="color:var(--text-muted)"><i class="bi bi-currency-dollar"></i> DECIMAL — price</span>
                <span style="color:var(--text-muted)"><i class="bi bi-toggle-on"></i> BOOLEAN — is_active</span>
                <span style="color:var(--text-muted)"><i class="bi bi-calendar"></i> DATE — expiry</span>
                <span style="color:var(--text-muted)"><i class="bi bi-clock"></i> DATETIME — timestamps</span>
                <span style="color:var(--text-muted)"><i class="bi bi-image"></i> TEXT — description</span>
            </div>
        </nav>

        <div class="sidebar-footer">
            <small>Laravel {{ app()->version() }} · MySQL</small>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-title">
                <h2>@yield('page-title', 'Dashboard')</h2>
                <p>@yield('page-subtitle', 'Manage your product inventory')</p>
            </div>
            <div class="topbar-actions">
                @yield('topbar-actions')
            </div>
        </header>

        <!-- Page Body -->
        <main class="page-body">
            @if(session('success'))
                <div class="flash-success">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade modal-custom" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <div style="width:36px;height:36px;background:rgba(248,113,113,0.15);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--danger-color);">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <h5 class="modal-title" id="deleteModalLabel" style="font-weight:700;">Confirm Delete</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p style="color:var(--text-secondary); font-size:0.9rem;">
                        Are you sure you want to delete
                        <strong id="deleteProductName" style="color:var(--text-primary);"></strong>?
                        This action <strong style="color:var(--danger-color);">cannot be undone</strong>.
                    </p>
                </div>
                <div class="modal-footer" style="gap:10px;">
                    <button type="button" class="btn-outline-custom" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i> Cancel
                    </button>
                    <form id="deleteForm" method="POST" style="margin:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger-custom" style="padding: 9px 18px;">
                            <i class="bi bi-trash3-fill"></i> Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Delete modal handler
        document.addEventListener('DOMContentLoaded', function () {
            const deleteModal = document.getElementById('deleteModal');
            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function (e) {
                    const btn = e.relatedTarget;
                    const productId   = btn.dataset.productId;
                    const productName = btn.dataset.productName;
                    document.getElementById('deleteProductName').textContent = productName;
                    document.getElementById('deleteForm').action = '/products/' + productId;
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
