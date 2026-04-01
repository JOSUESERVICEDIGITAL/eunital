<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Models\Formation\Module;
use App\Models\Formation\Cour;
use App\Models\Formation\Inscription;
use App\Models\Formation\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportFormationController extends Controller
{
    public function exportExcel(Request $request)
    {
        $type = $request->get('type', 'cours');
        
        switch ($type) {
            case 'cours':
                return $this->exportCoursExcel();
            case 'inscriptions':
                return $this->exportInscriptionsExcel();
            case 'presences':
                return $this->exportPresencesExcel();
            case 'progressions':
                return $this->exportProgressionsExcel();
            default:
                return redirect()->back()->with('error', 'Type d\'export non valide.');
        }
    }

    public function exportPdf(Request $request)
    {
        $type = $request->get('type', 'cours');
        
        switch ($type) {
            case 'cours':
                return $this->exportCoursPdf();
            case 'inscriptions':
                return $this->exportInscriptionsPdf();
            case 'presences':
                return $this->exportPresencesPdf();
            case 'progressions':
                return $this->exportProgressionsPdf();
            default:
                return redirect()->back()->with('error', 'Type d\'export non valide.');
        }
    }

    private function exportCoursExcel()
    {
        $cours = Cour::with('module')->get();
        
        $data = $cours->map(function($cour) {
            return [
                'Titre' => $cour->titre,
                'Module' => $cour->module->titre,
                'Niveau' => $cour->niveau_difficulte,
                'Durée estimée' => $cour->duree_estimee . ' min',
                'Publié' => $cour->is_published ? 'Oui' : 'Non',
                'Date de création' => $cour->created_at->format('d/m/Y'),
                'Nombre d\'étudiants' => $cour->utilisateurs()->count(),
                'Progression moyenne' => round($cour->progressions()->avg('progression') ?? 0, 2) . '%'
            ];
        });
        
        $filename = 'cours_' . date('Y-m-d_His') . '.csv';
        
        return $this->exportCsv($data, $filename);
    }

    private function exportInscriptionsExcel()
    {
        $inscriptions = Inscription::with(['user', 'module'])->get();
        
        $data = $inscriptions->map(function($inscription) {
            return [
                'Étudiant' => $inscription->user->name,
                'Email' => $inscription->user->email,
                'Module' => $inscription->module->titre,
                'Statut' => $this->getStatutLabel($inscription->statut),
                'Date début' => $inscription->date_debut ? $inscription->date_debut->format('d/m/Y') : '',
                'Date fin' => $inscription->date_fin ? $inscription->date_fin->format('d/m/Y') : '',
                'Progression' => $inscription->progression . '%',
                'Dernière activité' => $inscription->derniere_activite ? $inscription->derniere_activite->format('d/m/Y') : '',
                'Taux présence' => round($inscription->taux_presence, 2) . '%'
            ];
        });
        
        $filename = 'inscriptions_' . date('Y-m-d_His') . '.csv';
        
        return $this->exportCsv($data, $filename);
    }

    private function exportPresencesExcel()
    {
        $presences = Presence::with(['inscription.user', 'cour'])->get();
        
        $data = $presences->map(function($presence) {
            return [
                'Étudiant' => $presence->inscription->user->name,
                'Cours' => $presence->cour->titre,
                'Date' => $presence->date_debut ? $presence->date_debut->format('d/m/Y') : '',
                'Heure début' => $presence->date_debut ? $presence->date_debut->format('H:i') : '',
                'Heure fin' => $presence->date_fin ? $presence->date_fin->format('H:i') : '',
                'Durée' => $presence->duree_formatee,
                'Statut' => $presence->present ? 'Présent' : 'Absent'
            ];
        });
        
        $filename = 'presences_' . date('Y-m-d_His') . '.csv';
        
        return $this->exportCsv($data, $filename);
    }

    private function exportProgressionsExcel()
    {
        $progressions = DB::table('progressions')
            ->join('users', 'progressions.user_id', '=', 'users.id')
            ->join('cours', 'progressions.cour_id', '=', 'cours.id')
            ->select(
                'users.name as etudiant',
                'cours.titre as cours',
                'progressions.progression',
                'progressions.termine',
                'progressions.dernier_acces'
            )
            ->orderBy('progression', 'desc')
            ->get();
        
        $data = $progressions->map(function($progression) {
            return [
                'Étudiant' => $progression->etudiant,
                'Cours' => $progression->cours,
                'Progression' => $progression->progression . '%',
                'Terminé' => $progression->termine ? 'Oui' : 'Non',
                'Dernier accès' => $progression->dernier_acces ? \Carbon\Carbon::parse($progression->dernier_acces)->format('d/m/Y H:i') : ''
            ];
        });
        
        $filename = 'progressions_' . date('Y-m-d_His') . '.csv';
        
        return $this->exportCsv($data, $filename);
    }

    private function exportCsv($data, $filename)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            if ($data->isNotEmpty()) {
                fputcsv($file, array_keys($data->first()));
            }
            
            foreach ($data as $row) {
                fputcsv($file, array_values($row));
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    private function getStatutLabel($statut)
    {
        $labels = [
            'en_attente' => 'En attente',
            'valide' => 'Validé',
            'termine' => 'Terminé',
            'abandonne' => 'Abandonné'
        ];
        
        return $labels[$statut] ?? $statut;
    }

    private function exportCoursPdf()
    {
        $cours = Cour::with('module')->get();
        $pdf = \PDF::loadView('back.formation.exports.cours-pdf', compact('cours'));
        
        return $pdf->download('cours_' . date('Y-m-d') . '.pdf');
    }

    private function exportInscriptionsPdf()
    {
        $inscriptions = Inscription::with(['user', 'module'])->get();
        $pdf = \PDF::loadView('back.formation.exports.inscriptions-pdf', compact('inscriptions'));
        
        return $pdf->download('inscriptions_' . date('Y-m-d') . '.pdf');
    }

    private function exportPresencesPdf()
    {
        $presences = Presence::with(['inscription.user', 'cour'])->get();
        $pdf = \PDF::loadView('back.formation.exports.presences-pdf', compact('presences'));
        
        return $pdf->download('presences_' . date('Y-m-d') . '.pdf');
    }

    private function exportProgressionsPdf()
    {
        $progressions = DB::table('progressions')
            ->join('users', 'progressions.user_id', '=', 'users.id')
            ->join('cours', 'progressions.cour_id', '=', 'cours.id')
            ->select(
                'users.name as etudiant',
                'cours.titre as cours',
                'progressions.progression',
                'progressions.termine',
                'progressions.dernier_acces'
            )
            ->orderBy('progression', 'desc')
            ->get();
        
        $pdf = \PDF::loadView('back.formation.exports.progressions-pdf', compact('progressions'));
        
        return $pdf->download('progressions_' . date('Y-m-d') . '.pdf');
    }
}