@extends('layouts.guest')

@section('content')
    <div class="auth-form-wrapper">
        @if (session('status'))
            <div class="auth-alert auth-alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <div class="auth-field">
                <label for="email" class="auth-label">Adresse e-mail</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    class="auth-input @error('email') is-invalid @enderror"
                    placeholder="Entrez votre adresse e-mail"
                >
                @error('email')
                    <div class="auth-error">{{ $message }}</div>
                @enderror
            </div>

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

            <div class="auth-options">
                <label for="remember_me" class="auth-checkbox-label">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="auth-checkbox"
                    >
                    <span>Se souvenir de moi</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="auth-link">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>

            <button type="submit" class="auth-submit-btn">
                Se connecter
            </button>
        </form>

        <div class="auth-footer">
            <p>Vous n’avez pas encore de compte ?</p>
            <a href="{{ route('register') }}" class="auth-footer-link">Créer un compte</a>
        </div>
    </div>

    <style>
        .auth-form-wrapper{
            width: 100%;
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

        .auth-options{
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .auth-checkbox-label{
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: #4b5563;
            cursor: pointer;
        }

        .auth-checkbox{
            width: 16px;
            height: 16px;
            accent-color: #11b1ad;
        }

        .auth-link{
            font-size: 14px;
            font-weight: 600;
            color: #0f9f9b;
            text-decoration: none;
        }

        .auth-link:hover{
            text-decoration: underline;
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
            margin-top: 4px;
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

        @media (max-width: 576px){
            .auth-options{
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endsection