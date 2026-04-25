@extends('back.layouts.principal')

@section('title','Document')

@section('content')
<div class="row g-4">

    <div class="col-12">
        <div class="doc-hero">
            <div>
                <h2>{{ $document->nom }}</h2>
                <p>{{ $document->description }}</p>
            </div>

            <div>
                <a href="{{ asset($document->file_path) }}" target="_blank"
                   class="btn btn-success rounded-pill px-4">
                    Télécharger
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mini-stat-card">
            <span>Type</span>
            <strong>{{ $document->type }}</strong>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mini-stat-card">
            <span>Innovation</span>
            <strong>{{ optional($document->innovation)->titre }}</strong>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mini-stat-card">
            <span>Date</span>
            <strong>{{ optional($document->created_at)->format('d/m/Y') }}</strong>
        </div>
    </div>

</div>

@include('back.innovations.documents._styles')
@endsection
