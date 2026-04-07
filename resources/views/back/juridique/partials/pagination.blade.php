@if(isset($items) && method_exists($items, 'links'))
<div class="d-flex justify-content-center">{{ $items->links() }}</div>
@endif