<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Models\Juridique\Document;
use App\Models\Juridique\Contrat;
use App\Models\Juridique\Litige;
use App\Models\Juridique\Signature;
use App\Models\Juridique\Conformite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistiqueJuridiqueController extends Controller
{
    public function index()
    {
        $periode = request()->get('periode', 'mois');
        $dateDebut = $this->getDateDebut($periode);

        $stats = [
            'global' => $this->getStatistiquesGlobales(),
            'evolution' => $this->getEvolution($dateDebut),
            'documents' => $this->getStatistiquesDocuments(),
            'contrats' => $this->getStatistiquesContrats(),
            'litiges' => $this->getStatistiquesLitiges(),
            'conformites' => $this->getStatistiquesConformites(),
            'signatures' => $this->getStatistiquesSignatures(),
            'top' => $this->getTopStats()
        ];

        return view('back.juridique.statistiques.index', compact('stats', 'periode'));
    }

    private function getStatistiquesGlobales()
    {
        return [
            'total_documents' => Document::count(),
            'total_contrats' => Contrat::count(),
            'total_litiges' => Litige::count(),
            'total_signatures' => Signature::count(),
            'taux_conformite' => $this->calculerTauxConformiteGlobal(),
            'valeur_contrats' => Contrat::sum('montant'),
            'cout_litiges' => Litige::sum('cout_total'),
            'documents_par_jour' => $this->calculerMoyenneDocumentsParJour()
        ];
    }

    private function getEvolution($dateDebut)
    {
        return [
            'documents' => Document::selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->where('created_at', '>=', $dateDebut)
                ->groupBy('date')
                ->orderBy('date')
                ->get(),
            'contrats' => Contrat::selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->where('created_at', '>=', $dateDebut)
                ->groupBy('date')
                ->orderBy('date')
                ->get(),
            'litiges' => Litige::selectRaw('DATE(date_ouverture) as date, COUNT(*) as total')
                ->where('date_ouverture', '>=', $dateDebut)
                ->groupBy('date')
                ->orderBy('date')
                ->get()
        ];
    }

    private function getStatistiquesDocuments()
    {
        return [
            'par_statut' => Document::select('statut', DB::raw('count(*) as total'))
                ->groupBy('statut')
                ->get()
                ->mapWithKeys(fn($item) => [$item->statut_label => $item->total]),
            'par_type' => Document::with('typeDocument')
                ->select('type_document_id', DB::raw('count(*) as total'))
                ->groupBy('type_document_id')
                ->get()
                ->mapWithKeys(fn($item) => [$item->typeDocument->nom => $item->total]),
            'par_mois' => Document::selectRaw('MONTH(created_at) as mois, COUNT(*) as total')
                ->whereYear('created_at', date('Y'))
                ->groupBy('mois')
                ->orderBy('mois')
                ->get()
                ->pluck('total', 'mois')
        ];
    }

    private function getStatistiquesContrats()
    {
        return [
            'par_type' => Contrat::select('type_contrat', DB::raw('count(*) as total'))
                ->groupBy('type_contrat')
                ->get()
                ->mapWithKeys(fn($item) => [$item->type_contrat_label => $item->total]),
            'valeur_par_type' => Contrat::select('type_contrat', DB::raw('SUM(montant) as total'))
                ->whereNotNull('montant')
                ->groupBy('type_contrat')
                ->get()
                ->mapWithKeys(fn($item) => [$item->type_contrat_label => $item->total]),
            'evolution_montant' => Contrat::selectRaw('MONTH(created_at) as mois, SUM(montant) as total')
                ->whereYear('created_at', date('Y'))
                ->whereNotNull('montant')
                ->groupBy('mois')
                ->orderBy('mois')
                ->get()
                ->pluck('total', 'mois')
        ];
    }

    private function getStatistiquesLitiges()
    {
        return [
            'par_type' => Litige::select('type', DB::raw('count(*) as total'))
                ->groupBy('type')
                ->get()
                ->mapWithKeys(fn($item) => [$item->type_label => $item->total]),
            'par_statut' => Litige::select('statut', DB::raw('count(*) as total'))
                ->groupBy('statut')
                ->get()
                ->mapWithKeys(fn($item) => [$item->statut_label => $item->total]),
            'cout_moyen' => Litige::avg('cout_total'),
            'duree_moyenne' => Litige::whereNotNull('date_cloture')
                ->selectRaw('AVG(DATEDIFF(date_cloture, date_ouverture)) as duree_moyenne')
                ->value('duree_moyenne')
        ];
    }

    private function getStatistiquesConformites()
    {
        $total = Conformite::count();
        $conformes = Conformite::where('statut', 'conforme')->count();

        return [
            'par_statut' => Conformite::select('statut', DB::raw('count(*) as total'))
                ->groupBy('statut')
                ->get()
                ->mapWithKeys(fn($item) => [$item->statut_label => $item->total]),
            'score_moyen' => Conformite::avg('score_conformite'),
            'taux_conformite' => $total > 0 ? round(($conformes / $total) * 100, 2) : 0,
            'evaluations_par_mois' => Conformite::selectRaw('MONTH(created_at) as mois, COUNT(*) as total')
                ->whereYear('created_at', date('Y'))
                ->groupBy('mois')
                ->orderBy('mois')
                ->get()
                ->pluck('total', 'mois')
        ];
    }

    private function getStatistiquesSignatures()
    {
        return [
            'par_statut' => Signature::select('statut', DB::raw('count(*) as total'))
                ->groupBy('statut')
                ->get()
                ->mapWithKeys(fn($item) => [$item->statut_label => $item->total]),
            'duree_moyenne_signature' => Signature::whereNotNull('date_signature')
                ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, created_at, date_signature)) as duree_moyenne')
                ->value('duree_moyenne'),
            'signatures_par_jour' => Signature::selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->where('created_at', '>=', now()->subDays(30))
                ->groupBy('date')
                ->orderBy('date')
                ->get()
        ];
    }

    private function getTopStats()
    {
        return [
            'types_documents_utilises' => Document::with('typeDocument')
                ->select('type_document_id', DB::raw('count(*) as total'))
                ->groupBy('type_document_id')
                ->orderBy('total', 'desc')
                ->limit(5)
                ->get()
                ->map(fn($item) => [
                    'type' => $item->typeDocument->nom,
                    'total' => $item->total
                ]),
            'utilisateurs_actifs' => Document::select('cree_par', DB::raw('count(*) as total'))
                ->with('createur')
                ->groupBy('cree_par')
                ->orderBy('total', 'desc')
                ->limit(5)
                ->get()
                ->map(fn($item) => [
                    'utilisateur' => $item->createur->name,
                    'total' => $item->total
                ]),
            'contrats_plus_valeureux' => Contrat::with('document')
                ->whereNotNull('montant')
                ->orderBy('montant', 'desc')
                ->limit(5)
                ->get()
                ->map(fn($item) => [
                    'reference' => $item->reference,
                    'montant' => $item->montant,
                    'document' => $item->document->titre
                ])
        ];
    }

    private function calculerTauxConformiteGlobal()
    {
        $total = Conformite::count();
        $conformes = Conformite::where('statut', 'conforme')->count();

        return $total > 0 ? round(($conformes / $total) * 100, 2) : 0;
    }

    private function calculerMoyenneDocumentsParJour()
    {
        $total = Document::count();
        $premierDocument = Document::min('created_at');

        if (!$premierDocument) return 0;

        $jours = now()->diffInDays($premierDocument);

        return $jours > 0 ? round($total / $jours, 2) : $total;
    }

    private function getDateDebut($periode)
    {
        return match($periode) {
            'semaine' => now()->subDays(7),
            'mois' => now()->subMonth(),
            'trimestre' => now()->subMonths(3),
            'annee' => now()->subYear(),
            default => now()->subMonth()
        };
    }

    public function export(Request $request)
    {
        $request->validate([
            'format' => 'required|in:excel,pdf,csv',
            'periode' => 'nullable|in:semaine,mois,trimestre,annee'
        ]);

        $periode = $request->periode ?? 'mois';
        $dateDebut = $this->getDateDebut($periode);

        $data = [
            'global' => $this->getStatistiquesGlobales(),
            'evolution' => $this->getEvolution($dateDebut),
            'documents' => $this->getStatistiquesDocuments(),
            'contrats' => $this->getStatistiquesContrats(),
            'litiges' => $this->getStatistiquesLitiges(),
            'conformites' => $this->getStatistiquesConformites(),
            'periode' => $periode,
            'date_generation' => now()
        ];

        if ($request->format === 'pdf') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('back.juridique.statistiques.export-pdf', $data);
            return $pdf->download("statistiques_juridiques_{$periode}_" . date('Y-m-d') . '.pdf');
        }

        if ($request->format === 'csv') {
            return $this->exportCsv($data);
        }

        return redirect()->back()->with('info', 'Export Excel à implémenter.');
    }

    private function exportCsv($data)
    {
        $filename = "statistiques_juridiques_" . date('Y-m-d_His') . '.csv';
        $handle = fopen('php://temp', 'w+');

        // En-têtes
        fputcsv($handle, ['Statistique', 'Valeur']);

        // Données globales
        fputcsv($handle, ['=== STATISTIQUES GLOBALES ===', '']);
        foreach ($data['global'] as $key => $value) {
            fputcsv($handle, [$key, $value]);
        }

        // Documents par statut
        fputcsv($handle, ['', '']);
        fputcsv($handle, ['=== DOCUMENTS PAR STATUT ===', '']);
        foreach ($data['documents']['par_statut'] as $statut => $total) {
            fputcsv($handle, [$statut, $total]);
        }

        // Contrats par type
        fputcsv($handle, ['', '']);
        fputcsv($handle, ['=== CONTRATS PAR TYPE ===', '']);
        foreach ($data['contrats']['par_type'] as $type => $total) {
            fputcsv($handle, [$type, $total]);
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return response($content, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
}
