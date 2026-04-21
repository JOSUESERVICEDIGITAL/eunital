<div class="content-card">
    <div class="table-head-custom mb-4">
        <div>
            @isset($title)
                <h5 class="mb-1 fw-bold">{{ $title }}</h5>
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

    <div class="table-responsive">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="mt-4">
            {{ $footer }}
        </div>
    @endisset
</div>