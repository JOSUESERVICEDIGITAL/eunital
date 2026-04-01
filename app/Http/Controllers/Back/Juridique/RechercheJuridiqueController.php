<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\RechercheJuridiqueRequest;
use App\Models\Juridique\Document;
use App\Models\Juridique\Contrat;
use App\Models\Juridique\Litige;
use App\Models\Juridique\Legalite;
use App\Models\Juridique\ConseilJuridique;
use Illuminate\Http\Request;

class RechercheJuridiqueController extends Controller
{
    public function index(RechercheJuridiqueRequest $request)
    {
        $resultats = [];

        if ($request->q) {
            $query = $request->q;
            $type = $request->type;

            switch ($type) {
                case 'document':
                    $resultats = $this->rechercherDocuments($request);
                    break;
                case 'contrat':
                    $resultats = $this->rechercherContrats($request);
                    break;
                case 'litige':
                    $resultats = $this->rechercherLitiges($request);
                    break;
                case 'legalite':
                    $resultats = $this->rechercherLegalites($request);
                    break;
                case 'conseil':
                    $resultats = $this->rechercherConseils($request);
                    break;
                default:
                    $resultats = $this->rechercherGlobal($request);
                    break;
            }
        }

        $types = [
            'document' => 'Documents',
            'contrat' => 'Contrats',
            'litige' => 'Litiges',
            'legalite' => 'Textes légaux',
            'conseil' => 'Conseils juridiques',
            'tout' => 'Tous'
        ];

        return view('back.juridique.recherche.index', compact('resultats', 'types', 'request'));
    }

    private function rechercherDocuments(RechercheJuridiqueRequest $request)
    {
        $query = Document::with('typeDocument');

        if ($request->q) {
            $query->where(function($q) use ($request) {
                $q->where('titre', 'LIKE', "%{$request->q}%")
                  ->orWhere('numero_unique', 'LIKE', "%{$request->q}%")
                  ->orWhere('description', 'LIKE', "%{$request->q}%");
            });
        }

        if ($request->categorie) {
            $query->whereHas('typeDocument', function($q) use ($request) {
                $q->where('categorie', $request->categorie);
            });
        }

        if ($request->statut) {
            $query->where('statut', $request->statut);
        }

        if ($request->date_debut && $request->date_fin) {
            $query->whereBetween('created_at', [$request->date_debut, $request->date_fin]);
        }

        $query->orderBy($request->order_by, $request->order_dir);

        return $query->paginate($request->per_page);
    }

    private function rechercherContrats(RechercheJuridiqueRequest $request)
    {
        $query = Contrat::with('document');

        if ($request->q) {
            $query->where(function($q) use ($request) {
                $q->where('reference', 'LIKE', "%{$request->q}%")
                  ->orWhere('objet', 'LIKE', "%{$request->q}%");
            });
        }

        if ($request->categorie) {
            $query->where('type_contrat', $request->categorie);
        }

        if ($request->date_debut && $request->date_fin) {
            $query->whereBetween('date_debut', [$request->date_debut, $request->date_fin]);
        }

        $query->orderBy($request->order_by, $request->order_dir);

        return $query->paginate($request->per_page);
    }

    private function rechercherLitiges(RechercheJuridiqueRequest $request)
    {
        $query = Litige::query();

        if ($request->q) {
            $query->where(function($q) use ($request) {
                $q->where('titre', 'LIKE', "%{$request->q}%")
                  ->orWhere('reference', 'LIKE', "%{$request->q}%")
                  ->orWhere('description', 'LIKE', "%{$request->q}%");
            });
        }

        if ($request->categorie) {
            $query->where('type', $request->categorie);
        }

        if ($request->statut) {
            $query->where('statut', $request->statut);
        }

        if ($request->date_debut && $request->date_fin) {
            $query->whereBetween('date_ouverture', [$request->date_debut, $request->date_fin]);
        }

        $query->orderBy($request->order_by, $request->order_dir);

        return $query->paginate($request->per_page);
    }

    private function rechercherLegalites(RechercheJuridiqueRequest $request)
    {
        $query = Legalite::query();

        if ($request->q) {
            $query->where(function($q) use ($request) {
                $q->where('titre', 'LIKE', "%{$request->q}%")
                  ->orWhere('reference', 'LIKE', "%{$request->q}%")
                  ->orWhere('resume', 'LIKE', "%{$request->q}%");
            });
        }

        if ($request->categorie) {
            $query->where('type', $request->categorie);
        }

        if ($request->date_debut && $request->date_fin) {
            $query->whereBetween('date_publication', [$request->date_debut, $request->date_fin]);
        }

        $query->orderBy($request->order_by, $request->order_dir);

        return $query->paginate($request->per_page);
    }

    private function rechercherConseils(RechercheJuridiqueRequest $request)
    {
        $query = ConseilJuridique::where('is_published', true);

        if ($request->q) {
            $query->where(function($q) use ($request) {
                $q->where('titre', 'LIKE', "%{$request->q}%")
                  ->orWhere('contenu', 'LIKE', "%{$request->q}%");
            });
        }

        if ($request->categorie) {
            $query->where('categorie', $request->categorie);
        }

        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $query->whereJsonContains('tags', $tag);
            }
        }

        $query->orderBy($request->order_by, $request->order_dir);

        return $query->paginate($request->per_page);
    }

    private function rechercherGlobal(RechercheJuridiqueRequest $request)
    {
        return [
            'documents' => $this->rechercherDocuments($request)->items(),
            'contrats' => $this->rechercherContrats($request)->items(),
            'litiges' => $this->rechercherLitiges($request)->items(),
            'legalites' => $this->rechercherLegalites($request)->items(),
            'conseils' => $this->rechercherConseils($request)->items(),
        ];
    }

    public function autocomplete(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:2',
            'type' => 'nullable|in:document,contrat,litige,legalite,conseil'
        ]);

        $type = $request->type;
        $query = $request->q;
        $results = [];

        if ($type === 'document' || !$type) {
            $documents = Document::where('titre', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get()
                ->map(fn($d) => ['type' => 'document', 'id' => $d->id, 'titre' => $d->titre, 'numero' => $d->numero_unique]);
            $results = array_merge($results, $documents->toArray());
        }

        if ($type === 'contrat' || !$type) {
            $contrats = Contrat::where('reference', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get()
                ->map(fn($c) => ['type' => 'contrat', 'id' => $c->id, 'reference' => $c->reference]);
            $results = array_merge($results, $contrats->toArray());
        }

        if ($type === 'litige' || !$type) {
            $litiges = Litige::where('titre', 'LIKE', "%{$query}%")
                ->orWhere('reference', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get()
                ->map(fn($l) => ['type' => 'litige', 'id' => $l->id, 'titre' => $l->titre, 'reference' => $l->reference]);
            $results = array_merge($results, $litiges->toArray());
        }

        if ($type === 'legalite' || !$type) {
            $legalites = Legalite::where('titre', 'LIKE', "%{$query}%")
                ->orWhere('reference', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get()
                ->map(fn($l) => ['type' => 'legalite', 'id' => $l->id, 'titre' => $l->titre]);
            $results = array_merge($results, $legalites->toArray());
        }

        if ($type === 'conseil' || !$type) {
            $conseils = ConseilJuridique::where('titre', 'LIKE', "%{$query}%")
                ->where('is_published', true)
                ->limit(5)
                ->get()
                ->map(fn($c) => ['type' => 'conseil', 'id' => $c->id, 'titre' => $c->titre]);
            $results = array_merge($results, $conseils->toArray());
        }

        return response()->json([
            'success' => true,
            'results' => $results
        ]);
    }
}
