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
            --radius-lg: 20px;
            --radius-md: 14px;
        }

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: 'Inter', sans-serif;
            background: var(--bg-main);
            color: var(--text-dark);
            min-height: 100vh;
        }

        a{
            text-decoration: none;
            color: inherit;
        }

        .app-shell{
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .app-topbar{
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .app-brand{
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .app-brand-logo{
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 18px;
        }

        .app-brand-text h1{
            font-size: 18px;
            font-weight: 800;
            line-height: 1.1;
        }

        .app-brand-text p{
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .app-user-actions{
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .app-user-box{
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 8px 14px;
            font-size: 14px;
            font-weight: 600;
        }

        .app-logout-btn{
            border: none;
            background: var(--primary);
            color: white;
            border-radius: 14px;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: .25s ease;
        }

        .app-logout-btn:hover{
            background: var(--primary-dark);
        }

        .app-page-header{
            padding: 24px 24px 0;
        }

        .app-page-header-card{
            background: linear-gradient(180deg, #f8fcfc 0%, #ffffff 100%);
            border: 1px solid #dcefeb;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(16,24,40,0.03);
        }

        .app-page-header-card h2{
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .app-page-header-card p{
            font-size: 15px;
            color: var(--text-muted);
            line-height: 1.7;
        }

        .app-main{
            flex: 1;
            padding: 24px;
        }

        .app-content-card{
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 24px;
            box-shadow: var(--shadow-soft);
        }

        @media (max-width: 768px){
            .app-topbar{
                padding: 14px 16px;
                flex-direction: column;
                align-items: stretch;
            }

            .app-page-header,
            .app-main{
                padding: 16px;
            }

            .app-page-header-card h2{
                font-size: 22px;
            }

            .app-user-actions{
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>
    <div class="app-shell">

        <header class="app-topbar">
            <div class="app-brand">
                <a href="{{ url('/') }}" class="app-brand-logo">
                    E
                </a>

                <div class="app-brand-text">
                    <h1>EUNITAL</h1>
                    <p>Hub Digital Admin</p>
                </div>
            </div>

            <div class="app-user-actions">
                @auth
                    <div class="app-user-box">
                        {{ auth()->user()->name }}
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="app-logout-btn">
                            Déconnexion
                        </button>
                    </form>
                @endauth
            </div>
        </header>

        @isset($header)
            <section class="app-page-header">
                <div class="app-page-header-card">
                    {{ $header }}
                </div>
            </section>
        @endisset

        <main class="app-main">
            <div class="app-content-card">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>