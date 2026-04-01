@extends('layouts.guest')

@section('content')
    <div class="auth-form-wrapper">

        <div class="auth-info-box">
            Merci pour votre inscription. Avant de commencer, veuillez vérifier votre adresse e-mail
            en cliquant sur le lien que nous venons de vous envoyer. Si vous n’avez pas reçu l’e-mail,
            nous pouvons vous en renvoyer un autre.
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="auth-alert auth-alert-success">
                Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
            </div>
        @endif

        <div class="auth-action-stack">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="auth-submit-btn">
                    Renvoyer l’e-mail de vérification
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="auth-secondary-btn">
                    Déconnexion
                </button>
            </form>
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
            line-height: 1.7;
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

        .auth-action-stack{
            display: flex;
            flex-direction: column;
            gap: 14px;
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
        }

        .auth-submit-btn:hover{
            transform: translateY(-1px);
            box-shadow: 0 12px 24px rgba(17, 177, 173, 0.22);
        }

        .auth-secondary-btn{
            width: 100%;
            height: 50px;
            border: 1px solid #dbe3ec;
            border-radius: 16px;
            background: #fff;
            color: #475569;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all .25s ease;
        }

        .auth-secondary-btn:hover{
            border-color: #11b1ad;
            color: #0f9f9b;
            background: #f8fffe;
        }
    </style>
@endsection