<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Backoffice EUNITAL')</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @include('back.layouts.style')
    @stack('styles')
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="backoffice-wrapper">

        @include('back.layouts.sidebar')

        <div class="main-area">
            @include('back.layouts.topbar')

            <main class="content-area">
                @include('back.layouts.header')

                @yield('content')
            </main>
        </div>
    </div>

    @include('back.layouts.script')
    @stack('scripts')
</body>
</html>
