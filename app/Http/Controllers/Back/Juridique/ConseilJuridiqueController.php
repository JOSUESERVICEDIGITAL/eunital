<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\ConseilJuridiqueRequest;
use App\Models\Juridique\ConseilJuridique;
use Illuminate\Http\Request;

class ConseilJuridiqueController extends Controller
{
    public function index()
    {
        $conseils = ConseilJuridique::with('createur')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.conseils.index', compact('conseils'));
    }

    public function publies()
    {
        $conseils = ConseilJuridique::with('createur')
            ->where('is_published', true)
            ->orderBy('vues', 'desc')
            ->paginate(15);

        return view('back.juridique.conseils.publies', compact('conseils'));
    }

    public function brouillons()
    {
        $conseils = ConseilJuridique::with('createur')
            ->where('is_published', false)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.conseils.brouillons', compact('conseils'));
    }

    public function create()
    {
        $categories = $this->getCategories();

        return view('back.juridique.conseils.create', compact('categories'));
    }

    public function store(ConseilJuridiqueRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();

        $conseil = ConseilJuridique::create($data);

        return redirect()
            ->route('back.juridique.conseils.show', $conseil)
            ->with('success', 'Conseil juridique créé avec succès.');
    }

    public function show(ConseilJuridique $conseilJuridique)
    {
        // Incrémenter le compteur de vues
        $conseilJuridique->incrementerVues();

        return view('back.juridique.conseils.show', compact('conseilJuridique'));
    }

    public function edit(ConseilJuridique $conseilJuridique)
    {
        $categories = $this->getCategories();

        return view('back.juridique.conseils.edit', compact('conseilJuridique', 'categories'));
    }

    public function update(ConseilJuridiqueRequest $request, ConseilJuridique $conseilJuridique)
    {
        $conseilJuridique->update($request->validated());

        return redirect()
            ->route('back.juridique.conseils.show', $conseilJuridique)
            ->with('success', 'Conseil juridique mis à jour avec succès.');
    }

    public function destroy(ConseilJuridique $conseilJuridique)
    {
        $conseilJuridique->delete();

        return redirect()
            ->route('back.juridique.conseils.index')
            ->with('success', 'Conseil juridique supprimé avec succès.');
    }

    public function publier(ConseilJuridique $conseilJuridique)
    {
        $conseilJuridique->update(['is_published' => true]);

        return redirect()
            ->back()
            ->with('success', 'Conseil juridique publié avec succès.');
    }

    public function depublier(ConseilJuridique $conseilJuridique)
    {
        $conseilJuridique->update(['is_published' => false]);

        return redirect()
            ->back()
            ->with('success', 'Conseil juridique dépublié avec succès.');
    }

    public function faq()
    {
        $faqs = ConseilJuridique::where('is_published', true)
            ->whereNotNull('faq')
            ->get()
            ->flatMap(function($conseil) {
                return $conseil->faq ?? [];
            });

        return view('back.juridique.conseils.faq', compact('faqs'));
    }

    public function guides()
    {
        $guides = ConseilJuridique::where('is_published', true)
            ->where('categorie', 'entreprise')
            ->orderBy('vues', 'desc')
            ->paginate(15);

        return view('back.juridique.conseils.guides', compact('guides'));
    }

    private function getCategories()
    {
        return [
            'entreprise' => 'Entreprise',
            'rh' => 'Ressources Humaines',
            'fiscal' => 'Fiscal',
            'social' => 'Social',
            'commercial' => 'Commercial',
            'international' => 'International',
            'propriete_intellectuelle' => 'Propriété intellectuelle',
            'numerique' => 'Numérique',
            'rgpd' => 'RGPD'
        ];
    }
}
