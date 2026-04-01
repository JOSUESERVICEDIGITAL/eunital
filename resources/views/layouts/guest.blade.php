<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EUNITAL') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root{
            --primary: #11b1ad;
            --primary-dark: #0d9488;
            --bg-main: #f5f7fb;
            --white: #ffffff;
            --text-dark: #18233a;
            --text-muted: #6b7a90;
            --border: #e6ebf2;
            --shadow-soft: 0 10px 30px rgba(16, 24, 40, 0.08);
        }

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top right, rgba(17,177,173,.10), transparent 20%),
                radial-gradient(circle at bottom left, rgba(17,177,173,.08), transparent 25%),
                var(--bg-main);
            color: var(--text-dark);
            min-height: 100vh;
        }

        a{
            text-decoration: none;
            color: inherit;
        }

        .guest-shell{
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .guest-wrapper{
            width: 100%;
            max-width: 1100px;
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 32px;
            overflow: hidden;
            box-shadow: var(--shadow-soft);
        }

        .guest-left{
            padding: 48px;
            background: linear-gradient(135deg, #0f9f9b 0%, #11b1ad 45%, #8ee5df 100%);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 640px;
        }

        .guest-brand{
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .guest-brand-logo{
            width: 54px;
            height: 54px;
            border-radius: 18px;
            background: rgba(255,255,255,.18);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 800;
            border: 1px solid rgba(255,255,255,.25);
        }

        .guest-brand-text h1{
            font-size: 22px;
            font-weight: 800;
            line-height: 1.1;
        }

        .guest-brand-text p{
            font-size: 14px;
            opacity: .9;
            margin-top: 4px;
        }

        .guest-hero h2{
            font-size: 40px;
            line-height: 1.15;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .guest-hero p{
            font-size: 16px;
            line-height: 1.8;
            max-width: 460px;
            opacity: .95;
        }

        .guest-bottom{
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.20);
            border-radius: 20px;
            padding: 20px;
        }

        .guest-bottom strong{
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .guest-bottom span{
            font-size: 14px;
            line-height: 1.7;
            opacity: .95;
        }

        .guest-right{
            padding: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fcfeff;
        }

        .guest-card{
            width: 100%;
            max-width: 420px;
        }

        .guest-card-top{
            margin-bottom: 26px;
            text-align: left;
        }

        .guest-card-top h3{
            font-size: 30px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .guest-card-top p{
            font-size: 15px;
            color: var(--text-muted);
            line-height: 1.7;
        }

        .guest-form-box{
            background: white;
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        }

        @media (max-width: 992px){
            .guest-wrapper{
                grid-template-columns: 1fr;
            }

            .guest-left{
                min-height: auto;
                padding: 32px;
            }

            .guest-right{
                padding: 32px 20px;
            }

            .guest-hero h2{
                font-size: 30px;
            }
        }

        @media (max-width: 576px){
            .guest-shell{
                padding: 14px;
            }

            .guest-left,
            .guest-right{
                padding: 22px;
            }

            .guest-form-box{
                padding: 20px;
            }

            .guest-card-top h3{
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="guest-shell">
        <div class="guest-wrapper">

            <div class="guest-left">
                <div class="guest-brand">
                    <a href="{{ url('/') }}" class="guest-brand-logo">E</a>

                    <div class="guest-brand-text">
                        <h1>EUNITAL</h1>
                        <p>Hub Digital Admin</p>
                    </div>
                </div>

                <div class="guest-hero">
                    <h2>Bienvenue dans l’univers EUNITAL</h2>
                    <p>
                        Connecte-toi à ton espace pour gérer les contenus, les équipes,
                        les chambres du hub, les médias, les statistiques et toute
                        l’organisation digitale de la plateforme.
                    </p>
                </div>

                <div class="guest-bottom">
                    <strong>Plateforme de gestion centralisée</strong>
                    <span>
                        Une interface pensée pour l’administration, la coordination,
                        la communication interne et le pilotage stratégique du hub.
                    </span>
                </div>
            </div>

            <div class="guest-right">
                <div class="guest-card">
                    <div class="guest-card-top">
                        <h3>Espace sécurisé</h3>
                        <p>Veuillez renseigner vos informations pour accéder à votre compte.</p>
                    </div>

                    <div class="guest-form-box">
                       @yield('content')
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>