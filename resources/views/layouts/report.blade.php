<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} - @yield('title')</title>

    <style>
        @page {
            margin: 16mm 18mm 16mm 18mm;
        }

        @media print {

            .page,
            .page-break {
                break-after: page;
            }
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            line-height: 1.5;
        }

        .body-content {
            margin-top: 6px;
            text-align: justify;
        }

        .header {
            display: block;
        }

        .header-grid {
            width: 100%;
        }

        .footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: -5mm;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
        }

        .left {
            width: 60%;
            vertical-align: top;
        }

        .right {
            width: 40%;
            vertical-align: top;
            text-align: right;
        }

        .company-info {
            font-size: 10px;
        }

        h1 {
            font-size: 18px;
            margin: 6px 0 8px;
            color: #111827;
            text-align: center;
        }

        h2 {
            font-size: 15px;
            margin-bottom: 0px;
        }

        h3 {
            font-size: 12px;
            margin: 12px 0 4px;
            color: #374151;
        }

        .muted {
            color: #6b7280;
        }

        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 14px 0;
        }

        .card {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 2px 12px 2px 12px;
            margin-top: 16px;
        }

        .card-title {
            font-size: 13px;
            margin: 0px 0px 8px;
            color: #111827;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 4px;
            font-weight: bold;
        }

        .info-grid {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .info-grid th {
            color: #374151;
            background: #f9fafb;
            padding: 2px 8px 4px 8px;
            border: 1px solid #e5e7eb;
            text-align: left;
        }

        .info-grid td {
            padding: 2px 8px 4px 8px;
            vertical-align: top;
            border: 1px solid #e5e7eb;
        }

        .logo-fallback {
            display: inline-block;
            padding: 8px 12px;
            border: 1px dashed #d1d5db;
            border-radius: 8px;
            color: #6b7280;
            width: 100px;
            height: 100px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .status-badge {
            display: inline-block;
            padding: 0px 8px 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            margin-top: 4px;
        }

        .status-success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        .status-danger {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #ef4444;
        }

        .success {
            color: #059669;
        }

        .danger {
            color: #dc2626;
        }

        .notes {
            padding-bottom: 6px;
            font-style: italic;
            color: #374151;
        }

        .notice {
            font-size: 10px;
            color: #6b7280;
            border: 1px solid #d1d5db;
            background: #f9fafb;
            border-radius: 6px;
            padding: 4px 8px 6px 8px;
            margin-top: 16px;
            text-align: center;
        }

        .amount {
            font-size: 26px;
            color: #111827;
            letter-spacing: 0.3px;
        }

        .signature-row {
            display: table;
            width: 100%;
            margin-top: 40px;
        }

        .signature-column {
            padding: 35px 8px 0px;
            display: table-cell;
            width: 33.33%;
            vertical-align: bottom;
        }

        .position {
            color: #6b7280;
            font-style: italic;
        }

        .photo-container {
            position: absolute;
            top: 74;
            right: 0;
            width: 94px;
            height: 94px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            text-align: center;
        }

        .photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 7px;
        }
    </style>
</head>

<body>
    <div class="header">
        @yield('header')
    </div>

    <div class="footer">
        @yield('footer')
        {{-- Generada el {{ now()->format('d/m/Y \a \l\a\s H:i') }} --}}
        <div class="company-info">
            @if (!empty(db_config('system.company_address')))
                @db_config('system.company_address'),
            @endif
            @if (!empty(db_config('system.company_email')))
                @db_config('system.company_email'),
            @endif
            @if (!empty(db_config('system.company_phone')))
                @db_config('system.company_phone')
            @endif
        </div>
    </div>

    <div class="container">
        @yield('content')
    </div>
</body>

</html>
