@extends('layouts.report')

@section('title', "Certificado - {$record->id}")

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
                <div>{{ $record->issued_date?->format('d/m/Y') }}</div>
            </td>
        </tr>
    </table>
@endsection

@section('content')

    <br>

    <h3>{{ $record->institution }}</h3>
    <h3>Presente</h3>
    <div class="divider"></div>

    <h3>De nuestra consideración:</h3>
    <p style="text-align: justify;">
        Como cada año, en el mes de <b>@db_config('system.saint_month')</b>, en nuestra zona se celebra la Fiesta Religiosa
        donde cada promesante rinde culto a <b>@db_config('system.saint_name')</b>.
        Nuestra comunidad religiosa <b>@db_config('system.company_name')</b>, con más
        de <b>@db_config('system.company_years')</b> años de trayectoria, ha ofrecido
        su danza y canto en honor a <b>@db_config('system.saint_name')</b>.

    </p>

    <p style="text-align: justify;">
        El motivo de la presente es solicitar su autorización para que <b>{{ $record->user->name ?? '' }}</b>,
        cédula de identidad <b>{{ $record->user->run ?? '' }}</b>, promesante de nuestra comunidad religiosa, pueda cumplir
        su promesa hacia
        <b>@db_config('system.saint_name')</b> en su festividad, a desarrollarse en el pueblo de <b>@db_config('system.saint_town')</b>, durante los
        días
        <b>{{ $record->citation_start?->format('d/m/Y') }}</b> hasta <b>{{ $record->citation_end?->format('d/m/Y') }}</b>
        del presente año.
    </p>

    <p style="text-align: justify;">
        Deseamos destacar que <b>{{ $record->user->name ?? '' }}</b> es parte importante de nuestra comunidad.
        Por ello, apelamos a su espíritu de comprensión y apoyo para que pueda participar activamente en los
        actos de culto que nuestra comunidad desarrollará en dicha festividad.


    <p style="text-align: justify;">
        Agradeciendo de antemano su atención y buena disposición, se despide atentamente de usted:</b>
    </p>

    <div class="signature-row">
        <div class="signature-column"
            style="background-image: url('{{ $record->signer1?->signature }}'); background-repeat: no-repeat; background-position: right top; background-size: contain;">
            @if ($record->signer1)
                <div class="">{{ $record->signer1->name }}</div>
                <div class="position">{{ $record->signer1->position ?? 'Sin cargo registrado' }}</div>
                <div class="">@db_config('system.company_name')</div>
                {{-- <div class="">{{ $record->signer3->phone }}</div> --}}
                {{-- <div class="">{{ $record->signer3->email }}</div> --}}
            @endif
        </div>
        <div class="signature-column"
            style="background-image: url('{{ $record->signer2?->signature }}'); background-repeat: no-repeat; background-position: right top; background-size: contain;">
            @if ($record->signer2)
                <div class="">{{ $record->signer2->name }}</div>
                <div class="position">{{ $record->signer2->position ?? 'Sin cargo registrado' }}</div>
                <div class="">@db_config('system.company_name')</div>
                {{-- <div class="">{{ $record->signer2->phone }}</div> --}}
                {{-- <div class="">{{ $record->signer2->email }}</div> --}}
            @endif
        </div>
        <div class="signature-column"
            style="background-image: url('{{ $record->signer3->signature }}'); background-repeat: no-repeat; background-position: right top; background-size: contain;">
            <div class="">{{ $record->signer3->name }}</div>
            <div class="position">{{ $record->signer3->position ?? 'Sin cargo registrado' }}</div>
            <div class="">@db_config('system.company_name')</div>
            {{-- <div class="">{{ $record->signer1->phone }}</div> --}}
            {{-- <div class="">{{ $record->signer1->email }}</div> --}}
        </div>
    </div>
@endsection

@section('footer')
    Fecha de emisión {{ now()->format('d/m/Y \a \l\a\s H:i') }}
@endsection
