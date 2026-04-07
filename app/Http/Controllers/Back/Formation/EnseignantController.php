<?php

namespace App\Http\Controllers\Back\Formation;

use App\Http\Controllers\Controller;
use App\Models\Formation\Enseignant;
use App\Models\Formation\Cour;
use App\Models\User;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    public function index()
    {
        $enseignants = Enseignant::with('user', 'cours')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('back.formation.enseignants.index', compact('enseignants'));
    }

    public function actifs()
    {
        $enseignants = Enseignant::with('user', 'cours')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('back.formation.enseignants.index', compact('enseignants'));
    }

  // Dans le contrôleur create()
public function create()
{
    $existingEnseignantIds = Enseignant::pluck('user_id')->toArray();
    $users = User::whereNotIn('id', $existingEnseignantIds)->get();
    
    // Debug - vérifier qu'il y a des utilisateurs
    if ($users->isEmpty()) {
        // Créer un utilisateur de test si nécessaire
        $user = User::create([
            'name' => 'Test Enseignant',
            'email' => 'josueservicedigital@gmail.com',
            'password' => bcrypt('Josueservicedigital@gmail.com')
        ]);
        $users = User::whereNotIn('id', $existingEnseignantIds)->get();
    }
    
    return view('back.formation.enseignants.create', compact('users'));
}

public function store(Request $request)
{
    // Debug - voir ce qui est envoyé
    \Log::info('Données reçues:', $request->all());
    
    $data = $request->validate([
        'user_id' => 'required|exists:users,id|unique:enseignants,user_id',
        'specialite' => 'nullable|string|max:255',
        'biographie' => 'nullable|string',
        'diplome' => 'nullable|string',
        'annees_experience' => 'nullable|integer|min:0',
        'competences' => 'nullable|array',
        'competences.*' => 'nullable|string',
        'reseaux_sociaux' => 'nullable|array',
        'photo' => 'nullable|image|max:2048',
        'is_active' => 'nullable|boolean'
    ]);

    // Vérifier que user_id est présent
    if (!isset($data['user_id'])) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Veuillez sélectionner un utilisateur.');
    }

    // Traiter les compétences
    if (isset($data['competences'])) {
        $data['competences'] = json_encode(array_values($data['competences']));
    }

    // Traiter les réseaux sociaux
    if (isset($data['reseaux_sociaux']) && is_array($data['reseaux_sociaux'])) {
        $reseaux = [];
        foreach ($data['reseaux_sociaux'] as $reseau) {
            if (!empty($reseau['nom']) && !empty($reseau['url'])) {
                $reseaux[$reseau['nom']] = $reseau['url'];
            }
        }
        $data['reseaux_sociaux'] = !empty($reseaux) ? json_encode($reseaux) : null;
    }

    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('enseignants', 'public');
        $data['photo'] = $path;
    }

    // Définir les valeurs par défaut
    $data['is_active'] = $data['is_active'] ?? true;

    $enseignant = Enseignant::create($data);



    return redirect()
        ->route('back.formation.enseignants.show', $enseignant)
        ->with('success', 'Enseignant ajouté avec succès.');
}
    public function show(Enseignant $enseignant)
    {
        $enseignant->load('user', 'cours');
        return view('back.formation.enseignants.show', compact('enseignant'));
    }

    public function edit(Enseignant $enseignant)
    {
        return view('back.formation.enseignants.edit', compact('enseignant'));
    }

  public function update(Request $request, Enseignant $enseignant)
{
    $input = $request->all();

    $input['competences'] = $request->filled('competences')
        ? json_decode($request->competences, true)
        : null;

    $input['reseaux_sociaux'] = $request->filled('reseaux_sociaux')
        ? json_decode($request->reseaux_sociaux, true)
        : null;

    $data = validator($input, [
        'specialite' => 'nullable|string|max:255',
        'biographie' => 'nullable|string',
        'diplome' => 'nullable|string',
        'annees_experience' => 'nullable|integer|min:0',
        'competences' => 'nullable|array',
        'reseaux_sociaux' => 'nullable|array',
        'photo' => 'nullable|image|max:2048',
        'is_active' => 'nullable|boolean',
    ])->validate();

    if ($request->hasFile('photo')) {
        if ($enseignant->photo) {
            \Storage::disk('public')->delete($enseignant->photo);
        }

        $path = $request->file('photo')->store('enseignants', 'public');
        $data['photo'] = $path;
    }

    $enseignant->update($data);

    return redirect()
        ->route('back.formation.enseignants.show', $enseignant)
        ->with('success', 'Enseignant mis à jour avec succès.');
}



 public function assignerForm()
{
    $enseignants = Enseignant::with('user')->orderBy('created_at', 'desc')->get();
    $cours = Cour::orderBy('created_at', 'desc')->get();

    return view('back.formation.enseignants.assigner', compact('enseignants', 'cours'));
}

public function assignerCours(Request $request)
{
    $request->validate([
        'enseignant_id' => 'required|exists:enseignants,id',
        'cours' => 'required|array',
        'cours.*' => 'exists:cours,id',
        'role' => 'nullable|in:principal,assistant',
    ]);

    $enseignant = Enseignant::findOrFail($request->enseignant_id);
    $role = $request->role ?? 'principal';

    $data = [];
    foreach ($request->cours as $courId) {
        $data[$courId] = ['role' => $role];
    }

    $enseignant->cours()->syncWithoutDetaching($data);

    return redirect()
        ->route('back.formation.enseignants.show', $enseignant)
        ->with('success', 'Cours assignés avec succès.');
}
    public function retirerCours(Enseignant $enseignant, Cour $cour)
    {
        $enseignant->cours()->detach($cour->id);

        return redirect()
            ->back()
            ->with('success', 'Cours retiré avec succès.');
    }
}