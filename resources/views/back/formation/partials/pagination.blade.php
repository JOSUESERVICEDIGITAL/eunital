@if(isset($items) && method_exists($items, 'links'))
    <div class="mt-4">
        {{ $items->links() }}
    </div>
@endif