<div class="card border-0 shadow-sm mb-4">
    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <div>
            <h1 class="h4 mb-1 font-weight-bold text-dark">
                @yield('page_title', 'Chambre formation')
            </h1>
            <p class="text-muted mb-0">
                @yield('page_subtitle', 'Pilotage des activités pédagogiques')
            </p>
        </div>

        <div class="mt-3 mt-md-0">
            @yield('page_actions')
        </div>
    </div>
</div>
