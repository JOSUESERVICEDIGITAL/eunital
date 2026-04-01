@extends('layouts.guest')

@section('content')
    <div class="auth-form-wrapper">

        {{-- Texte --}}
        <div class="auth-info-box">
            Zone sécurisée : veuillez confirmer votre mot de passe avant de continuer.
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="auth-form">
            @csrf

            {{-- Mot de passe --}}
            <div class="auth-field">
                <label for="password" class="auth-label">Mot de passe</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="auth-input @error('password') is-invalid @enderror"
                    placeholder="Entrez votre mot de passe"
                >
                @error('password')
                    <div class="auth-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Bouton --}}
            <button type="submit" class="auth-submit-btn">
                Confirmer
            </button>
        </form>

        {{-- Footer --}}
        <div class="auth-footer">
            <p>Vous avez oublié votre mot de passe ?</p>
            <a href="{{ route('password.request') }}" class="auth-footer-link">
                Réinitialiser le mot de passe
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