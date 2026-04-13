<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Models\Formation\AccesSalle;
use App\Models\Formation\Salle;
use App\Models\Formation\Cour;
use App\Models\Formation\Presence;
use App\Models\Formation\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AccesSalleController extends Controller
{
    /**
     * Afficher la liste des codes d'accès
     */
    public function index()
    {
        $acces = AccesSalle::with('cour', 'salle')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.formation.acces-salles.index', compact('acces'));
    }

    /**
     * Formulaire de création d'un code d'accès
     */
    public function create()
    {
        $cours = Cour::where('is_published', true)->get();
        return view('back.formation.acces-salles.create', compact('cours'));
    }

    /**
     * Enregistrer un nouveau code d'accès
     */
    public function store(Request $request)
    {
        $request->validate([
            'cour_id' => 'required|exists:cours,id',
            'code_acces' => 'nullable|string|max:255',
            'expires_at' => 'nullable|date|after:now',
            'max_utilisateurs' => 'nullable|integer|min:1',
        ]);

        // Générer un code unique si non fourni
        $code = $request->code_acces ?? strtoupper(Str::random(8));

        // Vérifier l'unicité du code
        while (AccesSalle::where('code_acces', $code)->exists()) {
            $code = strtoupper(Str::random(8));
        }

        $acces = AccesSalle::create([
            'cour_id' => $request->cour_id,
            'code_acces' => $code,
            'generated_at' => now(),
            'expires_at' => $request->expires_at,
            'is_active' => true,
            'max_utilisateurs' => $request->max_utilisateurs,
            'utilisateurs_actifs' => [],
            'utilisateurs_connexion' => [],
        ]);

        return redirect()
            ->route('back.formation.acces-salles.show', $acces)
            ->with('success', 'Code d\'accès généré avec succès : ' . $code);
    }

    /**
     * Afficher les détails d'un code d'accès
     */
    public function show(AccesSalle $accesSalle)
    {
        $accesSalle->load(['cour', 'salle']);
        $users = $accesSalle->utilisateursConnectes();

        return view('back.formation.acces-salles.show', compact('accesSalle', 'users'));
    }

    /**
     * Formulaire de modification
     */
    public function edit(AccesSalle $accesSalle)
    {
        $cours = Cour::where('is_published', true)->get();
        return view('back.formation.acces-salles.edit', compact('accesSalle', 'cours'));
    }

    /**
     * Mettre à jour un code d'accès
     */
    public function update(Request $request, AccesSalle $accesSalle)
    {
        $request->validate([
            'cour_id' => 'required|exists:cours,id',
            'code_acces' => 'required|string|max:255|unique:acces_salles,code_acces,' . $accesSalle->id,
            'expires_at' => 'nullable|date',
            'max_utilisateurs' => 'nullable|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        $accesSalle->update($request->all());

        return redirect()
            ->route('back.formation.acces-salles.show', $accesSalle)
            ->with('success', 'Code d\'accès mis à jour avec succès.');
    }

    /**
     * Supprimer un code d'accès
     */
    public function destroy(AccesSalle $accesSalle)
    {
        // Dissocier la salle si elle existe
        if ($accesSalle->salle) {
            $accesSalle->salle->update(['acces_salle_id' => null]);
        }

        $accesSalle->delete();

        return redirect()
            ->route('back.formation.acces-salles.index')
            ->with('success', 'Code d\'accès supprimé avec succès.');
    }

    /**
     * Désactiver un code d'accès
     */
    public function desactiver(AccesSalle $accesSalle)
    {
        $accesSalle->update(['is_active' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Code d\'accès désactivé'
        ]);
    }

    /**
     * Activer un code d'accès
     */
    public function activer(AccesSalle $accesSalle)
    {
        $accesSalle->update(['is_active' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Code d\'accès activé'
        ]);
    }

    /**
     * Déconnecter un utilisateur
     */
    public function deconnecterUtilisateur(AccesSalle $accesSalle, $userId)
    {
        $accesSalle->retirerUtilisateur((int) $userId);

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur déconnecté'
        ]);
    }

    /**
     * Générer un nouveau code pour un cours
     */
    public function genererNouveauCode(Cour $cour)
    {
        // Désactiver l'ancien code s'il existe
        AccesSalle::where('cour_id', $cour->id)->update(['is_active' => false]);

        // Générer un nouveau code unique
        $code = strtoupper(Str::random(8));
        while (AccesSalle::where('code_acces', $code)->exists()) {
            $code = strtoupper(Str::random(8));
        }

        $acces = AccesSalle::create([
            'cour_id' => $cour->id,
            'code_acces' => $code,
            'generated_at' => now(),
            'expires_at' => now()->addHours(2),
            'is_active' => true,
            'utilisateurs_actifs' => [],
            'utilisateurs_connexion' => [],
        ]);

        return response()->json([
            'success' => true,
            'code' => $acces->code_acces,
            'expires_at' => $acces->expires_at
        ]);
    }

    /**
     * Vérification du code via POST (formulaire)
     */
    public function verifierCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'cour_id' => 'required|exists:cours,id',
        ]);

        $acces = AccesSalle::actifs()
            ->where('cour_id', $request->cour_id)
            ->where('code_acces', $request->code)
            ->first();

        if (!$acces) {
            return response()->json([
                'success' => false,
                'valide' => false,
                'message' => 'Code invalide ou expiré.'
            ], 404);
        }

        if ($acces->limiteAtteinte()) {
            return response()->json([
                'success' => false,
                'valide' => false,
                'message' => 'La salle a atteint sa capacité maximale.'
            ], 429);
        }

        if ($request->filled('user_id')) {
            $acces->ajouterUtilisateur((int) $request->user_id);
        }

        $salle = $acces->salle;

        return response()->json([
            'success' => true,
            'valide' => true,
            'message' => 'Accès autorisé.',
            'acces' => $acces,
            'salle' => $salle,
            'redirect_url' => $salle
                ? route('back.formation.salles.show', $salle)
                : route('back.formation.cours.show', $request->cour_id)
        ]);
    }

    /**
     * Vérification du code via GET (pour QR code - PUBLIC)
     *//**
 * Vérification du code via GET (pour QR code - PUBLIC)
 */
/**
 * Vérification du code via GET (pour QR code - PUBLIC)
 * Cette méthode doit fonctionner exactement comme accederParCode
 */
public function verifierCodeGet(Request $request)
{
    $request->validate([
        'code' => 'required|string',
        'cour' => 'required|exists:cours,id',
    ]);

    $code = strtoupper(trim($request->code));
    
    \Log::info('QR Code scanné', ['code' => $code, 'cour_id' => $request->cour]);

    // Rechercher le code d'accès (comme dans accederParCode)
    $acces = AccesSalle::where('code_acces', $code)
        ->where('cour_id', $request->cour)
        ->where('is_active', true)
        ->where(function ($query) {
            $query->whereNull('expires_at')->orWhere('expires_at', '>', now());
        })
        ->first();

    if (!$acces) {
        \Log::warning('QR Code invalide', ['code' => $code]);
        return view('back.formation.acces-salles.acces-refuse', [
            'message' => 'Code invalide ou expiré. Veuillez contacter votre formateur.',
            'code' => $code,
            'cour_id' => $request->cour
        ]);
    }

    // Vérifier la limite d'utilisateurs
    if ($acces->limiteAtteinte()) {
        return view('back.formation.acces-salles.acces-refuse', [
            'message' => 'La salle a atteint sa capacité maximale.',
            'code' => $code,
            'cour_id' => $request->cour
        ]);
    }

    // Récupérer la salle liée
    $salle = $acces->salle;

    if (!$salle) {
        return view('back.formation.acces-salles.acces-refuse', [
            'message' => 'Aucune salle n\'est associée à ce code.',
            'code' => $code,
            'cour_id' => $request->cour
        ]);
    }

    if (!$salle->is_active) {
        return view('back.formation.acces-salles.acces-refuse', [
            'message' => 'Cette salle est actuellement inactive.',
            'code' => $code,
            'cour_id' => $request->cour
        ]);
    }

    // Ajouter l'utilisateur si connecté (comme dans accederParCode)
    if (auth()->check()) {
        $acces->ajouterUtilisateur(auth()->id());
        
        // Enregistrer la présence
        $this->enregistrerPresence(auth()->id(), $acces->cour_id, $acces->code_acces);
        
        // Rediriger vers la salle
        return redirect()
            ->route('back.formation.salles.show', $salle)
            ->with('success', 'Accès autorisé ! Bienvenue dans la salle « ' . $salle->titre . ' ».');
    }
    
    // Utilisateur non connecté - stocker l'URL pour redirection après login
    session(['url.intended' => route('back.formation.salles.show', $salle)]);
    session(['qr_code_verified' => true]);
    
    return redirect()->route('login')->with('warning', 'Veuillez vous connecter pour accéder à la salle.');
}
/**
 * Créer automatiquement une salle pour un code d'accès
 */
private function creerSallePourAcces(AccesSalle $acces)
{
    $cour = $acces->cour;

    $salle = Salle::create([
        'titre' => 'Salle - ' . ($cour->titre ?? 'Cours'),
        'slug' => 'salle-' . Str::slug($cour->titre ?? 'cours') . '-' . Str::random(5),
        'description' => 'Salle générée automatiquement pour le cours : ' . ($cour->titre ?? 'N/A'),
        'cour_id' => $acces->cour_id,
        'acces_salle_id' => $acces->id,
        'type_salle' => 'distance',
        'is_active' => true,
        'is_open' => true,
        'created_by' => $cour->created_by ?? 1,
        'parametres' => [
            'chat_active' => true,
            'documents_visibles' => true,
            'videos_visibles' => true,
            'devoirs_visibles' => true,
            'tutoriels_visibles' => true,
            'telechargement_autorise' => true
        ]
    ]);

    return $salle;
}
    /**
     * Enregistrer la présence d'un utilisateur
     */
    private function enregistrerPresence($userId, $courId, $code)
    {
        $inscription = Inscription::where('user_id', $userId)
            ->whereHas('module.cours', function($q) use ($courId) {
                $q->where('id', $courId);
            })
            ->first();

        if ($inscription) {
            // Vérifier si une présence existe déjà aujourd'hui
            $existingPresence = Presence::where('inscription_id', $inscription->id)
                ->where('cour_id', $courId)
                ->whereDate('date_debut', now()->toDateString())
                ->first();

            if (!$existingPresence) {
                Presence::create([
                    'inscription_id' => $inscription->id,
                    'cour_id' => $courId,
                    'date_debut' => now(),
                    'present' => true,
                    'code_acces' => $code,
                    'statut' => 'present'
                ]);
            }
        }
    }

    /**
     * Réordonner les codes d'accès (si nécessaire)
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'acces' => 'required|array',
            'acces.*.id' => 'exists:acces_salles,id',
            'acces.*.ordre' => 'integer|min:0'
        ]);

        foreach ($request->acces as $accesData) {
            AccesSalle::where('id', $accesData['id'])->update(['ordre' => $accesData['ordre']]);
        }

        return response()->json(['success' => true]);
    }
}
