@extends('back.juridique.layouts.app')
@section('title', 'FAQ juridique')
@section('page_title', 'Foire aux questions')
@section('juridique-content')
<div class="card"><div class="card-header"><h3 class="card-title"><i class="fas fa-question-circle"></i> Questions fréquentes</h3></div><div class="card-body">@forelse($faqs as $faq)<div class="mb-4"><h5>{{ $faq['question'] ?? '' }}</h5><p>{{ $faq['reponse'] ?? '' }}</p><hr></div>@empty<div class="text-center">Aucune FAQ disponible</div>@endforelse</div></div>
@endsection