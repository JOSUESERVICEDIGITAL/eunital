<?php

namespace App\Http\Controllers\Back\Juridique;

use App\Http\Controllers\Controller;
use App\Http\Requests\Juridique\MentionLegaleRequest;
use App\Models\Juridique\MentionLegale;
use Illuminate\Http\Request;

class MentionLegaleController extends Controller
{
    public function index()
    {
        $mentions = MentionLegale::with('createur')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('back.juridique.mentions.index', compact('mentions'));
    }

    public function actives()
    {
        $mentions = MentionLegale::with('createur')
            ->actives()
            ->orderBy('date_effet', 'desc')
            ->paginate(15);

        return view('back.juridique.mentions.actives', compact('mentions'));
    }

    public function create()
    {
        $types = $this->getTypes();

        return view('back.juridique.mentions.create', compact('types'));
    }

    public function store(MentionLegaleRequest $request)
    {
        $data = $request->validated();
        $data['cree_par'] = auth()->id();

        $mention = MentionLegale::create($data);

        return redirect()
            ->route('back.juridique.mentions.show', $mention)
            ->with('success', 'Mention légale créée avec succès.');
    }

    public function show(MentionLegale $mentionLegale)
    {
        return view('back.juridique.mentions.show', compact('mentionLegale'));
    }

    public function edit(MentionLegale $mentionLegale)
    {
        $types = $this->getTypes();

        return view('back.juridique.mentions.edit', compact('mentionLegale', 'types'));
    }

    public function update(MentionLegaleRequest $request, MentionLegale $mentionLegale)
    {
        $mentionLegale->update($request->validated());

        return redirect()
            ->route('back.juridique.mentions.show', $mentionLegale)
            ->with('success', 'Mention légale mise à jour avec succès.');
    }

    public function destroy(MentionLegale $mentionLegale)
    {
        $mentionLegale->delete();

        return redirect()
            ->route('back.juridique.mentions.index')
            ->with('success', 'Mention légale supprimée avec succès.');
    }

    public function activer(MentionLegale $mentionLegale)
    {
        // Désactiver les autres versions du même type
        MentionLegale::where('type', $mentionLegale->type)
            ->where('id', '!=', $mentionLegale->id)
            ->update(['is_active' => false]);

        $mentionLegale->update(['is_active' => true]);

        return redirect()
            ->back()
            ->with('success', 'Mention légale activée avec succès.');
    }

    private function getTypes()
    {
        return [
            'mentions_legales' => 'Mentions légales',
            'politique_confidentialite' => 'Politique de confidentialité',
            'cgu' => 'Conditions générales d\'utilisation',
            'cgv' => 'Conditions générales de vente',
            'politique_cookies' => 'Politique des cookies',
            'charte_utilisation' => 'Charte d\'utilisation',
            'conditions_vente' => 'Conditions de vente'
        ];
    }
}
