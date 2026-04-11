@php
    $breadcrumbs = $breadcrumbs ?? [];
@endphp

@if(count($breadcrumbs))
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-white shadow-sm rounded px-3 py-2 mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('back.dashboard') }}">
                    <i class="fas fa-home mr-1"></i> Dashboard
                </a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{ route('back.chambre-formation.dashboard') }}">
                    Chambre formation
                </a>
            </li>

            @foreach($breadcrumbs as $breadcrumb)
                @if(!empty($breadcrumb['active']) && $breadcrumb['active'])
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $breadcrumb['label'] }}
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb['url'] ?? '#' }}">
                            {{ $breadcrumb['label'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif
