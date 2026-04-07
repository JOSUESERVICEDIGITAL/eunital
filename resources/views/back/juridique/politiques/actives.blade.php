@extends('back.juridique.layouts.app')
@section('title', 'Politique active')
@section('page_title', 'Politique de confidentialité en vigueur')
@section('juridique-content')
<div class="card"><div class="card-header">Version active</div><div class="card-body">{!! nl2br(e($politiqueActive->contenu ?? 'Aucune politique active')) !!}</div></div>
@endsection