<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    
    <div class="ml-auto">
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" id="notificationDropdown" data-toggle="dropdown">
                <i class="fas fa-bell"></i>
                <span class="badge badge-danger badge-counter" id="notificationCount">0</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" id="notificationList">
                <h6 class="dropdown-header">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center" href="{{ route('back.juridique.notifications.index') }}">Voir toutes</a>
            </div>
        </div>
        
        <div class="topbar-divider d-none d-sm-block"></div>
        
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name ?? 'Admin' }}</span>
                <img class="img-profile rounded-circle" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=667eea&color=fff" width="32">
            </button>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2"></i> Profil
                </a>
                <a class="dropdown-item" href="{{ route('back.juridique.notifications.preferences') }}">
                    <i class="fas fa-bell fa-sm fa-fw mr-2"></i> Préférences
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i> Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

@push('juridique-scripts')
<script>
    function chargerNotifications() {
        $.get('/back/juridique/notifications/non-lues', function(data) {
            $('#notificationCount').text(data.count);
            var html = '<h6 class="dropdown-header">Notifications (' + data.count + ')</h6><div class="dropdown-divider"></div>';
            data.notifications.forEach(function(n) {
                html += '<a class="dropdown-item" href="/back/juridique/notifications/' + n.id + '">' +
                    '<i class="fas fa-' + (n.type === 'signature' ? 'pen' : 'file') + ' fa-sm fa-fw mr-2"></i> ' +
                    n.message + '<br><small class="text-muted">' + n.created_at + '</small></a><div class="dropdown-divider"></div>';
            });
            html += '<a class="dropdown-item text-center" href="/back/juridique/notifications">Voir toutes</a>';
            $('#notificationList').html(html);
        });
    }
    chargerNotifications();
    setInterval(chargerNotifications, 30000);
</script>
@endpush