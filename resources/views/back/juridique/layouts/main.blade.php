@extends('back.juridique.layouts.app')

@section('juridique-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('card-title')</h3>
                <div class="card-tools">@yield('card-actions')</div>
            </div>
            <div class="card-body">@yield('card-content')</div>
            <div class="card-footer">@yield('card-footer')</div>
        </div>
    </div>
</div>
@endsection