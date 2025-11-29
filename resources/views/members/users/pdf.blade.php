@extends('layouts.report')

@section('title', "Ficha Socio - {$record->name}")

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
                <div>Ingreso: {{ $record->join_date?->format('d/m/Y') }}</div>
                @if ($record->membership_status->value == 'activo')
                    <div class="status-badge status-success">{{ $record->membership_status->getLabel() }}</div>
                @else
                    <div class="status-badge status-danger">{{ $record->membership_status->getLabel() }}</div>
                @endif
            </td>
        </tr>
    </table>
@endsection

@section('content')

    @if ($record->photo_path)
        <div class="photo-container">
            <img src="{{ storage_path('app/public/' . $record->photo_path) }}" class="photo" alt="Foto">
        </div>
    @else
        <div class="photo-container">
            Sin foto
        </div>
    @endif

    <h1>{{ Str::upper($record->name) }}</h1>

    <div class="card">
        <div class="card-title">Datos Personales</div>

        <table class="info-grid">
            <tr>
                <th width="25%">Nombre completo</th>
                <td>{{ $record->name }}</td>
            </tr>
            <tr>
                <th>RUN</th>
                <td>{{ $record->run ?? 'No especificado' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $record->email }}</td>
            </tr>
            <tr>
                <th>Teléfono</th>
                <td>{{ $record->phone ?? 'No especificado' }}</td>
            </tr>
            <tr>
                <th>Género</th>
                <td>{{ $record->gender?->getLabel() ?? 'No especificado' }}</td>
            </tr>
            <tr>
                <th>Fecha de nacimiento</th>
                <td>{{ $record->birth_date?->format('d/m/Y') ?? 'No especificada' }} ({{ $record->age }} años)</td>
            </tr>
        </table>

        <table class="info-grid">
            <tr>
                <th width="25%">Dirección</th>
                <td>{{ $record->address ?? 'No especificada' }}</td>
            </tr>
            <tr>
                <th>Comuna</th>
                <td>{{ $record->commune?->name ?? 'No especificada' }}</td>
            </tr>
            <tr>
                <th>Tipo de usuario</th>
                <td>{{ $record->recordType?->name ?? 'No especificado' }}</td>
            </tr>
            <tr>
                <th>Posición de fila</th>
                <td>{{ $record->row_position?->getLabel() ?? 'No especificada' }}</td>
            </tr>
            <tr>
                <th>Antecedentes de salud</th>
                <td>{{ $record->health_background ?? 'Ninguno' }}</td>
            </tr>
        </table>
    </div>

    <div class="card">

        <table width="100%">
            <tr style="vertical-align: top;">
                <td width="50%">
                    <div class="card-title">Información de Membresía</div>
                    <table class="info-grid">
                        <tr>
                            <th width="40%">Fecha de ingreso</th>
                            <td>{{ $record->join_date?->format('d/m/Y') ?? 'No especificada' }}</td>
                        </tr>
                        {{-- <tr>
                            <th>Inscripción</th>
                            <td>{{ $record->inscription_paid ? 'Pagada' : 'Impaga' }}</td>
                        </tr> --}}
                        <tr>
                            <th>Cargo</th>
                            <td>{{ $record->position ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Estado</th>
                            <td>{{ ucfirst($record->membership_status?->getLabel()) ?? 'No especificado' }}</td>
                        </tr>
                    </table>
                </td>

                <td>
                    <div class="card-title">Sacramentos</div>
                    <table class="info-grid">
                        <tr>
                            <th width="40%">Bautismo</th>
                            <td>{{ $record->baptism ? 'Sí' : 'No' }}</td>
                        </tr>
                        <tr>
                            <th>Iniciación</th>
                            <td>{{ $record->initiation ? 'Sí' : 'No' }}</td>
                        </tr>
                        <tr>
                            <th>Confirmación</th>
                            <td>{{ $record->confirmation ? 'Sí' : 'No' }}</td>
                        </tr>
                    </table>
                </td>

            </tr>
        </table>

    </div>

    @if ($record->activeItemAssignments->count() > 0)
        <div class="card">
            <div class="card-title">Elementos Asignados Actualmente</div>
            <table class="info-grid">
                <thead>
                    <tr>
                        <th>Elemento</th>
                        <th>Fecha de asignación</th>
                        <th>Asignado por</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($record->activeItemAssignments as $assignment)
                        <tr>
                            <td>{{ $assignment->item?->name ?? 'Elemento no especificado' }}</td>
                            <td>{{ $assignment->assigned_at?->format('d/m/Y') ?? 'No especificada' }}</td>
                            <td>{{ $assignment->assignedBy?->name ?? 'No especificado' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if (!empty($record->social_networks) && count($record->social_networks) > 0)
        <div class="card">
            <div class="card-title">Redes sociales</div>
            <div style="margin-top: 12px;">
                @foreach ($record->social_networks as $social_network)
                    <div class="notes">
                        {{ $social_network['name'] }}: {{ $social_network['url'] }}
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if (!empty($record->annotations) && count($record->annotations) > 0)
        <div class="card">
            <div class="card-title">Anotaciones</div>
            <div style="margin-top: 12px;">
                @foreach ($record->annotations as $annotation)
                    <div class="notes">
                        {{ $annotation['fecha'] }}: {{ $annotation['detalle'] }}
                    </div>
                @endforeach
            </div>
        </div>
    @endif


@endsection

@section('footer')
    Ficha generada el {{ now()->format('d/m/Y \a \l\a\s H:i') }}
@endsection
