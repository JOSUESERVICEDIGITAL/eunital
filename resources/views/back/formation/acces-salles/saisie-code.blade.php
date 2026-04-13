@extends('back.formation.layouts.app')

@section('title', 'Accès à la salle')
@section('page_title', 'Accès à la salle de cours')
@section('page_subtitle', 'Entrez votre code d\'accès')

@section('formation-content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h3><i class="fas fa-door-open"></i> Accès à la salle</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('back.formation.acces-salles.verifier-code') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="code">Code d'accès</label>
                        <input type="text" name="code" id="code" class="form-control form-control-lg text-center"
                               placeholder="Entrez votre code" required autofocus>
                    </div>
                    <input type="hidden" name="cour_id" value="{{ $cour_id ?? '' }}">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        <i class="fas fa-sign-in-alt"></i> Accéder à la salle
                    </button>
                </form>
            </div>
            <div class="card-footer text-center text-muted">
                <small>Scannez le QR code ou saisissez le code fourni par votre formateur</small>
            </div>
        </div>
    </div>
</div>
@endsection
