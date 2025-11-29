@extends('layouts.report')

@section('title', "Comprobante de pago # - {$record->id}")

@section('header')
    <table class="header-grid">
        <tr>
            <td class="left">
                @if (!empty(db_config('system.company_logo')))
                    <img src="{{ storage_path('app/public/' . db_config('system.company_logo')) }}"
                        style="max-height:100px; width:auto;">
                @else
                    <div class="logo-fallback">@db_config('system.company_name')</div>
                @endif
                <div>
                    <div class="company-info">@db_config('system.company_name')</div>
                    @if (!empty(db_config('system.company_rut')))
                        <div class="company-info muted">RUT: @db_config('system.company_rut')</div>
                    @endif
                </div>
            </td>
            <td class="right">
                <h2>N° {{ str_pad($record->id, 4, '0', STR_PAD_LEFT) }}</h2>
                <div>{{ $record->date->format('d/m/Y') }}</div>
                <div class="status-badge status-success">PAGADO</div>
            </td>
        </tr>
    </table>
@endsection


@section('content')
    <h1>COMPROBANTE DE PAGO</h1>
    <div class="card">
        <div class="card-title">Resumen</div>
        <table class="info-grid">
            <tr>
                <th width="25%">Pagado por</th>
                <td>{{ $record->user?->name ?? '-' }}</td>
            </tr>
            @if ($record->mechanism !== null)
                <tr>
                    <th>Método</th>
                    <td>{{ $record->mechanism->getLabel() }}</td>
                </tr>
            @endif

            @if (!empty($record->membershipFee))
                <tr>
                    <th class="muted">Membresía</th>
                    <td>Cuota #{{ $record->membershipFee->period }} del {{ $record->membershipFee->year }}</td>
                </tr>
                @if ($record->membershipFee->pending_amount > 0)
                    <tr>
                        <th class="muted">Pago pendiente</th>
                        <td>{{ format_clp($record->membershipFee->pending_amount) }}
                            ({{ $record->membershipFee->status->getLabel() }})</td>
                    </tr>
                @endif
            @endif
        </table>

        <div class="divider"></div>

        <table class="info-grid">
            <thead>
                <tr>
                    <th class="text-left">Descripción</th>
                    <th class="text-right">Monto</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $record->concept ?? '-' }}</td>
                    <td class="text-right"><span class="amount">{{ format_clp($record->amount) }}</span></td>
                </tr>
            </tbody>
        </table>

        @if (trim($record->notes ?? '') !== '')
            <br>
            <div class="card-title">Notas</div>
            <div class="notes">{{ $record->notes }}</div>
        @endif

    </div>
    <div class="notice">
        Este comprobante acredita la recepción del pago indicado. Conserve este documento para su respaldo.
    </div>

    <br>
    <div class="signature-row">
        <div class="signature-column">
        </div>
        <div class="signature-column">
        </div>
        <div class="signature-column"
            style="background-image: url('{{ $record->receiver?->signature }}'); background-repeat: no-repeat; background-position: right top; background-size: contain;">
            <div class=""><b>Recibido por:</b></div>
            <div class="">{{ $record->receiver?->name ?? '-' }}</div>
            <div class="position">{{ $record->receiver?->position ?? 'Sin cargo registrado' }}</div>
            <div class="">@db_config('system.company_name')</div>
        </div>
    </div>

@endsection
