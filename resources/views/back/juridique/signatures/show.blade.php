@extends('back.juridique.layouts.app')
@section('title', 'Détails signature')
@section('page_title', 'Signature')
@section('page_subtitle', $signature->user->name)

@section('juridique-content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-info-circle"></i> Informations</h3></div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Document</dt><dd class="col-sm-8"><a href="{{ route('back.juridique.documents.show', $signature->document) }}">{{ $signature->document->titre }}</a></dd>
                    <dt class="col-sm-4">Signataire</dt><dd class="col-sm-8"><strong>{{ $signature->user->name }}</strong><br>{{ $signature->user->email }}</dd>
                    <dt class="col-sm-4">Type</dt><dd class="col-sm-8">{{ $signature->type_signataire_label }}</dd>
                    <dt class="col-sm-4">Ordre</dt><dd class="col-sm-8">{{ $signature->ordre + 1 }}</dd>
                    <dt class="col-sm-4">Statut</dt><dd class="col-sm-8">@include('back.juridique.partials.status-badge', ['status' => $signature->statut])</dd>
                    @if($signature->date_signature)
                    <dt class="col-sm-4">Date signature</dt><dd class="col-sm-8">{{ $signature->date_signature->format('d/m/Y H:i:s') }}</dd>
                    <dt class="col-sm-4">Adresse IP</dt><dd class="col-sm-8">{{ $signature->adresse_ip }}</dd>
                    @endif
                    @if($signature->commentaire)
                    <dt class="col-sm-4">Commentaire</dt><dd class="col-sm-8">{{ $signature->commentaire }}</dd>
                    @endif
                </dl>
                @if($signature->signature_base64)
                <hr><div class="text-center"><img src="{{ $signature->signature_base64 }}" style="max-height: 100px;" alt="Signature"></div>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('back.juridique.signatures.edit', $signature) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</a>
                <a href="{{ route('back.juridique.signatures.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-history"></i> Historique</h3></div>
            <div class="card-body">
                @php $historique = $signature->document->metadatas['historique'] ?? [] @endphp
                <div class="timeline">
                    @foreach($historique as $event)
                    <div><i class="fas fa-circle bg-primary"></i><div class="timeline-item"><span class="time"><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($event['date'])->format('d/m/Y H:i') }}</span><div class="timeline-body">{{ $event['action'] }} - {{ $event['utilisateur'] ?? 'Système' }}</div></div></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('juridique-styles')
<style>.timeline{position:relative;margin:0}.timeline:before{content:'';position:absolute;top:0;bottom:0;width:2px;background:#ddd;left:20px}.timeline>div{position:relative;margin-bottom:15px;margin-left:40px}.timeline>div>i{position:absolute;left:-28px;top:0;background:#fff;border-radius:50%;padding:4px}.timeline-item{background:#f8f9fa;border-radius:4px;padding:10px}</style>
@endpush
