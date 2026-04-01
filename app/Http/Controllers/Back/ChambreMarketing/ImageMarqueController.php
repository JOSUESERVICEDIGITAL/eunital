<?php

namespace App\Http\Controllers\Back\ChambreMarketing;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\ImageMarque;
use App\Http\Requests\EnregistrerImageMarqueRequest;
use App\Http\Requests\ModifierImageMarqueRequest;

class ImageMarqueController extends Controller
{
    public function listeToutes()
    {
        $imagesMarque = ImageMarque::with('auteur')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.images-marque.liste', compact('imagesMarque'));
    }

    public function listeActives()
    {
        $imagesMarque = ImageMarque::with('auteur')
            ->where('statut', 'active')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.images-marque.actives', compact('imagesMarque'));
    }

    public function listeObsoletes()
    {
        $imagesMarque = ImageMarque::with('auteur')
            ->where('statut', 'obsolete')
            ->latest()
            ->paginate(12);

        return view('back.chambre-marketing.images-marque.obsoletes', compact('imagesMarque'));
    }

    public function formulaireCreation()
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-marketing.images-marque.creer', compact('utilisateurs'));
    }

    public function enregistrer(EnregistrerImageMarqueRequest $request)
    {
        $donnees = $request->validated();

        $slugBase = Str::slug($donnees['nom_marque']);
        $slug = $slugBase;
        $compteur = 1;

        while (ImageMarque::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $compteur++;
        }

        $imageMarque = ImageMarque::create([
            'auteur_id' => $donnees['auteur_id'] ?? auth()->id(),
            'nom_marque' => $donnees['nom_marque'],
            'slug' => $slug,
            'slogan' => $donnees['slogan'] ?? null,
            'ton_marque' => $donnees['ton_marque'] ?? null,
            'identite_visuelle' => $donnees['identite_visuelle'] ?? null,
            'palette_couleurs' => $donnees['palette_couleurs'] ?? null,
            'elements_langage' => $donnees['elements_langage'] ?? null,
            'ligne_editoriale' => $donnees['ligne_editoriale'] ?? null,
            'logo' => $donnees['logo'] ?? null,
            'charte_graphique' => $donnees['charte_graphique'] ?? null,
            'statut' => $donnees['statut'],
        ]);

        return redirect()
            ->route('back.chambre-marketing.images-marque.details', $imageMarque)
            ->with('success', 'Image de marque enregistrée avec succès.');
    }

    public function details(ImageMarque $imageMarque)
    {
        $imageMarque->load('auteur');

        return view('back.chambre-marketing.images-marque.details', compact('imageMarque'));
    }

    public function formulaireEdition(ImageMarque $imageMarque)
    {
        $utilisateurs = User::orderBy('name')->get();

        return view('back.chambre-marketing.images-marque.modifier', compact('imageMarque', 'utilisateurs'));
    }

    public function mettreAJour(ModifierImageMarqueRequest $request, ImageMarque $imageMarque)
    {
        $donnees = $request->validated();

        $slug = $imageMarque->slug;

        if ($imageMarque->nom_marque !== $donnees['nom_marque']) {
            $slugBase = Str::slug($donnees['nom_marque']);
            $slug = $slugBase;
            $compteur = 1;

            while (
                ImageMarque::where('slug', $slug)
                    ->where('id', '!=', $imageMarque->id)
                    ->exists()
            ) {
                $slug = $slugBase . '-' . $compteur++;
            }
        }

        $imageMarque->update([
            'auteur_id' => $donnees['auteur_id'] ?? $imageMarque->auteur_id,
            'nom_marque' => $donnees['nom_marque'],
            'slug' => $slug,
            'slogan' => $donnees['slogan'] ?? null,
            'ton_marque' => $donnees['ton_marque'] ?? null,
            'identite_visuelle' => $donnees['identite_visuelle'] ?? null,
            'palette_couleurs' => $donnees['palette_couleurs'] ?? null,
            'elements_langage' => $donnees['elements_langage'] ?? null,
            'ligne_editoriale' => $donnees['ligne_editoriale'] ?? null,
            'logo' => $donnees['logo'] ?? null,
            'charte_graphique' => $donnees['charte_graphique'] ?? null,
            'statut' => $donnees['statut'],
        ]);

        return back()->with('success', 'Image de marque mise à jour avec succès.');
    }

    public function activer(ImageMarque $imageMarque)
    {
        $imageMarque->update(['statut' => 'active']);

        return back()->with('success', 'Image de marque activée.');
    }

    public function marquerObsolete(ImageMarque $imageMarque)
    {
        $imageMarque->update(['statut' => 'obsolete']);

        return back()->with('success', 'Image de marque marquée obsolète.');
    }

    public function archiver(ImageMarque $imageMarque)
    {
        $imageMarque->update(['statut' => 'archivee']);

        return back()->with('success', 'Image de marque archivée.');
    }

    public function supprimer(ImageMarque $imageMarque)
    {
        $imageMarque->delete();

        return redirect()
            ->route('back.chambre-marketing.images-marque.toutes')
            ->with('success', 'Image de marque supprimée avec succès.');
    }
}
