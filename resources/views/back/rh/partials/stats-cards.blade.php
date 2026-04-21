<div class="row g-4">
    @foreach($cards as $card)
        <div class="{{ $card['col'] ?? 'col-md-3' }}">
            <div class="content-card h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="mini-label">{{ $card['label'] }}</div>
                        <h3 class="stat-number {{ $card['value_class'] ?? '' }}">{{ $card['value'] }}</h3>
                    </div>
                    <div class="stat-icon {{ $card['icon_bg'] ?? 'bg-primary-subtle text-primary' }}">
                        <i class="{{ $card['icon'] }}"></i>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>