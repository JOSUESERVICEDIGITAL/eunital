<?php

namespace App\Http\Controllers\Back\Media;

use App\Models\LienSocial;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerLienSocialRequest;
use App\Http\Requests\ModifierLienSocialRequest;

class LienSocialController extends Controller
{
    public function listeTous()
    {
        $liensSociaux = LienSocial::orderBy('ordre_affichage')
            ->orderBy('nom')
            ->paginate(15);

        return view('back.medias.liens-sociaux.liste', compact('liensSociaux'));
    }

    public function listeHeader()
    {
        $liensSociaux = LienSocial::where('emplacement', 'header')
            ->orWhere('emplacement', 'partout')
            ->orderBy('ordre_affichage')
            ->orderBy('nom')
            ->paginate(15);

        return view('back.medias.liens-sociaux.header', compact('liensSociaux'));
    }

    public function listeFooter()
    {
        $liensSociaux = LienSocial::where('emplacement', 'footer')
            ->orWhere('emplacement', 'partout')
            ->orderBy('ordre_affichage')
            ->orderBy('nom')
            ->paginate(15);

        return view('back.medias.liens-sociaux.footer', compact('liensSociaux'));
    }

    public function listeActifs()
    {
        $liensSociaux = LienSocial::where('est_actif', true)
            ->orderBy('ordre_affichage')
            ->orderBy('nom')
            ->paginate(15);

        return view('back.medias.liens-sociaux.actifs', compact('liensSociaux'));
    }

    public function formulaireCreation()
    {
        return view('back.medias.liens-sociaux.creer');
    }

    public function enregistrer(EnregistrerLienSocialRequest $request)
    {
        $donnees = $request->validated();

        $slugDeBase = Str::slug($donnees['nom']);
        $slugFinal = $slugDeBase;
        $compteur = 1;

        while (LienSocial::where('slug', $slugFinal)->exists()) {
            $slugFinal = $slugDeBase . '-' . $compteur;
            $compteur++;
        }

        $lienSocial = LienSocial::create([
            'nom' => $donnees['nom'],
            'slug' => $slugFinal,
            'icone' => $donnees['icone'] ?? null,
            'url' => $donnees['url'],
            'emplacement' => $donnees['emplacement'],
            'ordre_affichage' => $donnees['ordre_affichage'] ?? 0,
            'est_actif' => $request->boolean('est_actif', true),
        ]);

        return redirect()
            ->route('back.medias.liens-sociaux.details', $lienSocial)
            ->with('success', 'Lien social créé avec succès.');
    }

    public function details(LienSocial $lienSocial)
    {
        return view('back.medias.liens-sociaux.details', compact('lienSocial'));
    }

    public function formulaireEdition(LienSocial $lienSocial)
    {
        return view('back.medias.liens-sociaux.modifier', compact('lienSocial'));
    }

    public function mettreAJour(ModifierLienSocialRequest $request, LienSocial $lienSocial)
    {
        $donnees = $request->validated();

        $slugFinal = $lienSocial->slug;

        if ($lienSocial->nom !== $donnees['nom']) {
            $slugDeBase = Str::slug($donnees['nom']);
            $slugFinal = $slugDeBase;
            $compteur = 1;

            while (
                LienSocial::where('slug', $slugFinal)
                    ->where('id', '!=', $lienSocial->id)
                    ->exists()
            ) {
                $slugFinal = $slugDeBase . '-' . $compteur;
                $compteur++;
            }
        }

        $lienSocial->update([
            'nom' => $donnees['nom'],
            'slug' => $slugFinal,
            'icone' => $donnees['icone'] ?? null,
            'url' => $donnees['url'],
            'emplacement' => $donnees['emplacement'],
            'ordre_affichage' => $donnees['ordre_affichage'] ?? 0,
            'est_actif' => $request->boolean('est_actif', false),
        ]);

        return back()->with('success', 'Lien social mis à jour avec succès.');
    }

    public function activer(LienSocial $lienSocial)
    {
        $lienSocial->update([
            'est_actif' => true,
        ]);

        return back()->with('success', 'Lien social activé.');
    }

    public function desactiver(LienSocial $lienSocial)
    {
        $lienSocial->update([
            'est_actif' => false,
        ]);

        return back()->with('success', 'Lien social désactivé.');
    }

    public function changerOrdre(LienSocial $lienSocial)
    {
        $nouvelOrdre = request('ordre_affichage');

        if (!is_numeric($nouvelOrdre)) {
            return back()->with('error', 'L’ordre d’affichage fourni est invalide.');
        }

        $lienSocial->update([
            'ordre_affichage' => (int) $nouvelOrdre,
        ]);

        return back()->with('success', 'Ordre d’affichage mis à jour.');
    }

    public function supprimer(LienSocial $lienSocial)
    {
        $lienSocial->delete();

        return redirect()
            ->route('back.medias.liens-sociaux.tous')
            ->with('success', 'Lien social supprimé avec succès.');
    }
}