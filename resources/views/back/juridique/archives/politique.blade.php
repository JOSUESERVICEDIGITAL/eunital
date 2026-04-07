@extends('back.juridique.layouts.app')
@section('title', 'Politique d\'archivage')
@section('page_title', 'Politique de conservation')
@section('juridique-content')
<div class="row"><div class="col-md-6"><div class="card"><div class="card-header">Durées de conservation</div><div class="card-body"><ul><li>Documents contractuels: 10 ans</li><li>Contrats: durée du contrat + 10 ans</li><li>Litiges: 10 ans après clôture</li><li>Factures: 10 ans</li></ul></div></div></div><div class="col-md-6"><div class="card"><div class="card-header">Statistiques</div><div class="card-body"><dl><dt>Total archives</dt><dd>{{ $stats['total'] }}</dd><dt>À détruire</dt><dd>{{ $stats['a_detruire'] }}</dd><dt>Détruites</dt><dd>{{ $stats['detruites'] }}</dd></dl></div></div></div></div>
@endsection