@if(isset($items) && method_exists($items, 'links'))
    <div class="d-flex justify-content-center justify-content-md-end">
        {{ $items->links() }}
    </div>
@endif
