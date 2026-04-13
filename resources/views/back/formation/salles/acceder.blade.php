@extends('back.formation.layouts.app')

@section('title', 'Accéder à une salle')
@section('page_title', 'Accès par code')
@section('page_subtitle', 'Entrez votre code d\'accès ou scannez le QR code')

@section('formation-content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <i class="fas fa-door-open fa-2x mb-2"></i>
                <h3 class="mb-0">Accéder à une salle</h3>
                <p class="mb-0 mt-2">Entrer par code d’accès ou QR code</p>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ route('back.formation.salles.acceder-code') }}" method="POST" id="accesForm">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="code">Code d'accès <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-qrcode"></i></span>
                            </div>
                            <input type="text" 
                                   name="code" 
                                   id="code" 
                                   class="form-control text-center @error('code') is-invalid @enderror" 
                                   placeholder="Entrez votre code" 
                                   value="{{ old('code') }}" 
                                   required 
                                   autofocus>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" onclick="scannerQR()">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </div>
                        </div>
                        @error('code')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Entrez le code à 8 caractères fourni par votre formateur</small>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="cour_id">Cours (optionnel)</label>
                        <select name="cour_id" id="cour_id" class="form-control">
                            <option value="">Tous les cours</option>
                            @foreach($cours ?? [] as $cour)
                                <option value="{{ $cour->id }}" {{ old('cour_id') == $cour->id ? 'selected' : '' }}>
                                    {{ $cour->titre }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Facultatif - permet de cibler un cours spécifique</small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="submitBtn">
                        <i class="fas fa-sign-in-alt"></i> Entrer dans la salle
                    </button>
                </form>
            </div>
            <div class="card-footer text-center bg-light">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('back.formation.salles.index') }}" class="btn btn-link">
                            <i class="fas fa-arrow-left"></i> Retour à la liste
                        </a>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#qrScannerModal">
                            <i class="fas fa-qrcode"></i> Scanner un QR code
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Comment obtenir un code ?</h5>
            </div>
            <div class="card-body">
                <ul class="text-muted mb-0">
                    <li>Scannez le QR code affiché par votre formateur</li>
                    <li>Le code est valide pendant une durée limitée (généralement 2 heures)</li>
                    <li>Contactez votre formateur si vous n'avez pas de code</li>
                    <li>Le code ressemble à : <code>MZIZVEHQ</code> (8 caractères)</li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- Modal Scanner QR --}}
<div class="modal fade" id="qrScannerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">
                    <i class="fas fa-qrcode mr-2"></i> Scanner un QR code
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div id="qr-reader" style="width: 100%;"></div>
                <div id="qr-result" class="p-3 text-center"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
<script>
    let html5QrCode;
    
    function scannerQR() {
        $('#qrScannerModal').modal('show');
        
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                startScanner();
            }).catch(err => {});
        } else {
            startScanner();
        }
    }
    
    function startScanner() {
        html5QrCode = new Html5Qrcode("qr-reader");
        const config = { fps: 10, qrbox: { width: 250, height: 250 } };
        
        html5QrCode.start({ facingMode: "environment" }, config, (decodedText, decodedResult) => {
            // Extraire le code de l'URL
            let code = decodedText;
            if (decodedText.includes('code=')) {
                const match = decodedText.match(/[?&]code=([^&]+)/);
                if (match) code = decodeURIComponent(match[1]);
            }
            
            $('#code').val(code);
            $('#qrScannerModal').modal('hide');
            $('#accesForm').submit();
            
            html5QrCode.stop().catch(err => {});
        }, (errorMessage) => {});
    }
    
    $('#qrScannerModal').on('hidden.bs.modal', function() {
        if (html5QrCode) {
            html5QrCode.stop().catch(err => {});
        }
    });
    
    // Validation avant soumission
    $('#accesForm').on('submit', function(e) {
        const code = $('#code').val().trim();
        if (!code) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Code requis',
                text: 'Veuillez entrer un code d\'accès valide.',
                confirmButtonColor: '#d33'
            });
            return false;
        }
        $('#submitBtn').html('<i class="fas fa-spinner fa-spin"></i> Vérification...').prop('disabled', true);
    });
</script>
@endpush