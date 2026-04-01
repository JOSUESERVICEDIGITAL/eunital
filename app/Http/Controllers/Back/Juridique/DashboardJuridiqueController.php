<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Models\Juridique\Document;
use App\Models\Juridique\Contrat;
use App\Models\Juridique\Litige;
use App\Models\Juridique\Conformite;
use App\Models\Juridique\Signature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardJuridiqueController extends Controller
{
    public function index()
    {
        // Statistiques globales
        $stats = [
            'total_documents' => Document::count(),
            'documents_brouillon' => Document::where('statut', 'brouillon')->count(),
            'documents_en_attente' => Document::where('statut', 'en_attente')->count(),
            'documents_signes' => Document::where('statut', 'signe')->count(),
            'documents_valides' => Document::where('statut', 'valide')->count(),
            'total_contrats' => Contrat::count(),
            'contrats_actifs' => Contrat::where('date_fin', '>=', now())->orWhereNull('date_fin')->count(),
            'contrats_expirant' => Contrat::whereBetween('date_fin', [now(), now()->addDays(30)])->count(),
            'litiges_ouverts' => Litige::whereIn('statut', ['ouvert', 'instruction', 'mediation'])->count(),
            'signatures_attendues' => Signature::where('statut', 'en_attente')->count(),
            'conformites_non_conformes' => Conformite::where('statut', 'non_conforme')->count(),
        ];

        // Derniers documents créés
        $derniersDocuments = Document::with('typeDocument', 'createur')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Derniers contrats signés
        $derniersContrats = Contrat::with('document')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Litiges récents
        $litigesRecents = Litige::orderBy('date_ouverture', 'desc')
            ->limit(5)
            ->get();

        // Évolution des documents (30 derniers jours)
        $evolutionDocuments = Document::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Répartition des documents par type
        $documentsParType = Document::with('typeDocument')
            ->select('type_document_id', DB::raw('count(*) as total'))
            ->groupBy('type_document_id')
            ->get()
            ->map(function($item) {
                return [
                    'type' => $item->typeDocument->nom,
                    'total' => $item->total
                ];
            });

        // Signatures en attente par utilisateur
        $signaturesEnAttente = Signature::with('user', 'document')
            ->where('statut', 'en_attente')
            ->orderBy('created_at')
            ->limit(10)
            ->get();

        return view('back.juridique.dashboard.index', compact(
            'stats',
            'derniersDocuments',
            'derniersContrats',
            'litigesRecents',
            'evolutionDocuments',
            'documentsParType',
            'signaturesEnAttente'
        ));
    }

    public function graphiques()
    {
        $data = [
            'documents_par_mois' => $this->getDocumentsParMois(),
            'contrats_par_type' => $this->getContratsParType(),
            'litiges_par_statut' => $this->getLitigesParStatut(),
            'conformites_par_statut' => $this->getConformitesParStatut(),
            'signatures_par_jour' => $this->getSignaturesParJour()
        ];

        return response()->json($data);
    }

    private function getDocumentsParMois()
    {
        return Document::select(DB::raw('MONTH(created_at) as mois'), DB::raw('count(*) as total'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get()
            ->pluck('total', 'mois');
    }

    private function getContratsParType()
    {
        return Contrat::select('type_contrat', DB::raw('count(*) as total'))
            ->groupBy('type_contrat')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item->type_contrat_label => $item->total];
            });
    }

    private function getLitigesParStatut()
    {
        return Litige::select('statut', DB::raw('count(*) as total'))
            ->groupBy('statut')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item->statut_label => $item->total];
            });
    }

    private function getConformitesParStatut()
    {
        return Conformite::select('statut', DB::raw('count(*) as total'))
            ->groupBy('statut')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item->statut_label => $item->total];
            });
    }

    private function getSignaturesParJour()
    {
        return Signature::where('statut', 'signe')
            ->select(DB::raw('DATE(date_signature) as date'), DB::raw('count(*) as total'))
            ->where('date_signature', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date');
    }
}
