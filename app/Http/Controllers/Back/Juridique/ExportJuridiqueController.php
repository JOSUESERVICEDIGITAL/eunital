<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\ExportJuridiqueRequest;
use App\Models\Juridique\Document;
use App\Models\Juridique\Contrat;
use App\Models\Juridique\Litige;
use App\Models\Juridique\Legalite;
use App\Models\Juridique\ConseilJuridique;
use App\Models\Juridique\Conformite;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportJuridiqueController extends Controller
{
    public function export(ExportJuridiqueRequest $request)
    {
        $type = $request->type;
        $format = $request->format;

        switch ($type) {
            case 'documents':
                return $this->exportDocuments($request, $format);
            case 'contrats':
                return $this->exportContrats($request, $format);
            case 'litiges':
                return $this->exportLitiges($request, $format);
            case 'legalites':
                return $this->exportLegalites($request, $format);
            case 'conseils':
                return $this->exportConseils($request, $format);
            case 'conformites':
                return $this->exportConformites($request, $format);
            case 'tous':
                return $this->exportAll($request, $format);
            default:
                return redirect()->back()->with('error', 'Type d\'export non valide.');
        }
    }

    private function exportDocuments(ExportJuridiqueRequest $request, $format)
    {
        $query = Document::with('typeDocument', 'createur');

        if ($request->date_debut) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        if ($request->date_fin) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        if ($request->statut) {
            $query->where('statut', $request->statut);
        }

        $documents = $query->get();

        $data = $documents->map(function($document) use ($request) {
            $row = [];
            foreach ($request->champs as $champ) {
                $row[$champ] = $this->getDocumentField($document, $champ);
            }
            return $row;
        });

        return $this->generateExport($data, 'documents', $format);
    }

    private function exportContrats(ExportJuridiqueRequest $request, $format)
    {
        $query = Contrat::with('document.typeDocument');

        if ($request->date_debut) {
            $query->whereDate('date_debut', '>=', $request->date_debut);
        }

        if ($request->date_fin) {
            $query->whereDate('date_fin', '<=', $request->date_fin);
        }

        $contrats = $query->get();

        $data = $contrats->map(function($contrat) use ($request) {
            $row = [];
            foreach ($request->champs as $champ) {
                $row[$champ] = $this->getContratField($contrat, $champ);
            }
            return $row;
        });

        return $this->generateExport($data, 'contrats', $format);
    }

    private function exportLitiges(ExportJuridiqueRequest $request, $format)
    {
        $query = Litige::query();

        if ($request->date_debut) {
            $query->whereDate('date_ouverture', '>=', $request->date_debut);
        }

        if ($request->date_fin) {
            $query->whereDate('date_ouverture', '<=', $request->date_fin);
        }

        if ($request->statut) {
            $query->where('statut', $request->statut);
        }

        $litiges = $query->get();

        $data = $litiges->map(function($litige) use ($request) {
            $row = [];
            foreach ($request->champs as $champ) {
                $row[$champ] = $this->getLitigeField($litige, $champ);
            }
            return $row;
        });

        return $this->generateExport($data, 'litiges', $format);
    }

    private function exportLegalites(ExportJuridiqueRequest $request, $format)
    {
        $query = Legalite::query();

        if ($request->date_debut) {
            $query->whereDate('date_publication', '>=', $request->date_debut);
        }

        if ($request->date_fin) {
            $query->whereDate('date_publication', '<=', $request->date_fin);
        }

        $legalites = $query->get();

        $data = $legalites->map(function($legalite) use ($request) {
            $row = [];
            foreach ($request->champs as $champ) {
                $row[$champ] = $this->getLegaliteField($legalite, $champ);
            }
            return $row;
        });

        return $this->generateExport($data, 'legalites', $format);
    }

    private function exportConseils(ExportJuridiqueRequest $request, $format)
    {
        $query = ConseilJuridique::where('is_published', true);

        if ($request->categorie) {
            $query->where('categorie', $request->categorie);
        }

        $conseils = $query->get();

        $data = $conseils->map(function($conseil) use ($request) {
            $row = [];
            foreach ($request->champs as $champ) {
                $row[$champ] = $this->getConseilField($conseil, $champ);
            }
            return $row;
        });

        return $this->generateExport($data, 'conseils', $format);
    }

    private function exportConformites(ExportJuridiqueRequest $request, $format)
    {
        $query = Conformite::with('legalite');

        if ($request->statut) {
            $query->where('statut', $request->statut);
        }

        $conformites = $query->get();

        $data = $conformites->map(function($conformite) use ($request) {
            $row = [];
            foreach ($request->champs as $champ) {
                $row[$champ] = $this->getConformiteField($conformite, $champ);
            }
            return $row;
        });

        return $this->generateExport($data, 'conformites', $format);
    }

    private function exportAll(ExportJuridiqueRequest $request, $format)
    {
        $allData = [
            'documents' => $this->getDocumentsData($request),
            'contrats' => $this->getContratsData($request),
            'litiges' => $this->getLitigesData($request),
            'legalites' => $this->getLegalitesData($request),
            'conformites' => $this->getConformitesData($request)
        ];

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('back.juridique.exports.all', compact('allData'));
            return $pdf->download('export_complet_' . date('Y-m-d_His') . '.pdf');
        }

        // Export Excel multiple feuilles
        return $this->generateMultiSheetExcel($allData);
    }

    private function generateExport($data, $name, $format)
    {
        if ($format === 'csv') {
            return $this->generateCSV($data, $name);
        } elseif ($format === 'pdf') {
            return $this->generatePDF($data, $name);
        } elseif ($format === 'excel') {
            return $this->generateExcel($data, $name);
        }
    }

    private function generateCSV($data, $name)
    {
        $filename = "export_{$name}_" . date('Y-m-d_His') . '.csv';
        $handle = fopen('php://temp', 'w+');

        if ($data->isNotEmpty()) {
            fputcsv($handle, array_keys($data->first()));
        }

        foreach ($data as $row) {
            fputcsv($handle, array_values($row));
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return response($content, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }

    private function generatePDF($data, $name)
    {
        $pdf = Pdf::loadView('back.juridique.exports.' . $name, compact('data'));
        return $pdf->download("export_{$name}_" . date('Y-m-d_His') . '.pdf');
    }

    private function generateExcel($data, $name)
    {
        // Utilisation de Laravel Excel ou autre package
        // Exemple avec Maatwebsite\Excel
        return (new \App\Exports\ArrayExport($data))->download("export_{$name}_" . date('Y-m-d_His') . '.xlsx');
    }

    private function getDocumentField($document, $field)
    {
        $fields = [
            'id' => $document->id,
            'numero_unique' => $document->numero_unique,
            'titre' => $document->titre,
            'type' => $document->typeDocument->nom,
            'statut' => $document->statut_label,
            'created_at' => $document->created_at->format('d/m/Y H:i'),
            'date_effet' => $document->date_effet ? $document->date_effet->format('d/m/Y') : '',
            'date_expiration' => $document->date_expiration ? $document->date_expiration->format('d/m/Y') : '',
            'cree_par' => $document->createur->name,
        ];
        return $fields[$field] ?? '';
    }

    private function getContratField($contrat, $field)
    {
        $fields = [
            'id' => $contrat->id,
            'reference' => $contrat->reference,
            'type' => $contrat->type_contrat_label,
            'date_debut' => $contrat->date_debut->format('d/m/Y'),
            'date_fin' => $contrat->date_fin ? $contrat->date_fin->format('d/m/Y') : 'Indéterminée',
            'montant' => $contrat->montant ? number_format($contrat->montant, 2) . ' ' . $contrat->devise : '',
            'document_titre' => $contrat->document->titre,
        ];
        return $fields[$field] ?? '';
    }

    private function getLitigeField($litige, $field)
    {
        $fields = [
            'id' => $litige->id,
            'reference' => $litige->reference,
            'titre' => $litige->titre,
            'type' => $litige->type_label,
            'statut' => $litige->statut_label,
            'date_ouverture' => $litige->date_ouverture->format('d/m/Y'),
            'montant_en_jeu' => $litige->montant_en_jeu ? number_format($litige->montant_en_jeu, 2) . ' EUR' : '',
        ];
        return $fields[$field] ?? '';
    }

    private function getLegaliteField($legalite, $field)
    {
        $fields = [
            'id' => $legalite->id,
            'titre' => $legalite->titre,
            'type' => $legalite->type_label,
            'reference' => $legalite->reference,
            'date_publication' => $legalite->date_publication ? $legalite->date_publication->format('d/m/Y') : '',
            'est_en_vigueur' => $legalite->est_en_vigueur ? 'Oui' : 'Non',
        ];
        return $fields[$field] ?? '';
    }

    private function getConseilField($conseil, $field)
    {
        $fields = [
            'id' => $conseil->id,
            'titre' => $conseil->titre,
            'categorie' => $conseil->categorie_label,
            'vues' => $conseil->vues,
            'created_at' => $conseil->created_at->format('d/m/Y'),
        ];
        return $fields[$field] ?? '';
    }

    private function getConformiteField($conformite, $field)
    {
        $fields = [
            'id' => $conformite->id,
            'legalite' => $conformite->legalite->titre,
            'statut' => $conformite->statut_label,
            'score' => $conformite->score_conformite ? $conformite->score_conformite . '%' : '',
            'date_controle' => $conformite->date_controle ? $conformite->date_controle->format('d/m/Y') : '',
        ];
        return $fields[$field] ?? '';
    }

    private function getDocumentsData($request)
    {
        $query = Document::query();
        if ($request->date_debut) $query->whereDate('created_at', '>=', $request->date_debut);
        if ($request->date_fin) $query->whereDate('created_at', '<=', $request->date_fin);
        return $query->get()->map(fn($d) => [
            'ID' => $d->id,
            'Numéro' => $d->numero_unique,
            'Titre' => $d->titre,
            'Type' => $d->typeDocument->nom,
            'Statut' => $d->statut_label,
            'Date' => $d->created_at->format('d/m/Y')
        ]);
    }

    private function getContratsData($request)
    {
        $query = Contrat::query();
        if ($request->date_debut) $query->whereDate('date_debut', '>=', $request->date_debut);
        if ($request->date_fin) $query->whereDate('date_fin', '<=', $request->date_fin);
        return $query->get()->map(fn($c) => [
            'ID' => $c->id,
            'Référence' => $c->reference,
            'Type' => $c->type_contrat_label,
            'Début' => $c->date_debut->format('d/m/Y'),
            'Fin' => $c->date_fin ? $c->date_fin->format('d/m/Y') : 'Indéterminée',
            'Montant' => $c->montant ? number_format($c->montant, 2) . ' ' . $c->devise : ''
        ]);
    }

    private function getLitigesData($request)
    {
        $query = Litige::query();
        if ($request->date_debut) $query->whereDate('date_ouverture', '>=', $request->date_debut);
        if ($request->date_fin) $query->whereDate('date_ouverture', '<=', $request->date_fin);
        return $query->get()->map(fn($l) => [
            'ID' => $l->id,
            'Référence' => $l->reference,
            'Titre' => $l->titre,
            'Type' => $l->type_label,
            'Statut' => $l->statut_label,
            'Ouverture' => $l->date_ouverture->format('d/m/Y')
        ]);
    }

    private function getLegalitesData($request)
    {
        $query = Legalite::query();
        if ($request->date_debut) $query->whereDate('date_publication', '>=', $request->date_debut);
        if ($request->date_fin) $query->whereDate('date_publication', '<=', $request->date_fin);
        return $query->get()->map(fn($l) => [
            'ID' => $l->id,
            'Titre' => $l->titre,
            'Type' => $l->type_label,
            'Référence' => $l->reference,
            'Publication' => $l->date_publication ? $l->date_publication->format('d/m/Y') : '',
            'Vigueur' => $l->est_en_vigueur ? 'Oui' : 'Non'
        ]);
    }

    private function getConformitesData($request)
    {
        $query = Conformite::query();
        if ($request->statut) $query->where('statut', $request->statut);
        return $query->get()->map(fn($c) => [
            'ID' => $c->id,
            'Texte légal' => $c->legalite->titre,
            'Statut' => $c->statut_label,
            'Score' => $c->score_conformite ? $c->score_conformite . '%' : '',
            'Contrôle' => $c->date_controle ? $c->date_controle->format('d/m/Y') : ''
        ]);
    }

    private function generateMultiSheetExcel($data)
    {
        // À implémenter avec un package comme Maatwebsite\Excel
        // Retourne un fichier Excel avec plusieurs feuilles
        return redirect()->back()->with('info', 'Export multi-feuilles à implémenter.');
    }
}
