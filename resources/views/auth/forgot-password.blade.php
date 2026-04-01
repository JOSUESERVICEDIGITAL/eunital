@extends('layouts.guest')

@section('content')
    <div class="auth-form-wrapper">

        {{-- Texte d’explication --}}
        <div class="auth-info-box">
            Mot de passe oublié ? Aucun problème. Entrez simplement votre adresse e-mail
            et nous vous enverrons un lien pour réinitialiser votre mot de passe.
        </div>

        {{-- Message succès --}}
        @if (session('status'))
            <div class="auth-alert auth-alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="auth-form">
            @csrf

            {{-- Email --}}
            <div class="auth-field">
                <label for="email" class="auth-label">Adresse e-mail</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="auth-input @error('email') is-invalid @enderror"
                    placeholder="Entrez votre adresse e-mail"
                >
                @error('email')
                    <div class="auth-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Bouton --}}
            <button type="submit" class="auth-submit-btn">
                Envoyer le lien de réinitialisation
            </button>
        </form>

        {{-- Footer --}}
        <div class="auth-footer">
            <p>Vous vous souvenez de votre mot de passe ?</p>
            <a href="{{ route('login') }}" class="auth-footer-link">
                Retour à la connexion
            </a>
        </div>
    </div>

    <style>
        .auth-form-wrapper{
            width: 100%;
        }

        .auth-info-box{
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 14px 16px;
            font-size: 14px;
            color: #475569;
            margin-bottom: 18px;
            line-height: 1.6;
        }

        .auth-alert{
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 18px;
            font-size: 14px;
            font-weight: 600;
        }

        .auth-alert-success{
            background: #ecfdf5;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .auth-form{
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .auth-field{
            display: flex;
            flex-direction: column;
        }

        .auth-label{
            font-size: 14px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .auth-input{
            width: 100%;
            height: 52px;
            border: 1px solid #dbe3ec;
            border-radius: 14px;
            padding: 0 16px;
            font-size: 15px;
            color: #1f2937;
            background: #fff;
            outline: none;
            transition: all .2s ease;
        }

        .auth-input:focus{
            border-color: #11b1ad;
            box-shadow: 0 0 0 4px rgba(17, 177, 173, 0.10);
        }

        .auth-input.is-invalid{
            border-color: #ef4444;
        }

        .auth-error{
            margin-top: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #dc2626;
        }

        .auth-submit-btn{
            width: 100%;
            height: 54px;
            border: none;
            border-radius: 16px;
            background: linear-gradient(135deg, #11b1ad, #0d9488);
            color: white;
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
            transition: all .25s ease;
            margin-top: 6px;
        }

        .auth-submit-btn:hover{
            transform: translateY(-1px);
            box-shadow: 0 12px 24px rgba(17, 177, 173, 0.22);
        }

        .auth-footer{
            margin-top: 20px;
            text-align: center;
        }

        .auth-footer p{
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 6px;
        }

        .auth-footer-link{
            font-size: 14px;
            font-weight: 700;
            color: #0f9f9b;
            text-decoration: none;
        }

        .auth-footer-link:hover{
            text-decoration: underline;
        }
    </style>
@endsection