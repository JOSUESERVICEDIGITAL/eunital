@extends('back.juridique.layouts.app')
@section('title', 'CGV')
@section('page_title', 'Conditions générales de vente')
@section('juridique-content')
<div class="card"><div class="card-header">Version active</div><div class="card-body">{!! nl2br(e($cgv->contenu ?? 'Aucune version active')) !!}</div></div>
@endsection