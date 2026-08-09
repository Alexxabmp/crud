<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="description" content="Product Inventory Management — built with Laravel and MySQL.">
    <title>@yield('title', 'Products') — InvenTrack</title>

    <!-- Google Fonts: SF Pro-like -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /* ─── iOS Design Tokens ───────────────────────── */
        :root {
            --ios-bg:           #F2F2F7;
            --ios-bg2:          #FFFFFF;
            --ios-bg3:          #F2F2F7;
            --ios-card:         #FFFFFF;
            --ios-separator:    #C6C6C8;
            --ios-separator-s:  rgba(60,60,67,0.12);
            --ios-pink:         #FF2D55;
            --ios-pink-light:   #FFE4EA;
            --ios-pink-grad:    linear-gradient(135deg, #FF2D55 0%, #FF6B8A 100%);
            --ios-blue:         #007AFF;
            --ios-green:        #34C759;
            --ios-orange:       #FF9500;
            --ios-red:          #FF3B30;
            --ios-gray:         #8E8E93;
            --ios-gray2:        #AEAEB2;
            --ios-gray3:        #C7C7CC;
            --ios-gray4:        #D1D1D6;
            --ios-gray5:        #E5E5EA;
            --ios-gray6:        #F2F2F7;
            --ios-label:        #000000;
            --ios-label2:       rgba(60,60,67,0.60);
            --ios-label3:       rgba(60,60,67,0.30);
            --ios-label4:       rgba(60,60,67,0.18);
            --navbar-h:         96px;
            --tabbar-h:         83px;
            --radius-lg:        16px;
            --radius-md:        12px;
            --radius-sm:        8px;
            --shadow-card:      0 1px 3px rgba(0,0,0,0.08), 0 4px 16px rgba(0,0,0,0.04);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            overflow-x: hidden;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Inter', 'Segoe UI', sans-serif;
            background: var(--ios-bg);
            color: var(--ios-label);
            min-height: 100vh;
            padding-bottom: var(--tabbar-h);
        }

        /* ─── Navigation Bar ───────────────────────────── */
        .ios-navbar {
            position: sticky;
            top: 0;
            z-index: 200;
            background: rgba(242,242,247,0.85);
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 0.5px solid var(--ios-separator-s);
            padding: 0 20px;
        }

        .ios-navbar-inner {
            display: flex;
            align-items: flex-end;
            padding: 12px 0 8px;
            gap: 12px;
        }

        .ios-navbar-title-wrap {
            flex: 1;
        }

        .ios-navbar-subtitle {
            font-size: 12px;
            font-weight: 500;
            color: var(--ios-pink);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 2px;
        }

        .ios-navbar-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--ios-label);
            letter-spacing: -0.5px;
            line-height: 1.1;
        }

        .ios-navbar-actions {
            display: flex;
            gap: 8px;
            align-items: center;
            padding-bottom: 4px;
        }

        /* ─── Tab Bar ──────────────────────────────────── */
        .ios-tabbar {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            z-index: 200;
            background: rgba(248,248,248,0.92);
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            border-top: 0.5px solid var(--ios-separator-s);
            display: flex;
            height: var(--tabbar-h);
            padding-bottom: 16px;
        }

        .ios-tab-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            text-decoration: none;
            color: var(--ios-gray);
            transition: all 0.15s;
            padding-top: 8px;
            cursor: pointer;
        }

        .ios-tab-item.active { color: var(--ios-pink); }

        .ios-tab-item .bi {
            font-size: 22px;
            line-height: 1;
            transition: transform 0.15s;
        }

        .ios-tab-item.active .bi { transform: scale(1.08); }

        .ios-tab-item span {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.1px;
        }

        /* ─── Page Scroll Area ─────────────────────────── */
        .ios-content {
            padding: 20px 0;
            min-height: calc(100vh - var(--navbar-h) - var(--tabbar-h));
        }

        /* ─── Section Headers ──────────────────────────── */
        .ios-section-header {
            padding: 0 20px 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--ios-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .ios-section { margin-bottom: 28px; }

        /* ─── iOS Cards (Grouped List style) ───────────── */
        .ios-card {
            background: var(--ios-card);
            margin: 0 16px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }

        .ios-card-row {
            display: flex;
            align-items: center;
            padding: 13px 16px;
            gap: 12px;
            border-bottom: 0.5px solid var(--ios-separator-s);
            text-decoration: none;
            color: var(--ios-label);
            transition: background 0.1s;
            -webkit-tap-highlight-color: transparent;
        }

        .ios-card-row:last-child { border-bottom: none; }
        .ios-card-row:active { background: var(--ios-gray6); }

        .ios-card-row .row-icon {
            width: 36px; height: 36px;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .icon-pink   { background: var(--ios-pink-light); color: var(--ios-pink); }
        .icon-green  { background: #D4F5DC; color: var(--ios-green); }
        .icon-orange { background: #FFECD4; color: var(--ios-orange); }
        .icon-red    { background: #FFE4E4; color: var(--ios-red); }
        .icon-blue   { background: #D9EDFF; color: var(--ios-blue); }

        .ios-card-row .row-content { flex: 1; min-width: 0; }

        .ios-card-row .row-title {
            font-size: 17px;
            font-weight: 500;
            color: var(--ios-label);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ios-card-row .row-subtitle {
            font-size: 13px;
            color: var(--ios-label2);
            margin-top: 1px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ios-card-row .row-right {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
        }

        .ios-card-row .row-value {
            font-size: 17px;
            font-weight: 600;
            color: var(--ios-label2);
        }

        .row-chevron {
            color: var(--ios-gray3);
            font-size: 14px;
        }

        /* ─── Stats Row (4 up) ─────────────────────────── */
        .ios-stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin: 0 16px 28px;
        }

        .ios-stat-card {
            background: var(--ios-card);
            border-radius: var(--radius-lg);
            padding: 16px;
            box-shadow: var(--shadow-card);
        }

        .ios-stat-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .ios-stat-value {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.5px;
            line-height: 1;
            color: var(--ios-label);
        }

        .ios-stat-label {
            font-size: 13px;
            color: var(--ios-label2);
            margin-top: 4px;
        }

        /* ─── iOS Buttons ──────────────────────────────── */
        .ios-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 980px;
            font-size: 15px;
            font-weight: 600;
            font-family: inherit;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.15s;
            -webkit-tap-highlight-color: transparent;
        }

        .ios-btn-primary {
            background: var(--ios-pink);
            color: #fff;
        }

        .ios-btn-primary:hover { background: #E0264A; color: #fff; }
        .ios-btn-primary:active { transform: scale(0.97); }

        .ios-btn-ghost {
            background: var(--ios-pink-light);
            color: var(--ios-pink);
        }

        .ios-btn-ghost:hover { background: #ffd0db; color: var(--ios-pink); }

        .ios-btn-gray {
            background: var(--ios-gray5);
            color: var(--ios-label);
        }

        .ios-btn-danger {
            background: #FFE4E4;
            color: var(--ios-red);
        }

        .ios-btn-danger:hover { background: #ffd0d0; }

        .ios-btn-sm {
            padding: 5px 12px;
            font-size: 13px;
            border-radius: 980px;
        }

        .ios-btn-icon {
            width: 34px; height: 34px;
            padding: 0;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }

        /* ─── Full-width CTA Button ────────────────────── */
        .ios-btn-full {
            width: 100%;
            justify-content: center;
            padding: 14px;
            border-radius: var(--radius-md);
            font-size: 17px;
        }

        /* ─── iOS Form Inputs ──────────────────────────── */
        .ios-form-group { margin-bottom: 20px; }

        .ios-form-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--ios-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            display: block;
            padding: 0 4px;
        }

        .ios-form-label .req { color: var(--ios-red); }

        .ios-input {
            width: 100%;
            background: var(--ios-card);
            border: none;
            border-radius: var(--radius-md);
            padding: 13px 16px;
            font-size: 17px;
            font-family: inherit;
            color: var(--ios-label);
            box-shadow: var(--shadow-card);
            outline: none;
            transition: box-shadow 0.2s;
            -webkit-appearance: none;
        }

        .ios-input:focus {
            box-shadow: 0 0 0 3px rgba(255,45,85,0.2), var(--shadow-card);
        }

        .ios-input::placeholder { color: var(--ios-gray2); }

        textarea.ios-input { resize: vertical; min-height: 100px; }

        .ios-input-error {
            font-size: 13px;
            color: var(--ios-red);
            margin-top: 6px;
            padding: 0 4px;
        }

        /* ─── Segmented Control ────────────────────────── */
        .ios-segment {
            display: flex;
            background: var(--ios-gray5);
            border-radius: 9px;
            padding: 2px;
            gap: 2px;
        }

        .ios-segment-item {
            flex: 1;
            padding: 6px;
            border-radius: 7px;
            text-align: center;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--ios-gray);
        }

        .ios-segment-item.active {
            background: var(--ios-card);
            color: var(--ios-label);
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        }

        /* ─── Search Bar ───────────────────────────────── */
        .ios-search-wrap {
            padding: 8px 16px 16px;
        }

        .ios-search {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(118,118,128,0.12);
            border-radius: 10px;
            padding: 7px 12px;
        }

        .ios-search .bi-search {
            font-size: 15px;
            color: var(--ios-gray);
            flex-shrink: 0;
        }

        .ios-search input {
            flex: 1;
            border: none;
            background: transparent;
            font-size: 17px;
            font-family: inherit;
            color: var(--ios-label);
            outline: none;
        }

        .ios-search input::placeholder { color: var(--ios-gray); }

        /* ─── Badge / Pill ─────────────────────────────── */
        .ios-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 980px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-active   { background: #D4F5DC; color: #1A7A2E; }
        .badge-inactive { background: #FFE4E4; color: #CC2A22; }
        .badge-cat      { background: var(--ios-pink-light); color: var(--ios-pink); }

        /* ─── Empty State ──────────────────────────────── */
        .ios-empty {
            text-align: center;
            padding: 60px 32px;
        }

        .ios-empty .empty-icon {
            font-size: 56px;
            color: var(--ios-gray3);
            margin-bottom: 16px;
            display: block;
        }

        .ios-empty h3 {
            font-size: 20px;
            font-weight: 600;
            color: var(--ios-label);
            margin-bottom: 8px;
        }

        .ios-empty p {
            font-size: 15px;
            color: var(--ios-label2);
            margin-bottom: 24px;
        }

        /* ─── Flash Alert ──────────────────────────────── */
        .ios-alert {
            margin: 0 16px 20px;
            padding: 14px 16px;
            border-radius: var(--radius-md);
            font-size: 15px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ios-alert-success {
            background: #D4F5DC;
            color: #1A7A2E;
        }

        .ios-alert-error {
            background: #FFE4E4;
            color: #CC2A22;
        }

        /* ─── Detail Rows ──────────────────────────────── */
        .ios-detail-card {
            background: var(--ios-card);
            margin: 0 16px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }

        .ios-detail-row {
            display: flex;
            align-items: flex-start;
            padding: 13px 16px;
            gap: 12px;
            border-bottom: 0.5px solid var(--ios-separator-s);
        }

        .ios-detail-row:last-child { border-bottom: none; }

        .ios-detail-label {
            font-size: 15px;
            color: var(--ios-label2);
            width: 130px;
            flex-shrink: 0;
        }

        .ios-detail-value {
            font-size: 15px;
            font-weight: 500;
            color: var(--ios-label);
            flex: 1;
        }

        .ios-detail-type {
            font-size: 11px;
            color: var(--ios-pink);
            background: var(--ios-pink-light);
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 600;
            flex-shrink: 0;
        }

        /* ─── Product Image ────────────────────────────── */
        .product-avatar {
            width: 44px; height: 44px;
            border-radius: 10px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .product-avatar-placeholder {
            width: 44px; height: 44px;
            border-radius: 10px;
            background: var(--ios-pink-light);
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        /* ─── Back Button ──────────────────────────────── */
        .ios-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: var(--ios-pink);
            font-size: 17px;
            font-weight: 400;
            text-decoration: none;
            padding: 4px 0;
            transition: opacity 0.15s;
        }

        .ios-back-btn:hover { opacity: 0.7; color: var(--ios-pink); }

        .ios-back-btn .bi { font-size: 20px; }

        /* ─── Action Sheet style Delete Modal ──────────── */
        .ios-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 999;
            display: none;
            align-items: flex-end;
            justify-content: center;
            padding: 0;
        }

        .ios-modal-backdrop.show { display: flex; }

        .ios-action-sheet {
            width: 100%;
            max-width: 480px;
            background: transparent;
            padding: 8px 16px calc(var(--tabbar-h) + 8px);
        }

        .ios-action-sheet-card {
            background: rgba(248,248,248,0.97);
            backdrop-filter: blur(20px);
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin-bottom: 8px;
        }

        .ios-action-sheet-title {
            text-align: center;
            padding: 14px 16px 10px;
            border-bottom: 0.5px solid var(--ios-separator-s);
        }

        .ios-action-sheet-title h4 {
            font-size: 13px;
            font-weight: 600;
            color: var(--ios-label2);
        }

        .ios-action-sheet-title p {
            font-size: 13px;
            color: var(--ios-label2);
            margin-top: 4px;
        }

        .ios-action-btn {
            width: 100%;
            padding: 16px;
            background: transparent;
            border: none;
            border-top: 0.5px solid var(--ios-separator-s);
            font-size: 17px;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.1s;
            color: var(--ios-label);
        }

        .ios-action-btn:first-of-type { border-top: none; }
        .ios-action-btn:active { background: var(--ios-gray5); }
        .ios-action-btn.destructive { color: var(--ios-red); font-weight: 500; }

        .ios-action-cancel {
            background: rgba(248,248,248,0.97);
            backdrop-filter: blur(20px);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        /* ─── Pagination ───────────────────────────────── */
        .ios-pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            padding: 20px 16px;
        }

        .ios-pagination a, .ios-pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            border-radius: 980px;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            padding: 0 10px;
            transition: all 0.15s;
        }

        .ios-pagination .page-link-item {
            color: var(--ios-pink);
            background: var(--ios-pink-light);
        }

        .ios-pagination .page-current {
            background: var(--ios-pink);
            color: #fff;
        }

        .ios-pagination .page-disabled {
            color: var(--ios-gray3);
        }

        /* ─── Toggle / Switch ──────────────────────────── */
        .ios-toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--ios-card);
            border-radius: var(--radius-md);
            padding: 13px 16px;
            box-shadow: var(--shadow-card);
        }

        .ios-toggle-label {
            font-size: 17px;
            color: var(--ios-label);
        }

        input[type="checkbox"].ios-switch {
            appearance: none;
            -webkit-appearance: none;
            width: 51px;
            height: 31px;
            border-radius: 980px;
            background: var(--ios-gray4);
            position: relative;
            cursor: pointer;
            transition: background 0.25s;
        }

        input[type="checkbox"].ios-switch::after {
            content: '';
            position: absolute;
            width: 27px; height: 27px;
            border-radius: 50%;
            background: #fff;
            top: 2px; left: 2px;
            transition: transform 0.25s;
            box-shadow: 0 1px 4px rgba(0,0,0,0.25);
        }

        input[type="checkbox"].ios-switch:checked {
            background: var(--ios-pink);
        }

        input[type="checkbox"].ios-switch:checked::after {
            transform: translateX(20px);
        }

        /* ─── Price & SKU ──────────────────────────────── */
        .price-val { color: var(--ios-pink); font-weight: 700; }
        .sku-val   { font-family: 'Courier New', monospace; font-size: 13px; color: var(--ios-label2); }

        /* ─── Inline action buttons ────────────────────── */
        .ios-row-actions {
            display: flex;
            gap: 6px;
        }

        .ios-icon-btn {
            width: 32px; height: 32px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s;
        }

        .ios-icon-btn.view   { background: var(--ios-pink-light); color: var(--ios-pink); }
        .ios-icon-btn.edit   { background: #FFECD4; color: var(--ios-orange); }
        .ios-icon-btn.delete { background: #FFE4E4; color: var(--ios-red); }

        /* ─── Form page wrapper ────────────────────────── */
        .ios-form-wrap {
            padding: 0 16px;
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- ─── Navigation Bar ──────────────────────────────── -->
    <header class="ios-navbar">
        <div class="ios-navbar-inner">
            <div class="ios-navbar-title-wrap">
                @hasSection('back-btn')
                    @yield('back-btn')
                @else
                    <div class="ios-navbar-subtitle">InvenTrack</div>
                @endif
                <h1 class="ios-navbar-title">@yield('page-title', 'Products')</h1>
            </div>
            <div class="ios-navbar-actions">
                @yield('topbar-actions')
            </div>
        </div>
    </header>

    <!-- ─── Page Content ────────────────────────────────── -->
    <main class="ios-content">

        @if(session('success'))
            <div class="ios-alert ios-alert-success">
                <i class="bi bi-checkmark-circle-fill" style="font-size:18px;"></i>
                {{ session('success') }}
            </div>
        @endif

        @yield('content')

    </main>

    <!-- ─── Tab Bar ─────────────────────────────────────── -->
    <nav class="ios-tabbar">
        <a href="{{ route('products.index') }}"
           class="ios-tab-item {{ request()->routeIs('products.index') ? 'active' : '' }}">
            <i class="bi bi-square-grid-2x2{{ request()->routeIs('products.index') ? '-fill' : '' }}"></i>
            <span>Products</span>
        </a>
        <a href="{{ route('products.create') }}"
           class="ios-tab-item {{ request()->routeIs('products.create') ? 'active' : '' }}">
            <i class="bi bi-plus-circle{{ request()->routeIs('products.create') ? '-fill' : '' }}"></i>
            <span>Add New</span>
        </a>
        <a href="#" class="ios-tab-item" style="pointer-events:none; opacity:0.4;">
            <i class="bi bi-chart-bar"></i>
            <span>Reports</span>
        </a>
        <a href="#" class="ios-tab-item" style="pointer-events:none; opacity:0.4;">
            <i class="bi bi-gear"></i>
            <span>Settings</span>
        </a>
    </nav>

    <!-- ─── Delete Action Sheet ──────────────────────────── -->
    <div class="ios-modal-backdrop" id="deleteModal">
        <div class="ios-action-sheet">
            <div class="ios-action-sheet-card">
                <div class="ios-action-sheet-title">
                    <h4>Delete Product</h4>
                    <p>Are you sure you want to delete <strong id="deleteProductName"></strong>? This cannot be undone.</p>
                </div>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="ios-action-btn destructive">
                        <i class="bi bi-trash3"></i> Delete
                    </button>
                </form>
            </div>
            <div class="ios-action-cancel">
                <button class="ios-action-btn" style="font-weight:600;" onclick="closeDeleteModal()">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(productId, productName) {
            document.getElementById('deleteProductName').textContent = productName;
            document.getElementById('deleteForm').action = '/products/' + productId;
            document.getElementById('deleteModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('show');
            document.body.style.overflow = '';
        }

        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });
    </script>

    @stack('scripts')
</body>
</html>
