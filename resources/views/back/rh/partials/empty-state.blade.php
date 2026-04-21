<div class="empty-state">
    <i class="{{ $icon ?? 'fa-solid fa-folder-open' }} empty-state-icon"></i>

    <h5 class="mt-3">{{ $title ?? 'Aucune donnée' }}</h5>

    @isset($text)
        <p class="text-muted">{{ $text }}</p>
    @endisset

    @isset($action)
        <div class="mt-3">
            {{ $action }}
        </div>
    @endisset
</div>