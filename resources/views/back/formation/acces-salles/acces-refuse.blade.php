<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès refusé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center shadow">
                    <div class="card-header bg-danger text-white">
                        <h4><i class="fas fa-ban"></i> Accès refusé</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ $message ?? 'Code invalide ou expiré.' }}
                        </div>
                        <p>Veuillez vérifier votre code d'accès ou contacter votre formateur.</p>
                        <a href="{{ url('/') }}" class="btn btn-primary">Retour à l'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>