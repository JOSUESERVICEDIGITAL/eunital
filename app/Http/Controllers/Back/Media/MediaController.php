<?php

namespace App\Http\Controllers\Back\Media;

use App\Models\Media;
use App\Models\User;
use App\Models\CategorieMedia;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EnregistrerMediaRequest;
use App\Http\Requests\ModifierMediaRequest;

class MediaController extends Controller
{
    public function bibliotheque()
    {
        $medias = Media::with(['categorie', 'utilisateur'])
            ->latest()
            ->paginate(15);

        return view('back.medias.medias.bibliotheque', compact('medias'));
    }

    public function listeImages()
    {
        $medias = Media::with(['categorie', 'utilisateur'])
            ->where('type_media', 'image')
            ->latest()
            ->paginate(15);

        return view('back.medias.medias.images', compact('medias'));
    }

    public function listeVideos()
    {
        $medias = Media::with(['categorie', 'utilisateur'])
            ->where('type_media', 'video')
            ->latest()
            ->paginate(15);

        return view('back.medias.medias.videos', compact('medias'));
    }

    public function listeDocuments()
    {
        $medias = Media::with(['categorie', 'utilisateur'])
            ->where('type_media', 'document')
            ->latest()
            ->paginate(15);

        return view('back.medias.medias.documents', compact('medias'));
    }

    public function listeEnAvant()
    {
        $medias = Media::with(['categorie', 'utilisateur'])
            ->where('est_en_avant', true)
            ->latest()
            ->paginate(15);

        return view('back.medias.medias.en-avant', compact('medias'));
    }

    public function formulaireCreation()
    {
        $categoriesMedias = CategorieMedia::where('est_actif', true)
            ->orderBy('nom')
            ->get();

        $utilisateurs = User::orderBy('name')->get();

        return view('back.medias.medias.creer', compact('categoriesMedias', 'utilisateurs'));
    }

    public function enregistrer(EnregistrerMediaRequest $request)
    {
        $donnees = $request->validated();

        $slugDeBase = Str::slug($donnees['titre']);
        $slugFinal = $slugDeBase;
        $compteur = 1;

        while (Media::where('slug', $slugFinal)->exists()) {
            $slugFinal = $slugDeBase . '-' . $compteur;
            $compteur++;
        }

        $cheminFichier = null;
        $cheminMiniature = null;
        $taille = null;
        $mimeType = null;
        $extension = null;

        if ($request->hasFile('fichier')) {
            $fichier = $request->file('fichier');
            $cheminFichier = $fichier->store('medias/fichiers', 'public');
            $taille = $fichier->getSize();
            $mimeType = $fichier->getMimeType();
            $extension = $fichier->getClientOriginalExtension();
        }

        if ($request->hasFile('miniature')) {
            $cheminMiniature = $request->file('miniature')->store('medias/miniatures', 'public');
        }

        $media = Media::create([
            'categorie_media_id' => $donnees['categorie_media_id'] ?? null,
            'user_id' => $donnees['user_id'] ?? auth()->id(),
            'titre' => $donnees['titre'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'fichier' => $cheminFichier,
            'miniature' => $cheminMiniature,
            'type_media' => $donnees['type_media'],
            'mime_type' => $mimeType,
            'taille' => $taille,
            'extension' => $extension,
            'url_externe' => $donnees['url_externe'] ?? null,
            'alt_text' => $donnees['alt_text'] ?? null,
            'est_public' => $request->boolean('est_public', true),
            'est_en_avant' => $request->boolean('est_en_avant', false),
        ]);

        return redirect()
            ->route('back.medias.fichiers.details', $media)
            ->with('success', 'Média enregistré avec succès.');
    }

    public function details(Media $media)
    {
        $media->load(['categorie', 'utilisateur']);

        return view('back.medias.medias.details', compact('media'));
    }

    public function formulaireEdition(Media $media)
    {
        $categoriesMedias = CategorieMedia::orderBy('nom')->get();
        $utilisateurs = User::orderBy('name')->get();

        return view('back.medias.medias.modifier', compact('media', 'categoriesMedias', 'utilisateurs'));
    }

    public function mettreAJour(ModifierMediaRequest $request, Media $media)
    {
        $donnees = $request->validated();

        $slugFinal = $media->slug;

        if ($media->titre !== $donnees['titre']) {
            $slugDeBase = Str::slug($donnees['titre']);
            $slugFinal = $slugDeBase;
            $compteur = 1;

            while (
                Media::where('slug', $slugFinal)
                    ->where('id', '!=', $media->id)
                    ->exists()
            ) {
                $slugFinal = $slugDeBase . '-' . $compteur;
                $compteur++;
            }
        }

        $cheminFichier = $media->fichier;
        $cheminMiniature = $media->miniature;
        $taille = $media->taille;
        $mimeType = $media->mime_type;
        $extension = $media->extension;

        if ($request->hasFile('fichier')) {
            if ($media->fichier) {
                Storage::disk('public')->delete($media->fichier);
            }

            $fichier = $request->file('fichier');
            $cheminFichier = $fichier->store('medias/fichiers', 'public');
            $taille = $fichier->getSize();
            $mimeType = $fichier->getMimeType();
            $extension = $fichier->getClientOriginalExtension();
        }

        if ($request->hasFile('miniature')) {
            if ($media->miniature) {
                Storage::disk('public')->delete($media->miniature);
            }

            $cheminMiniature = $request->file('miniature')->store('medias/miniatures', 'public');
        }

        $media->update([
            'categorie_media_id' => $donnees['categorie_media_id'] ?? null,
            'user_id' => $donnees['user_id'] ?? $media->user_id,
            'titre' => $donnees['titre'],
            'slug' => $slugFinal,
            'description' => $donnees['description'] ?? null,
            'fichier' => $cheminFichier,
            'miniature' => $cheminMiniature,
            'type_media' => $donnees['type_media'],
            'mime_type' => $mimeType,
            'taille' => $taille,
            'extension' => $extension,
            'url_externe' => $donnees['url_externe'] ?? null,
            'alt_text' => $donnees['alt_text'] ?? null,
            'est_public' => $request->boolean('est_public', false),
            'est_en_avant' => $request->boolean('est_en_avant', false),
        ]);

        return back()->with('success', 'Média mis à jour avec succès.');
    }

    public function mettreEnAvant(Media $media)
    {
        $media->update([
            'est_en_avant' => true,
        ]);

        return back()->with('success', 'Le média a été mis en avant.');
    }

    public function retirerDeLaMiseEnAvant(Media $media)
    {
        $media->update([
            'est_en_avant' => false,
        ]);

        return back()->with('success', 'Le média a été retiré de la mise en avant.');
    }

    public function rendrePublic(Media $media)
    {
        $media->update([
            'est_public' => true,
        ]);

        return back()->with('success', 'Le média est maintenant public.');
    }

    public function rendrePrive(Media $media)
    {
        $media->update([
            'est_public' => false,
        ]);

        return back()->with('success', 'Le média est maintenant privé.');
    }

    public function supprimerFichier(Media $media)
    {
        if ($media->fichier) {
            Storage::disk('public')->delete($media->fichier);

            $media->update([
                'fichier' => null,
                'mime_type' => null,
                'taille' => null,
                'extension' => null,
            ]);
        }

        return back()->with('success', 'Le fichier principal a été supprimé.');
    }

    public function supprimerMiniature(Media $media)
    {
        if ($media->miniature) {
            Storage::disk('public')->delete($media->miniature);

            $media->update([
                'miniature' => null,
            ]);
        }

        return back()->with('success', 'La miniature a été supprimée.');
    }

    public function supprimer(Media $media)
    {
        if ($media->fichier) {
            Storage::disk('public')->delete($media->fichier);
        }

        if ($media->miniature) {
            Storage::disk('public')->delete($media->miniature);
        }

        $media->delete();

        return redirect()
            ->route('back.medias.fichiers.bibliotheque')
            ->with('success', 'Média supprimé avec succès.');
    }
}