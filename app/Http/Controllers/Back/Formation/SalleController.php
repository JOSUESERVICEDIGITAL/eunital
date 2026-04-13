<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Models\Formation\Salle;
use App\Models\Formation\Cour;
use App\Models\Formation\Module;
use App\Models\Formation\AccesSalle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SalleController extends Controller
{
    /**
     * Afficher la liste des salles
     */
    public function index()
    {
        $salles = Salle::with(['cour', 'module', 'createur', 'accesSalle'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $stats = [
            'total' => Salle::count(),
            'ouvertes' => Salle::where('is_active', true)->where('is_open', true)->count(),
            'fermees' => Salle::where('is_active', true)->where('is_open', false)->count(),
            'inactives' => Salle::where('is_active', false)->count(),
        ];

        return view('back.formation.salles.index', compact('salles', 'stats'));
    }

    /**
     * Formulaire de création d'une salle
     */
    public function create()
    {
        $cours = Cour::where('is_published', true)->orderBy('titre')->get();
        $modules = Module::where('is_active', true)->orderBy('titre')->get();
        $accesSalles = AccesSalle::actifs()->get();

        return view('back.formation.salles.create', compact('cours', 'modules', 'accesSalles'));
    }

    /**
     * Enregistrer une nouvelle salle
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cour_id' => 'nullable|exists:cours,id',
            'module_id' => 'nullable|exists:modules,id',
            'acces_salle_id' => 'nullable|exists:acces_salles,id',
            'type_salle' => 'required|in:presentiel,distance,hybride',
            'is_active' => 'nullable|boolean',
            'is_open' => 'nullable|boolean',
            'image_couverture' => 'nullable|image|max:2048',
            'parametres' => 'nullable|array',
        ]);

        $data = $request->all();
        $data['created_by'] = auth()->id();
        $data['slug'] = Str::slug($request->titre);

        // Gestion de l'image
        if ($request->hasFile('image_couverture')) {
            $path = $request->file('image_couverture')->store('salles', 'public');
            $data['image_couverture'] = $path;
        }

        // Valeurs par défaut
        $data['is_active'] = $request->has('is_active');
        $data['is_open'] = $request->has('is_open');

        $salle = Salle::create($data);

        // Si un code d'accès est associé, mettre à jour la référence
        if ($request->acces_salle_id) {
            $accesSalle = AccesSalle::find($request->acces_salle_id);
            if ($accesSalle && !$accesSalle->salle) {
                // Le code d'accès est maintenant lié à cette salle
            }
        }

        return redirect()
            ->route('back.formation.salles.show', $salle)
            ->with('success', 'Salle créée avec succès.');
    }

    /**
     * Afficher les détails d'une salle
     */
       /**
 * Afficher une salle avec vérification d'accès
 */
public function show(Salle $salle)
{
    // Vérifier que l'utilisateur a accès à cette salle
    if ($salle->accesSalle) {
        $acces = $salle->accesSalle;

        // Vérifier si l'utilisateur est dans la liste des actifs
        if (auth()->check()) {
            $utilisateursActifs = $acces->utilisateurs_actifs ?? [];
            if (!in_array(auth()->id(), $utilisateursActifs)) {
                // Ajouter l'utilisateur automatiquement
                $acces->ajouterUtilisateur(auth()->id());
                $this->enregistrerPresence(auth()->id(), $acces->cour_id, $acces->code_acces);
            }
        }
    }

    $salle->load(['cour', 'module', 'createur', 'accesSalle']);

    // Récupérer les statistiques de la salle
    $stats = [
        'nb_utilisateurs' => $salle->accesSalle ? $salle->accesSalle->nb_utilisateurs_actifs : 0,
        'places_restantes' => $salle->accesSalle ? $salle->accesSalle->places_restantes : null,
        'code_acces' => $salle->accesSalle ? $salle->accesSalle->code_acces : null,
        'code_expire_le' => $salle->accesSalle ? $salle->accesSalle->expires_at : null,
    ];

    return view('back.formation.salles.show', compact('salle', 'stats'));
}

    /**
     * Formulaire de modification d'une salle
     */
    public function edit(Salle $salle)
    {
        $cours = Cour::where('is_published', true)->orderBy('titre')->get();
        $modules = Module::where('is_active', true)->orderBy('titre')->get();
        $accesSalles = AccesSalle::actifs()->get();

        return view('back.formation.salles.edit', compact('salle', 'cours', 'modules', 'accesSalles'));
    }

    /**
     * Mettre à jour une salle
     */
    public function update(Request $request, Salle $salle)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cour_id' => 'nullable|exists:cours,id',
            'module_id' => 'nullable|exists:modules,id',
            'acces_salle_id' => 'nullable|exists:acces_salles,id',
            'type_salle' => 'required|in:presentiel,distance,hybride',
            'is_active' => 'nullable|boolean',
            'is_open' => 'nullable|boolean',
            'image_couverture' => 'nullable|image|max:2048',
            'parametres' => 'nullable|array',
        ]);

        $data = $request->all();

        // Gestion de l'image
        if ($request->hasFile('image_couverture')) {
            if ($salle->image_couverture) {
                \Storage::disk('public')->delete($salle->image_couverture);
            }
            $path = $request->file('image_couverture')->store('salles', 'public');
            $data['image_couverture'] = $path;
        }

        // Mise à jour du slug si le titre change
        if ($salle->titre !== $request->titre) {
            $data['slug'] = Str::slug($request->titre);
        }

        $data['is_active'] = $request->has('is_active');
        $data['is_open'] = $request->has('is_open');

        $salle->update($data);

        return redirect()
            ->route('back.formation.salles.show', $salle)
            ->with('success', 'Salle mise à jour avec succès.');
    }

    /**
     * Supprimer une salle
     */
    public function destroy(Salle $salle)
    {
        // Supprimer l'image
        if ($salle->image_couverture) {
            \Storage::disk('public')->delete($salle->image_couverture);
        }

        $salle->delete();

        return redirect()
            ->route('back.formation.salles.index')
            ->with('success', 'Salle supprimée avec succès.');
    }

    /**
     * Ouvrir une salle
     */
    public function ouvrir(Salle $salle)
    {
        $salle->update(['is_open' => true]);

        return redirect()
            ->back()
            ->with('success', 'La salle a été ouverte avec succès.');
    }

    /**
     * Fermer une salle
     */
    public function fermer(Salle $salle)
    {
        $salle->update(['is_open' => false]);

        return redirect()
            ->back()
            ->with('success', 'La salle a été fermée avec succès.');
    }

    /**
     * Activer une salle
     */
    public function activer(Salle $salle)
    {
        $salle->update(['is_active' => true]);

        return redirect()
            ->back()
            ->with('success', 'La salle a été activée avec succès.');
    }

    /**
     * Désactiver une salle
     */
    public function desactiver(Salle $salle)
    {
        $salle->update(['is_active' => false]);

        return redirect()
            ->back()
            ->with('success', 'La salle a été désactivée avec succès.');
    }

    /**
     * Afficher le formulaire d'accès par code
     */
    public function accederForm(Request $request)
    {
        $cour_id = $request->get('cour', null);
        return view('back.formation.salles.acceder', compact('cour_id'));
    }

    /**
     * Accéder à une salle par code
     */
    public function accederParCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'cour_id' => 'nullable|exists:cours,id',
        ]);

        $query = AccesSalle::actifs()->where('code_acces', $request->code);

        if ($request->cour_id) {
            $query->where('cour_id', $request->cour_id);
        }

        $acces = $query->first();

        if (!$acces) {
            return back()
                ->withInput()
                ->with('error', 'Code invalide ou expiré. Veuillez vérifier votre code.');
        }

        // Vérifier la limite d'utilisateurs
        if ($acces->limiteAtteinte()) {
            return back()
                ->withInput()
                ->with('error', 'La salle a atteint sa capacité maximale.');
        }

        // Récupérer la salle liée
        $salle = $acces->salle;

        if (!$salle) {
            return back()
                ->withInput()
                ->with('error', 'Aucune salle n\'est associée à ce code.');
        }

        if (!$salle->is_active) {
            return back()
                ->withInput()
                ->with('error', 'Cette salle est actuellement inactive.');
        }

        // Ajouter l'utilisateur si connecté
        if (auth()->check()) {
            $acces->ajouterUtilisateur(auth()->id());

            // Enregistrer la présence
            $this->enregistrerPresence(auth()->id(), $acces->cour_id, $acces->code_acces);
        }

        return redirect()
            ->route('back.formation.salles.show', $salle)
            ->with('success', 'Accès autorisé ! Bienvenue dans la salle.');
    }

    /**
     * Enregistrer la présence d'un utilisateur
     */
    private function enregistrerPresence($userId, $courId, $code)
    {
        $inscription = \App\Models\Formation\Inscription::where('user_id', $userId)
            ->whereHas('module.cours', function($q) use ($courId) {
                $q->where('id', $courId);
            })
            ->first();

        if ($inscription) {
            \App\Models\Formation\Presence::updateOrCreate(
                [
                    'inscription_id' => $inscription->id,
                    'cour_id' => $courId,
                    'date_debut' => now()->toDateString()
                ],
                [
                    'date_debut' => now(),
                    'present' => true,
                    'code_acces' => $code,
                    'statut' => 'present'
                ]
            );
        }
    }

    /**
     * Dupliquer une salle
     */
    public function dupliquer(Salle $salle)
    {
        $newSalle = $salle->replicate();
        $newSalle->titre = $salle->titre . ' (Copie)';
        $newSalle->slug = Str::slug($newSalle->titre);
        $newSalle->created_by = auth()->id();
        $newSalle->is_open = false;
        $newSalle->save();

        return redirect()
            ->route('back.formation.salles.edit', $newSalle)
            ->with('success', 'Salle dupliquée avec succès. Vous pouvez maintenant la modifier.');
    }





}
