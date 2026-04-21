<div class="content-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            @isset($title)
                <h4 class="mb-1 fw-bold">{{ $title }}</h4>
            @endisset

            @isset($subtitle)
                <p class="text-muted mb-0">{{ $subtitle }}</p>
            @endisset
        </div>

        @isset($actions)
            <div class="d-flex flex-wrap gap-2">
                {{ $actions }}
            </div>
        @endisset
    </div>
</div>