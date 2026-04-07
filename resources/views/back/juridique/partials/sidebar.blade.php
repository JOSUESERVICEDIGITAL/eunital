<li class="nav-item {{ request()->routeIs('back.juridique.dashboard') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('back.juridique.dashboard') }}">
        <i class="fas fa-fw fa-chart-line"></i>
        <span>Dashboard juridique</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDocuments">
        <i class="fas fa-fw fa-file-alt"></i>
        <span>Documents</span>
    </a>
    <div id="collapseDocuments" class="collapse" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('back.juridique.documents.index') }}">Tous les documents</a>
            <a class="collapse-item" href="{{ route('back.juridique.documents.create') }}">Nouveau document</a>
            <a class="collapse-item" href="{{ route('back.juridique.generation.create') }}">Générer un document</a>
            <a class="collapse-item" href="{{ route('back.juridique.documents.brouillons') }}">Brouillons</a>
            <a class="collapse-item" href="{{ route('back.juridique.documents.en-attente') }}">En attente</a>
            <a class="collapse-item" href="{{ route('back.juridique.documents.archives') }}">Archives</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseContrats">
        <i class="fas fa-fw fa-handshake"></i>
        <span>Contrats</span>
    </a>
    <div id="collapseContrats" class="collapse" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('back.juridique.contrats.index') }}">Tous les contrats</a>
            <a class="collapse-item" href="{{ route('back.juridique.contrats.create') }}">Nouveau contrat</a>
            <a class="collapse-item" href="{{ route('back.juridique.contrats.actifs') }}">Contrats actifs</a>
            <a class="collapse-item" href="{{ route('back.juridique.contrats.expirants') }}">Expirant bientôt</a>
            <a class="collapse-item" href="{{ route('back.juridique.contrats.expires') }}">Contrats expirés</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSignatures">
        <i class="fas fa-fw fa-pen"></i>
        <span>Signatures</span>
    </a>
    <div id="collapseSignatures" class="collapse" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('back.juridique.signatures.index') }}">Toutes les signatures</a>
            <a class="collapse-item" href="{{ route('back.juridique.signatures.create') }}">Demander une signature</a>
            <a class="collapse-item" href="{{ route('back.juridique.signatures.en-attente') }}">En attente</a>
            <a class="collapse-item" href="{{ route('back.juridique.signatures.signees') }}">Signatures effectuées</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseModeles">
        <i class="fas fa-fw fa-copy"></i>
        <span>Modèles</span>
    </a>
    <div id="collapseModeles" class="collapse" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('back.juridique.modeles.index') }}">Tous les modèles</a>
            <a class="collapse-item" href="{{ route('back.juridique.modeles.create') }}">Nouveau modèle</a>
            <a class="collapse-item" href="{{ route('back.juridique.modeles.actifs') }}">Modèles actifs</a>
            <a class="collapse-item" href="{{ route('back.juridique.modeles.par-defaut') }}">Modèles par défaut</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConformite">
        <i class="fas fa-fw fa-shield-alt"></i>
        <span>Conformité</span>
    </a>
    <div id="collapseConformite" class="collapse" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('back.juridique.conformites.index') }}">Évaluations</a>
            <a class="collapse-item" href="{{ route('back.juridique.conformites.conformes') }}">Conformes</a>
            <a class="collapse-item" href="{{ route('back.juridique.conformites.non-conformes') }}">Non conformes</a>
            <a class="collapse-item" href="{{ route('back.juridique.demarches-rgpd.index') }}">Démarches RGPD</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLitiges">
        <i class="fas fa-fw fa-gavel"></i>
        <span>Litiges</span>
    </a>
    <div id="collapseLitiges" class="collapse" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('back.juridique.litiges.index') }}">Tous les litiges</a>
            <a class="collapse-item" href="{{ route('back.juridique.litiges.create') }}">Nouveau litige</a>
            <a class="collapse-item" href="{{ route('back.juridique.litiges.ouverts') }}">Litiges ouverts</a>
            <a class="collapse-item" href="{{ route('back.juridique.litiges.clos') }}">Litiges clos</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEntreprises">
        <i class="fas fa-fw fa-building"></i>
        <span>Entreprises</span>
    </a>
    <div id="collapseEntreprises" class="collapse" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('back.juridique.entreprises.index') }}">Toutes les entreprises</a>
            <a class="collapse-item" href="{{ route('back.juridique.entreprises.create') }}">Ajouter une entreprise</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArchives">
        <i class="fas fa-fw fa-archive"></i>
        <span>Archives</span>
    </a>
    <div id="collapseArchives" class="collapse" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('back.juridique.archives.index') }}">Toutes les archives</a>
            <a class="collapse-item" href="{{ route('back.juridique.archives.documents') }}">Documents archivés</a>
            <a class="collapse-item" href="{{ route('back.juridique.archives.contrats') }}">Contrats archivés</a>
            <a class="collapse-item" href="{{ route('back.juridique.archives.litiges') }}">Litiges archivés</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseParametres">
        <i class="fas fa-fw fa-cog"></i>
        <span>Paramètres</span>
    </a>
    <div id="collapseParametres" class="collapse" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('back.juridique.types-documents.index') }}">Types de documents</a>
            <a class="collapse-item" href="{{ route('back.juridique.legalites.index') }}">Textes légaux</a>
            <a class="collapse-item" href="{{ route('back.juridique.mentions.index') }}">Mentions légales</a>
            <a class="collapse-item" href="{{ route('back.juridique.cgu.index') }}">CGU / CGV</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('back.juridique.statistiques.index') }}">
        <i class="fas fa-fw fa-chart-pie"></i>
        <span>Statistiques</span>
    </a>
</li>