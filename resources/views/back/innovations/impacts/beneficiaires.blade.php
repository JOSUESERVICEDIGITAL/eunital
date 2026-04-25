@extends('back.layouts.principal')

@section('title', 'Bénéficiaires impact')
@section('page_title', 'Bénéficiaires')
@section('page_subtitle', optional($impact->innovation)->titre ?? 'Innovation')

@section('content')
<div class="content-card">
    <div class="section-head">
        <div>
            <h4>Bénéficiaires touchés</h4>
            <p>Catégories de bénéficiaires et volumes concernés.</p>
        </div>
        <a href="{{ route('back.innovations.impacts.show', $impact) }}" class="btn btn-outline-secondary rounded-pill px-4">Retour</a>
    </div>

    <div class="row g-3">
        @forelse($impact->beneficiaires as $beneficiaire)
            <div class="col-md-4">
                <div class="benef-card">
                    <h6>{{ $beneficiaire->categorie_beneficiaire }}</h6>
                    <strong>{{ number_format($beneficiaire->nombre ?? 0, 0, ',', ' ') }}</strong>
                    <p>{{ $beneficiaire->observation ?? 'Aucune observation.' }}</p>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">Aucun bénéficiaire renseigné.</div>
        @endforelse
    </div>
</div>

@include('back.innovations.impacts._styles')
@endsection
