<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="description" content="Product Inventory Management — built with Laravel and MySQL.">
    <title>@yield('title', 'Products') — InvenTrack</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /* ─── iOS System Colors ──────────────────────────── */
        :root {
            /* Semantic */
            --ios-blue:        #007AFF;
            --ios-red:         #FF3B30;
            --ios-green:       #34C759;
            --ios-orange:      #FF9500;
            --ios-yellow:      #FFCC00;
            --ios-gray:        #8E8E93;
            --ios-gray2:       #AEAEB2;
            --ios-gray3:       #C7C7CC;
            --ios-gray4:       #D1D1D6;
            --ios-gray5:       #E5E5EA;
            --ios-gray6:       #F2F2F7;

            /* Backgrounds */
            --ios-bg:          #F2F2F7;
            --ios-bg2:         #FFFFFF;
            --ios-card:        #FFFFFF;
            --ios-separator:   rgba(60,60,67,0.12);

            /* Text */
            --ios-label:       #000000;
            --ios-label2:      rgba(60,60,67,0.60);
            --ios-label3:      rgba(60,60,67,0.30);

            /* Tints */
            --ios-blue-tint:   #D1E8FF;
            --ios-red-tint:    #FFE4E3;
            --ios-green-tint:  #D4F5DC;
            --ios-orange-tint: #FFF0D9;

            --radius-lg:  16px;
            --radius-md:  12px;
            --radius-sm:  8px;
            --shadow:     0 1px 3px rgba(0,0,0,0.08), 0 2px 8px rgba(0,0,0,0.04);
            --navbar-h:   90px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Inter', 'Segoe UI', sans-serif;
            background: var(--ios-bg);
            color: var(--ios-label);
            min-height: 100vh;
        }

        /* ─── Navigation Bar ────────────────────────────── */
        .ios-navbar {
            position: sticky;
            top: 0;
            z-index: 200;
            background: rgba(242,242,247,0.88);
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 0.5px solid var(--ios-separator);
        }

        .ios-navbar-inner {
            display: flex;
            align-items: flex-end;
            padding: 10px 20px 10px;
            gap: 12px;
        }

        .ios-navbar-title-wrap { flex: 1; }

        .ios-navbar-subtitle {
            font-size: 11px;
            font-weight: 600;
            color: var(--ios-blue);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 1px;
        }

        .ios-navbar-title {
            font-size: 26px;
            font-weight: 700;
            color: var(--ios-label);
            letter-spacing: -0.5px;
            line-height: 1.1;
        }

        .ios-navbar-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        /* ─── Page Content ──────────────────────────────── */
        .ios-content {
            padding: 20px 0 40px;
        }

        /* ─── Section Headers ───────────────────────────── */
        .ios-section-header {
            padding: 0 20px 6px;
            font-size: 13px;
            font-weight: 600;
            color: var(--ios-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .ios-section { margin-bottom: 24px; }

        /* ─── Cards ─────────────────────────────────────── */
        .ios-card {
            background: var(--ios-card);
            margin: 0 16px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .ios-card-row {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            gap: 12px;
            border-bottom: 0.5px solid var(--ios-separator);
            text-decoration: none;
            color: var(--ios-label);
            transition: background 0.1s;
        }

        .ios-card-row:last-child { border-bottom: none; }
        .ios-card-row:active     { background: var(--ios-gray6); }

        .row-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .icon-blue   { background: var(--ios-blue-tint);   color: var(--ios-blue); }
        .icon-green  { background: var(--ios-green-tint);  color: var(--ios-green); }
        .icon-orange { background: var(--ios-orange-tint); color: var(--ios-orange); }
        .icon-red    { background: var(--ios-red-tint);    color: var(--ios-red); }

        .row-content { flex: 1; min-width: 0; }

        .row-title {
            font-size: 16px;
            font-weight: 500;
            color: var(--ios-label);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .row-subtitle {
            font-size: 13px;
            color: var(--ios-label2);
            margin-top: 1px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .row-right {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
        }

        /* ─── Compact Stats ──────────────────────────────── */
        .ios-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
            margin: 0 16px 20px;
        }

        .ios-stat-card {
            background: var(--ios-card);
            border-radius: var(--radius-md);
            padding: 10px 12px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .ios-stat-icon {
            width: 28px; height: 28px;
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px;
            margin-bottom: 2px;
        }

        .ios-stat-value {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.5px;
            line-height: 1;
            color: var(--ios-label);
        }

        .ios-stat-label {
            font-size: 11px;
            color: var(--ios-label2);
            font-weight: 500;
        }

        /* ─── Search Bar ─────────────────────────────────── */
        .ios-search-wrap {
            padding: 4px 16px 14px;
        }

        .ios-search {
            display: flex;
            align-items: center;
            gap: 6px;
            background: rgba(118,118,128,0.12);
            border-radius: 10px;
            padding: 6px 10px;
            max-width: 340px;
        }

        .ios-search .bi-search {
            font-size: 13px;
            color: var(--ios-gray);
            flex-shrink: 0;
        }

        .ios-search input {
            flex: 1;
            border: none;
            background: transparent;
            font-size: 15px;
            font-family: inherit;
            color: var(--ios-label);
            outline: none;
        }

        .ios-search input::placeholder { color: var(--ios-gray); }

        /* ─── Buttons ────────────────────────────────────── */
        .ios-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 7px 15px;
            border-radius: 980px;
            font-size: 15px;
            font-weight: 600;
            font-family: inherit;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: opacity 0.15s, transform 0.1s;
        }

        .ios-btn:active { transform: scale(0.97); opacity: 0.85; }

        /* Blue = actionable */
        .ios-btn-blue {
            background: var(--ios-blue);
            color: #fff;
        }
        .ios-btn-blue:hover  { background: #0066DD; color: #fff; }

        /* Blue ghost */
        .ios-btn-blue-ghost {
            background: var(--ios-blue-tint);
            color: var(--ios-blue);
        }
        .ios-btn-blue-ghost:hover { background: #b8d9ff; color: var(--ios-blue); }

        /* Red = destructive */
        .ios-btn-red {
            background: var(--ios-red-tint);
            color: var(--ios-red);
        }
        .ios-btn-red:hover { background: #ffd0ce; }

        /* Green = success/confirm */
        .ios-btn-green {
            background: var(--ios-green);
            color: #fff;
        }
        .ios-btn-green:hover { background: #2aad4a; color:#fff; }

        /* Gray = neutral */
        .ios-btn-gray {
            background: var(--ios-gray5);
            color: var(--ios-label);
        }

        .ios-btn-sm {
            padding: 5px 12px;
            font-size: 13px;
        }

        .ios-btn-full {
            width: 100%;
            justify-content: center;
            padding: 13px;
            border-radius: var(--radius-md);
            font-size: 16px;
        }

        /* ─── Badges ─────────────────────────────────────── */
        .ios-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 980px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-active   { background: var(--ios-green-tint);  color: #1c7a30; }
        .badge-inactive { background: var(--ios-red-tint);    color: #c0302a; }
        .badge-cat      { background: var(--ios-blue-tint);   color: var(--ios-blue); }

        /* ─── Row action icons ───────────────────────────── */
        .ios-row-actions { display: flex; gap: 5px; }

        .ios-icon-btn {
            width: 30px; height: 30px;
            border-radius: 7px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.15s;
        }

        .ios-icon-btn:active { opacity: 0.7; }
        .ios-icon-btn.view   { background: var(--ios-blue-tint);   color: var(--ios-blue); }
        .ios-icon-btn.edit   { background: var(--ios-orange-tint); color: var(--ios-orange); }
        .ios-icon-btn.delete { background: var(--ios-red-tint);    color: var(--ios-red); }

        /* ─── Flash Alerts ───────────────────────────────── */
        .ios-alert {
            margin: 0 16px 16px;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            font-size: 15px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Green = success */
        .ios-alert-success { background: var(--ios-green-tint); color: #1c7a30; }
        /* Red = error */
        .ios-alert-error   { background: var(--ios-red-tint);   color: #c0302a; }

        /* ─── iOS Form Inputs ────────────────────────────── */
        .ios-form-wrap { padding: 0 16px; }

        .ios-form-group { margin-bottom: 14px; }

        .ios-form-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--ios-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            display: block;
        }

        .ios-form-label .req { color: var(--ios-red); }

        .ios-input {
            width: 100%;
            background: var(--ios-card);
            border: none;
            border-radius: var(--radius-md);
            padding: 11px 14px;
            font-size: 15px;
            font-family: inherit;
            color: var(--ios-label);
            box-shadow: var(--shadow);
            outline: none;
            transition: box-shadow 0.2s;
            -webkit-appearance: none;
        }

        .ios-input:focus {
            box-shadow: 0 0 0 3px rgba(0,122,255,0.2), var(--shadow);
        }

        .ios-input::placeholder { color: var(--ios-gray2); }
        textarea.ios-input { resize: vertical; min-height: 80px; }

        .ios-input-error {
            font-size: 12px;
            color: var(--ios-red);
            margin-top: 4px;
            padding: 0 4px;
        }

        /* 2-column form grid */
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .form-col-full { grid-column: 1 / -1; }

        /* ─── Toggle Switch ──────────────────────────────── */
        .ios-toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--ios-card);
            border-radius: var(--radius-md);
            padding: 12px 14px;
            box-shadow: var(--shadow);
        }

        .ios-toggle-label { font-size: 15px; color: var(--ios-label); }

        input[type="checkbox"].ios-switch {
            appearance: none;
            -webkit-appearance: none;
            width: 48px; height: 28px;
            border-radius: 980px;
            background: var(--ios-gray4);
            position: relative;
            cursor: pointer;
            transition: background 0.25s;
            flex-shrink: 0;
        }

        input[type="checkbox"].ios-switch::after {
            content: '';
            position: absolute;
            width: 24px; height: 24px;
            border-radius: 50%;
            background: #fff;
            top: 2px; left: 2px;
            transition: transform 0.25s;
            box-shadow: 0 1px 4px rgba(0,0,0,0.25);
        }

        /* Green = active/confirmed */
        input[type="checkbox"].ios-switch:checked { background: var(--ios-green); }
        input[type="checkbox"].ios-switch:checked::after { transform: translateX(20px); }

        /* ─── Detail View ────────────────────────────────── */
        .ios-detail-card {
            background: var(--ios-card);
            margin: 0 16px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .ios-detail-row {
            display: flex;
            align-items: flex-start;
            padding: 11px 16px;
            gap: 12px;
            border-bottom: 0.5px solid var(--ios-separator);
        }

        .ios-detail-row:last-child { border-bottom: none; }

        .ios-detail-label {
            font-size: 14px;
            color: var(--ios-label2);
            width: 120px;
            flex-shrink: 0;
        }

        .ios-detail-value {
            font-size: 14px;
            font-weight: 500;
            color: var(--ios-label);
            flex: 1;
        }

        .ios-detail-type {
            font-size: 11px;
            color: var(--ios-blue);
            background: var(--ios-blue-tint);
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 600;
            flex-shrink: 0;
        }

        /* ─── Empty State ────────────────────────────────── */
        .ios-empty {
            text-align: center;
            padding: 48px 24px;
        }

        .ios-empty .empty-icon {
            font-size: 48px;
            color: var(--ios-gray3);
            margin-bottom: 12px;
            display: block;
        }

        .ios-empty h3 {
            font-size: 18px;
            font-weight: 600;
            color: var(--ios-label);
            margin-bottom: 6px;
        }

        .ios-empty p {
            font-size: 14px;
            color: var(--ios-label2);
            margin-bottom: 20px;
        }

        /* ─── Action Sheet (Delete) ──────────────────────── */
        .ios-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
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
            padding: 8px 16px 28px;
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
            border-bottom: 0.5px solid var(--ios-separator);
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
            padding: 15px;
            background: transparent;
            border: none;
            border-top: 0.5px solid var(--ios-separator);
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

        /* Red = destructive */
        .ios-action-btn.destructive { color: var(--ios-red); font-weight: 500; }
        .ios-action-btn:active      { background: var(--ios-gray5); }

        .ios-action-cancel {
            background: rgba(248,248,248,0.97);
            backdrop-filter: blur(20px);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        /* ─── Pagination ─────────────────────────────────── */
        .ios-pagination {
            display: flex;
            justify-content: center;
            gap: 6px;
            padding: 16px;
        }

        .ios-pagination a, .ios-pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            height: 34px;
            border-radius: 980px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            padding: 0 10px;
            transition: all 0.15s;
        }

        /* Blue = actionable page links */
        .page-link-item { color: var(--ios-blue); background: var(--ios-blue-tint); }
        .page-current   { background: var(--ios-blue); color: #fff; }
        .page-disabled  { color: var(--ios-gray3); }

        /* ─── Back Button ────────────────────────────────── */
        /* Blue = actionable navigation */
        .ios-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            color: var(--ios-blue);
            font-size: 16px;
            font-weight: 400;
            text-decoration: none;
            padding: 2px 0;
        }

        .ios-back-btn:hover { opacity: 0.7; color: var(--ios-blue); }
        .ios-back-btn .bi   { font-size: 19px; }

        /* Price & SKU */
        .price-val { color: var(--ios-blue); font-weight: 700; }
        .sku-val   { font-family: 'Courier New', monospace; font-size: 12px; color: var(--ios-label2); }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Navigation Bar -->
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

    <!-- Page Content -->
    <main class="ios-content">
        @if(session('success'))
            <div class="ios-alert ios-alert-success">
                <i class="bi bi-check-circle-fill" style="font-size:16px;"></i>
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Delete Action Sheet -->
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
