@extends('back.juridique.layouts.app')
@section('title', 'CGU')
@section('page_title', 'Conditions générales d\'utilisation')
@section('juridique-content')
<div class="card"><div class="card-header">Version active</div><div class="card-body">{!! nl2br(e($cgu->contenu ?? 'Aucune version active')) !!}</div></div>
@endsection