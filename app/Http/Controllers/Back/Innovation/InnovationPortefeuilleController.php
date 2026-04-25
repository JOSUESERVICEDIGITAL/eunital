<?php

namespace App\Http\Controllers\Back\Innovation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Innovation\InnovationPortefeuilleRequest;
use App\Models\Innovation\InnovationPortefeuille;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InnovationPortefeuilleController extends Controller
{
    public function index(Request $request)
    {
        $query = InnovationPortefeuille::with('responsable')
            ->withCount(['innovations', 'feuillesRoutes', 'alertes']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nom', 'like', "%{$request->search}%")
                    ->orWhere('code', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        foreach (['type_portefeuille', 'statut', 'niveau_priorite'] as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, $request->$filter);
            }
        }

        $portefeuilles = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => InnovationPortefeuille::count(),
            'actifs' => InnovationPortefeuille::where('statut', 'actif')->count(),
            'suspendus' => InnovationPortefeuille::where('statut', 'suspendu')->count(),
            'archives' => InnovationPortefeuille::where('statut', 'archive')->count(),
        ];

        return view('back.innovations.portefeuilles.index', compact('portefeuilles', 'stats'));
    }

    public function create()
    {
        $responsables = User::orderBy('name')->get();

        return view('back.innovations.portefeuilles.create', compact('responsables'));
    }

    public function store(InnovationPortefeuilleRequest $request)
    {
        $data = $request->validated();
        $data['code'] = $data['code'] ?? 'PORT-' . strtoupper(Str::random(8));

        $portefeuille = InnovationPortefeuille::create($data);

        return redirect()
            ->route('back.innovations.portefeuilles.show', $portefeuille)
            ->with('success', 'Portefeuille créé.');
    }

    public function show(InnovationPortefeuille $portefeuille)
    {
        $portefeuille->load([
            'responsable',
            'innovations',
            'feuillesRoutes.jalons',
            'alertes',
        ]);

        return view('back.innovations.portefeuilles.show', compact('portefeuille'));
    }

    public function edit(InnovationPortefeuille $portefeuille)
    {
        $responsables = User::orderBy('name')->get();

        return view('back.innovations.portefeuilles.edit', compact('portefeuille', 'responsables'));
    }

    public function update(InnovationPortefeuilleRequest $request, InnovationPortefeuille $portefeuille)
    {
        $portefeuille->update($request->validated());

        return redirect()
            ->route('back.innovations.portefeuilles.show', $portefeuille)
            ->with('success', 'Portefeuille mis à jour.');
    }

    public function destroy(InnovationPortefeuille $portefeuille)
    {
        $portefeuille->delete();

        return redirect()
            ->route('back.innovations.portefeuilles.index')
            ->with('success', 'Portefeuille archivé.');
    }

    public function activer(InnovationPortefeuille $portefeuille)
    {
        $portefeuille->update(['statut' => 'actif']);

        return back()->with('success', 'Portefeuille activé.');
    }

    public function suspendre(InnovationPortefeuille $portefeuille)
    {
        $portefeuille->update(['statut' => 'suspendu']);

        return back()->with('success', 'Portefeuille suspendu.');
    }

    public function archiver(InnovationPortefeuille $portefeuille)
    {
        $portefeuille->update(['statut' => 'archive']);

        return back()->with('success', 'Portefeuille archivé.');
    }

    public function budget(InnovationPortefeuille $portefeuille)
    {
        $budget = [
            'previsionnel' => $portefeuille->budget_previsionnel,
            'consomme' => $portefeuille->budget_consomme,
            'reste' => $portefeuille->budget_previsionnel - $portefeuille->budget_consomme,
            'taux' => $portefeuille->budget_previsionnel > 0
                ? round(($portefeuille->budget_consomme / $portefeuille->budget_previsionnel) * 100, 2)
                : 0,
        ];

        return view('back.innovations.portefeuilles.budget', compact('portefeuille', 'budget'));
    }
}
