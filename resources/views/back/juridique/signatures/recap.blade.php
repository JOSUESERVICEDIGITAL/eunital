@extends('back.juridique.layouts.app')
@section('title', 'Récapitulatif signature')
@section('page_title', 'Signature confirmée')
@section('page_subtitle', 'Merci d\'avoir signé le document')

@section('juridique-content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-check-circle text-success fa-5x mb-3"></i>
                <h2>Signature confirmée</h2>
                <p>Vous avez signé le document <strong>{{ $signature->document->titre }}</strong></p>
                <p>Date de signature : {{ $signature->date_signature->format('d/m/Y H:i:s') }}</p>
                <p>Un email de confirmation vous a été envoyé.</p>
                <hr>
                <a href="{{ route('back.juridique.documents.show', $signature->document) }}" class="btn btn-primary">Voir le document</a>
            </div>
        </div>
    </div>
</div>
@endsection