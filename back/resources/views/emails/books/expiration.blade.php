@extends('emails.layout')

@section('title')
Il libro {{ $data->title }} è in scadenza
@endsection

@section('content')
<tr>
    <td style="padding:30px;background-color:#ffffff;">
        <p style="margin:0 0 16px 0;">Ciao {{ $data->name }},</p>
        <p style="margin:0 0 16px 0;">
            Ti ricordiamo che la data di scadenza per la riconsegna del libro {{$data->title}} è fissata per il {{ $data->due_date }}.<br>
            Ricordati di riconsegnare il libro in tempo per evitare di incorrere in sanzioni
        </p>
        <p>Cordiali saluti
            <br>Il team di {{ config('app.name') }}
        </p>
    </td>
</tr>

@endsection
