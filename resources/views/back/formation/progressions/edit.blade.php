@extends('back.formation.layouts.app')

@section('title', 'Modifier la progression')
@section('page_title', 'Modification de la progression')
@section('page_subtitle', $progression->user->name . ' - ' . $progression->cour->titre)

@section('formation-content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Modifier la progression
                </h3>
            </div>
            <form action="{{ route('back.formation.progressions.update', $progression) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="user_id">Étudiant <span class="text-danger">*</span></label>
                        <select name="user_id" id="user_id" class="form-control select2 @error('user_id') is-invalid @enderror" required>
                            <option value="">Sélectionner un étudiant</option>
                            @foreach($utilisateurs as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $progression->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="cour_id">Cours <span class="text-danger">*</span></label>
                        <select name="cour_id" id="cour_id" class="form-control select2 @error('cour_id') is-invalid @enderror" required>
                            <option value="">Sélectionner un cours</option>
                            @foreach($cours as $courItem)
                            <option value="{{ $courItem->id }}" {{ old('cour_id', $progression->cour_id) == $courItem->id ? 'selected' : '' }}>
                                {{ $courItem->titre }}
                            </option>
                            @endforeach
                        </select>
                        @error('cour_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="progression">Progression (%)</label>
                                <input type="number" name="progression" id="progression" 
                                       class="form-control @error('progression') is-invalid @enderror" 
                                       value="{{ old('progression', $progression->progression) }}" 
                                       min="0" max="100" step="1">
                                @error('progression')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-control custom-switch mt-4">
                                    <input type="checkbox" name="termine" id="termine" class="custom-control-input" 
                                           value="1" {{ old('termine', $progression->termine) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="termine">
                                        <i class="fas fa-flag-checkered"></i> Terminé
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="chapitre_id">Chapitre actuel</label>
                        <select name="chapitre_id" id="chapitre_id" class="form-control @error('chapitre_id') is-invalid @enderror">
                            <option value="">Aucun</option>
                            @foreach($progression->cour->chapitres as $chapitre)
                            <option value="{{ $chapitre->id }}" {{ old('chapitre_id', $progression->chapitre_id) == $chapitre->id ? 'selected' : '' }}>
                                {{ $chapitre->titre }}
                            </option>
                            @endforeach
                        </select>
                        @error('chapitre_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="dernier_acces">Dernier accès</label>
                        <input type="datetime-local" name="dernier_acces" id="dernier_acces" 
                               class="form-control @error('dernier_acces') is-invalid @enderror" 
                               value="{{ old('dernier_acces', $progression->dernier_acces ? \Carbon\Carbon::parse($progression->dernier_acces)->format('Y-m-d\TH:i') : '') }}">
                        @error('dernier_acces')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('back.formation.progressions.show', $progression) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i> Voir
                    </a>
                    <a href="{{ route('back.formation.progressions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#user_id, #cour_id').select2({
            theme: 'bootstrap4',
            placeholder: 'Sélectionner une option',
            allowClear: true
        });
        
        $('#progression').on('change', function() {
            if ($(this).val() >= 100) {
                $('#termine').prop('checked', true);
            } else if ($(this).val() < 100) {
                $('#termine').prop('checked', false);
            }
        });
        
        $('#termine').on('change', function() {
            if ($(this).is(':checked')) {
                $('#progression').val(100);
            }
        });
    });
</script>
@endpush