@extends('back.formation.layouts.app')

@section('title', 'Assigner un cours')
@section('page_title', 'Assigner un cours à un enseignant')
@section('page_subtitle', 'Associer un ou plusieurs cours à un formateur')

@section('formation-content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chalkboard-user mr-2"></i>
                Assignation de cours
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('back.formation.enseignants.assigner-cours') }}" method="POST" id="assignerForm">
                @csrf

                <div class="form-group">
                    <label for="enseignant_id">Enseignant <span class="text-danger">*</span></label>
                    <select name="enseignant_id" id="enseignant_id" class="form-control select2 @error('enseignant_id') is-invalid @enderror" required>
                        <option value="">-- Sélectionner un enseignant --</option>
                        @foreach($enseignants as $enseignant)
                            <option value="{{ $enseignant->id }}" {{ old('enseignant_id') == $enseignant->id ? 'selected' : '' }}>
                                {{ $enseignant->user->name ?? 'Nom inconnu' }} 
                                @if($enseignant->specialite)
                                    - {{ $enseignant->specialite }}
                                @endif
                                @if($enseignant->cours->count() > 0)
                                    ({{ $enseignant->cours->count() }} cours assignés)
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('enseignant_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Choisissez l'enseignant à qui vous voulez assigner des cours</small>
                </div>

                <div class="form-group">
                    <label for="cours">Cours à assigner <span class="text-danger">*</span></label>
                    <select name="cours[]" id="cours" class="form-control select2-multiple @error('cours') is-invalid @enderror" multiple required>
                        @foreach($cours as $cour)
                            <option value="{{ $cour->id }}" 
                                {{ old('cours') && in_array($cour->id, old('cours')) ? 'selected' : '' }}>
                                {{ $cour->titre }} 
                                @if($cour->module)
                                    ({{ $cour->module->titre }})
                                @endif
                                - Niveau: {{ $cour->niveau_difficulte ?? 'Non défini' }}
                            </option>
                        @endforeach
                    </select>
                    @error('cours')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('cours.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Maintenez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs cours</small>
                </div>

                <div class="form-group">
                    <label for="role">Rôle de l'enseignant</label>
                    <select name="role" id="role" class="form-control">
                        <option value="principal" {{ old('role') == 'principal' ? 'selected' : '' }}>
                            <i class="fas fa-star text-warning"></i> Enseignant principal
                        </option>
                        <option value="assistant" {{ old('role') == 'assistant' ? 'selected' : '' }}>
                            <i class="fas fa-user-friends"></i> Assistant
                        </option>
                    </select>
                    <small class="form-text text-muted">L'enseignant principal a plus de droits sur le cours</small>
                </div>

                <hr>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save"></i> Assigner les cours
                    </button>
                    <a href="{{ route('back.formation.enseignants.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Section des assignations existantes --}}
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-list mr-2"></i>
                Assignations existantes
            </h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Enseignant</th>
                            <th>Spécialité</th>
                            <th>Cours assignés</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enseignants as $enseignant)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($enseignant->photo)
                                        <img src="{{ asset('storage/' . $enseignant->photo) }}" class="rounded-circle mr-2" width="35" height="35">
                                    @else
                                        <div class="avatar-circle mr-2" style="width: 35px; height: 35px; font-size: 14px;">
                                            {{ substr($enseignant->user->name ?? 'U', 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <strong>{{ $enseignant->user->name ?? 'Nom inconnu' }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $enseignant->user->email ?? '' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $enseignant->specialite ?? 'Non définie' }}</td>
                            <td>
                                @if($enseignant->cours->count() > 0)
                                    @foreach($enseignant->cours as $cour)
                                        <span class="badge badge-info mr-1 mb-1">{{ $cour->titre }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">Aucun cours assigné</span>
                                @endif
                            </td>
                            <td>
                                @foreach($enseignant->cours as $cour)
                                    <span class="badge badge-secondary mr-1 mb-1">{{ $cour->pivot->role ?? 'principal' }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($enseignant->cours as $cour)
                                    <form action="{{ route('back.formation.enseignants.retirer-cours', [$enseignant, $cour]) }}" method="POST" class="d-inline-block mb-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Retirer {{ $cour->titre }}">
                                            <i class="fas fa-times"></i> {{ $cour->titre }}
                                        </button>
                                    </form>
                                @endforeach
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="fas fa-chalkboard-user fa-3x text-muted mb-3 d-block"></i>
                                    Aucun enseignant trouvé
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Select2 simple pour l'enseignant
        $('#enseignant_id').select2({
            theme: 'bootstrap4',
            placeholder: '-- Sélectionner un enseignant --',
            allowClear: true
        });
        
        // Select2 multiple pour les cours
        $('#cours').select2({
            theme: 'bootstrap4',
            placeholder: '-- Sélectionner un ou plusieurs cours --',
            allowClear: true,
            closeOnSelect: false
        });
        
        // Validation du formulaire
        $('#assignerForm').on('submit', function(e) {
            var enseignantId = $('#enseignant_id').val();
            var cours = $('#cours').val();
            
            if (!enseignantId) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez sélectionner un enseignant.',
                    confirmButtonColor: '#d33'
                });
                return false;
            }
            
            if (!cours || cours.length === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez sélectionner au moins un cours.',
                    confirmButtonColor: '#d33'
                });
                return false;
            }
        });
        
        // Confirmation avant suppression
        $('.btn-danger').on('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir retirer ce cours ?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush

@push('styles')
<style>
    .select2-container--bootstrap4 .select2-selection--multiple {
        min-height: calc(2.25rem + 2px);
    }
    .avatar-circle {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
    }
    .badge-info {
        background-color: #17a2b8;
    }
    .badge-secondary {
        background-color: #6c757d;
    }
</style>
@endpush