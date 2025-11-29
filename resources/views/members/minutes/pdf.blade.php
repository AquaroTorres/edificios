@extends('layouts.report')

@section('title', "Acta de Reunión - {$record->title}")

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
                @if ($record->is_public)
                    <div class="status-badge status-success">PÚBLICA</div>
                @else
                    <div class="status-badge status-danger">PRIVADA</div>
                @endif
            </td>
        </tr>
    </table>
@endsection

@section('content')
    <h1>ACTA DE REUNIÓN</h1>

    <div class="card">
        <div class="card-title">Información General</div>
        <table class="info-grid">
            <tr>
                <th width="25%">Título</th>
                <td>{{ $record->title }}</td>
            </tr>
            <tr>
                <th>Creado por</th>
                <td>{{ $record->creator->name ?? 'No especificado' }}</td>
            </tr>
            <tr>
                <th>Fecha de creación</th>
                <td>{{ $record->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @if ($record->attendees->count() > 0)
                <tr>
                    <th>Total asistentes</th>
                    <td>{{ $record->attendees->where('pivot.attended', true)->count() }} /
                        {{ $record->attendees->count() }}</td>
                </tr>
            @endif
        </table>
    </div>

    @if ($record->attendees->count() > 0)
        <div class="card">
            <div class="card-title">Lista de Asistencia</div>
            <table class="info-grid">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>RUN</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($record->attendees->where('pivot.attended', true)->sortBy('name') as $attendee)
                        <tr>
                            <td>{{ $attendee->name }}</td>
                            <td>{{ $attendee->run ?? '-' }}</td>
                            <td>
                                @if ($attendee->pivot->attended)
                                    <span class="success">Presente</span>
                                @else
                                    <span class="danger">No asistió</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="card">
        <div class="card-title">Contenido del Acta</div>
        <div class="body-content">
            {!! $record->body !!}
        </div>
    </div>

@endsection

@section('footer')
@endsection
