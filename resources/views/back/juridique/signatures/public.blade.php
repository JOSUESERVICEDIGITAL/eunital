<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signature électronique - {{ $signature->document->titre }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Signature électronique</h4>
                    </div>
                    <div class="card-body">
                        <h5>{{ $signature->document->titre }}</h5>
                        <p>{{ $signature->document->description }}</p>
                        <hr>
                        <div class="alert alert-info">Veuillez signer dans le cadre ci-dessous :</div>
                        
                        <div class="text-center border rounded p-3 bg-white mb-3">
                            <canvas id="signatureCanvas" width="500" height="200" style="border: 1px solid #ccc; width: 100%; height: auto;"></canvas>
                        </div>
                        
                        <div class="btn-group w-100 mb-3">
                            <button onclick="clearSignature()" class="btn btn-secondary">Effacer</button>
                            <button onclick="saveSignature()" class="btn btn-success">Valider la signature</button>
                        </div>
                        
                        <div id="result"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const canvas = document.getElementById('signatureCanvas');
        const signaturePad = new SignaturePad(canvas, { backgroundColor: 'white' });
        
        function clearSignature() { signaturePad.clear(); }
        
        function saveSignature() {
            if (signaturePad.isEmpty()) { alert('Veuillez signer dans le cadre.'); return; }
            const dataURL = signaturePad.toDataURL();
            fetch('{{ route("public.signature.store", ["token" => $token]) }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ signature_base64: dataURL })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('result').innerHTML = '<div class="alert alert-success">Signature enregistrée avec succès ! Merci.</div>';
                    document.querySelector('.btn-group').remove();
                    signaturePad.off();
                } else { alert('Erreur : ' + (data.error || 'Réessayez')); }
            });
        }
        
        function resizeCanvas() { const ratio = Math.max(window.devicePixelRatio || 1, 1); canvas.width = canvas.offsetWidth * ratio; canvas.height = canvas.offsetHeight * ratio; canvas.getContext('2d').scale(ratio, ratio); signaturePad.clear(); }
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();
    </script>
</body>
</html>