@extends('./layouts/admin')
<style>
    h6 {
        text-align: justify;
    }

    ul {
        overflow: auto;
    }

    .nav-link {
        color: black !important;
    }

    h2 {
        color: #801D68;
    }

    .row_conditions {
        padding-bottom: 5rem;
        overflow: hidden;
    }

    /* .row_conditions .col-4{
        position: sticky;
        top: 5rem;
    } */

    .test{
        position: sticky;
        top: 5rem;
    }


    /* .row_conditions header{
        position: sticky;
        top: 5rem;
    } */

</style>
@section('content')
<div class="test"><p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perferendis officia corporis ea magni unde eos, magnam, cupiditate adipisci illo, ab cumque dolor ratione pariatur. Ipsum cumque vel quibusdam natus quae!</p></div>
<button type="button" class="btn btn-floating btn-lg" id="btn-back-to-top">
    <i class="far fa-arrow-up"></i>
</button>
<div class="container-fluid row_conditions">

    <div class="row">
        <div class="col-4 ">
            <ul class="nav flex-column navperso">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#access">Accès aux Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#inscription">Inscription</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#usage">Usage strictement personnel, Comptes administrateurs et utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#duree">Durée de l’abonnement, désinscription</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#description">Description des Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#condition">Conditions financières</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link " href="#responsabilite">Responsabilités et garanties du Client
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#comportement">Comportements prohibés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#obligation">Obligations et responsabilité du A WORLD FOR US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#propriete">Propriété Intellectuelle
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#donnees">Données à caractère personnel</a>
                </li> --}}

            </ul>
        </div>
        <div class="col-8">
            <div id="access"></div>
            <h1>Conditions générales de la plateforme Formation.mg</h1>
            <div>
                <h2>Accès aux Services</h2>
                1. Capacité juridique
                <h6>Les services sont accessibles à toute personne morale agissant par l’intermédiaire d’une personne physique disposant de la capacité juridique pour contracter au nom et pour le compte de la personne morale.</h6><br>
                2. Services destinés exclusivement aux professionnel.
                <h6>Les Services s’adressent exclusivement aux professionnels entendus comme toutes personnes physiques ou morales exerçant une activité rémunérée de façon non occasionnelle dans tous les secteurs liés à la formation ou à la gestion de compétences. </h6><br>
                3. Commande des Services et acceptation des conditions générales
                <h6 id="inscription">La validation du Devis par le Client, toute commande de Service ou toute souscription d’abonnement nécessite son inscription sur le Site, et l’acceptation pleine et entière des dispositions des présentes conditions générales.
                    Toute adhésion sous réserve est considérée comme nulle et non avenue.</h6>
            </div>
            <div>
                <h2>Inscription</h2>
                <h6>1. L’accès aux Services nécessite que le Client s’inscrive sur le Site, lui-même ou par le biais d’un administrateur qu’il aura désigné, en remplissant le formulaire prévu à cet effet.
                </h6><br>
                <h6>2. Le Client, ou l’administrateur, doit fournir l’ensemble des informations marquées comme obligatoires, notamment son nom, prénom, adresse email professionnelle et mot de passe. Il reconnaît et accepte que l’adresse email renseignée sur le formulaire d’inscription constitue son identifiant de connexion.</h6><br>
                <h6>Toute inscription incomplète ne sera pas validée. </h6><br>
                <h6>L’inscription entraîne l’ouverture d’un compte au nom du Client , lui donnant accès à un espace personnel qui lui permet de gérer son utilisation des Services sous une forme et selon les moyens techniques que Formation.mg juge les plus appropriés pour rendre lesdits Services.</h6><br>
                <h6>Le Client garantit que toutes les informations qu’il donne dans le formulaire d’inscription sont exactes, à jour et sincères et ne sont entachées d’aucun caractère trompeur.</h6><br>
                <h6>Il s’engage à mettre à jour ces informations dans son Espace Personnel en cas de modifications, afin qu’elles correspondent toujours aux critères susvisés.</h6><br>
                <h6 id="usage"> Client est informé et accepte que les informations saisies aux fins de création ou de mise à jour de son Compte, par lui ou par le biais de l’Administrateur, vaillent preuve de son identité. Les informations saisies par le Client l’engagent dès leur validation.</h6>
            </div>
            <div>
                <h2>Usage strictement personnel, Comptes administrateurs et utilisateurs</h2>
                <h6>Une fois son inscription validée, le Client, ou l’administrateur qu’il aura désigné, dispose de la faculté de créer plusieurs comptes utilisateurs via son Espace Personnel, donnant accès aux Services.</h6><br>
                <h6> appartient au Client ou à l’administrateur de sélectionner les utilisateurs ayant accès à l’Application ou aux Services, dans la limite du nombre maximum prévu dans l’abonnement du Client, de déterminer la nature des accès qui leur sont donnés, ainsi que les données et informations auxquelles ils ont accès.</h6><br>
                <h6>L’utilisateur et/ou l’administrateur peuvent accéder à tout moment au Compte du Client par le biais de leur propre Espace Personnel, après s’être identifiés à l’aide de leur identifiant de connexion ainsi que de leur mot de passe.</h6><br>
                <h6>L’utilisateur et l’administrateur s’engagent à utiliser personnellement les Services et à ne permettre à aucun tiers de les utiliser à leur place ou pour leur compte, sauf à en supporter l’entière responsabilité.</h6><br>
                <h6>Ils sont pareillement responsables du maintien de la confidentialité de leur identifiant et de leur mot de passe, et reconnaissent expressément que toute utilisation des Services depuis leur Compte sera réputée avoir été effectuée par eux. Ces derniers doivent immédiatement contacter Formation;mg s’ils remarquent que leur Compte a été utilisé à leur insu. Ils reconnaissent à formation.mg le droit de prendre toutes mesures appropriées en pareil cas.</h6><br>
                <h6 id="duree">Le Client est responsable de l’utilisation des Services par l’administrateur et les utilisateurs. Toute utilisation des Services avec l’identifiant et le mot de passe d’un Compte administrateur et/ou utilisateur est réputée effectuée par le Client.</h6><br>
            </div>
            <div>
                <h2>Durée de l’abonnement, désinscription</h2>
                <h6>1. La licence d’utilisation de l’Application et l’ensemble des Services prévus aux présentes sont souscrits par le Client sous la forme d’un abonnement mensuel ou annuel, dont la date de début est indiquée dans l’email de confirmation de son inscription. Cet abonnement se renouvellera ensuite tacitement pour une période de même durée, sauf dénonciation par l’une ou l’autre des parties adressée à l’autre partie par tout moyen écrit 8 (huit) jours au moins avant l’expiration de la période en cours.
                </h6><br>
                <h6 id="description">2. Tout abonnement aux Services est souscrit pour une durée indéterminée. La suppression d’un compte ne pourrait pas se faire, du fait que c’est un site collaboratif. Cependant, le client peut suspendre son compte et y avoir accès dès qu’il entre son identifiant et son mot de passe.
                </h6><br>
            </div>
            <div>
                <h2>Description des Services</h2>
                <h6>1. Licence(s) d’utilisation de l’Application</h6>
                <h6 style="margin-left: 10px">1.1 Objet de la licence</h6>
                <h6>A WORLD FOR US concède au Client une licence non exclusive, personnelle et non transmissible d’utilisation de son Application, dans sa version existante à la date des présentes et dans toutes éventuelles versions à venir, aux seules fins de la fourniture des Services.</h6><br>
                <h6>L’accès à l’Application est fourni : </h6><br>
                <ul>
                    <li>- Gratuitement en ce qui concerne l’abonnement basique ;</li>
                    <li>- Moyennant un abonnement payant concernant les fonctionnalités Premium proposées sur le Site.
                    </li>
                </ul>
                <h6>Cette licence est consentie pour le monde entier et pour la durée de l’abonnement souscrit.</h6><br>
                <h6>Il est interdit au Client d’en céder ou d’en transférer le bénéfice à un tiers, quel qu’il soit.</h6><br>
                <h6 style="margin-left: 10px">1.2 Hébergement</h6>
                <h6>Le Client n’autorise aucune utilisation des données collectées par le biais de l’Application par A WORLD FOR US ou par un tiers, qui ne serait pas rendue nécessaire par l’exécution du Contrat, sans son autorisation explicite et écrite.</h6><br>
                <h6>En cas de changement de prestataire d’hébergement, A WORLD FOR US s’engage à en aviser le Client dans les plus brefs délais, par tout moyen écrit utile. L’identité du nouvel hébergeur, ainsi que le territoire dans lequel ses serveurs seront situés s’ils sont hors Europe, seront communiqués au Client.</h6><br>
                <h6>A WORLD FOR US s’engage à mettre en œuvre l’ensemble des moyens techniques conformes à l’état de l’art nécessaires pour assurer la sécurité et l’accès à l’Application et aux Services, portant sur la protection et la surveillance des infrastructures, le contrôle de l’accès physique et/ou immatériel auxdites infrastructures, ainsi que sur la mise en œuvre des mesures de détection, de prévention et de récupération pour protéger ses serveurs d’actes malveillants.</h6><br>
                <h6>Eu égard à la complexité d’Internet, l’inégalité des capacités des différents sous-réseaux, l’afflux à certaines heures des Clients de l’Application, aux différents goulots d’étranglement sur lesquels A WORLD FOR US n’a aucune maîtrise, la responsabilité de A WORLD FOR US sera limitée au fonctionnement de ses propres serveurs, dont les limites extérieures sont constituées par les points de raccordement.</h6><br>
                <h6>A WORLD FOR US ne saurait être tenue pour responsable (i) de l’indisponibilité des serveurs du Client ou de ceux de son système d’exploitation, (ii) des vitesses d’accès à ses serveurs, (iii) des ralentissements externes à ses serveurs, et (iv) des mauvaises transmissions dues à une défaillance ou à un dysfonctionnement de ses réseaux.</h6><br>
                <h6 style="margin-left: 10px">1.3 Maintenance évolutive</h6>
                <h6>A WORLD FOR US s’engage à faire bénéficier le Client des évolutions et mises à jour de son Application, dont la nature et la fréquence seront laissées à la libre appréciation de A WORLD FOR US.</h6><br>
                <h6>A WORLD FOR US se réserve la possibilité de limiter ou de suspendre l’accès à l’Application pendant les opérations de maintenance. Elle informera le Client au préalable par tout moyen utile de la réalisation de ces opérations.</h6><br>
                <h6 style="margin-left: 10px">1.4 Support technique</h6>
                <h6>En dehors des dysfonctionnements et pour toute question liée à la simple utilisation des Services, A WORLD FOR US offre au Client un support technique consistant en une assistance et un conseil.</h6><br>
                <h6>Le support technique est accessible à l’adresse email info@digiforma.com ou par chat.</h6><br>
                <h6 style="margin-left: 10px">1.5 Autres Services</h6>
                <h6>A WORLD FOR US se réserve le droit de proposer tous autres Services ou abonnement qu’elle jugera utile, sous une forme et selon les fonctionnalités et moyens techniques qu’elle estimera les plus appropriés pour rendre lesdits Services. Aucune prestation supplémentaire n’aura lieu sans que le Client n’en ait accepté le prix et les conditions de mise en œuvre de façon expresse, préalable et par écrit.</h6><br>
            </div>
            <div>
                <h2>Conditions financières</h2>
                <h6>1. Prix des Services </h6>
                <h6>En contrepartie de la réalisation des Services, le Client s’engage à payer à A WORLD FOR US le prix de l’abonnement choisi, tel qu’indiqué sur le Site et préalablement à son inscription mensuelle ou annuelle, par virement bancaire.</h6><br>
                <h6>2. Facturation </h6>
                <h6>Les Services font l’objet de factures ponctuelles ou mensuelles communiquées au Client par email et à chaque nouvelle souscription de Service ou d’abonnement.</h6><br>
                <h6 id="condition">3. Révision du Prix </h6>
                <h6>Le Prix a été calculé en fonction de l’abonnement choisi par le Client et des options éventuellement souscrites. Si l’un de ces paramètres venait à évoluer en cours de Contrat, le Prix des Services serait recalculé en conséquence.</h6><br>
                <h6>4. Retards et défauts de paiement
                    <h6>De convention expresse entre les parties, tout retard de paiement de tout ou partie d’une somme due à son échéance au titre de l’exécution des Services entraînera automatiquement et sans mise en demeure préalable : (i) la déchéance du terme de l’ensemble des sommes dues par le Client et leur exigibilité immédiate, (ii) la suspension immédiate des Services jusqu’au complet paiement de l’intégralité des sommes dues et (iii) la facturation au profit de A WORLD FOR US d’un intérêt de retard au taux de 3 fois (trois fois) le taux d’intérêt légal, assis sur le montant de l’intégralité des sommes dues par le Client.</h6><br>
            </div>
        </div>
    </div>
</div>
{{-- <header class="col-4">
        <ul class="nav flex-column navperso">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#access">Accès aux Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#inscription">Inscription</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#usage">Usage strictement personnel, Comptes administrateurs et utilisateurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#duree">Durée de l’abonnement, désinscription</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#description">Description des Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#condition">Conditions financières</a>
            </li> --}}
{{-- <li class="nav-item">
                <a class="nav-link " href="#responsabilite">Responsabilités et garanties du Client
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#comportement">Comportements prohibés</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#obligation">Obligations et responsabilité du A WORLD FOR US</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#propriete">Propriété Intellectuelle
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#donnees">Données à caractère personnel</a>
            </li> --}}

{{-- </ul>
    </header>

    <main class="col-6">
        <div id="access"></div>
        <h1>Conditions générales de la plateforme Formation.mg</h1>
        <div>
            <h2>Accès aux Services</h2>
            1. Capacité juridique
            <h6>Les services sont accessibles à toute personne morale agissant par l’intermédiaire d’une personne physique disposant de la capacité juridique pour contracter au nom et pour le compte de la personne morale.</h6><br>
            2. Services destinés exclusivement aux professionnel.
            <h6>Les Services s’adressent exclusivement aux professionnels entendus comme toutes personnes physiques ou morales exerçant une activité rémunérée de façon non occasionnelle dans tous les secteurs liés à la formation ou à la gestion de compétences. </h6><br>
            3. Commande des Services et acceptation des conditions générales
            <h6 id="inscription">La validation du Devis par le Client, toute commande de Service ou toute souscription d’abonnement nécessite son inscription sur le Site, et l’acceptation pleine et entière des dispositions des présentes conditions générales.
                Toute adhésion sous réserve est considérée comme nulle et non avenue.</h6>
        </div>
        <div>
            <h2>Inscription</h2>
            <h6>1. L’accès aux Services nécessite que le Client s’inscrive sur le Site, lui-même ou par le biais d’un administrateur qu’il aura désigné, en remplissant le formulaire prévu à cet effet.
            </h6><br>
            <h6>2. Le Client, ou l’administrateur, doit fournir l’ensemble des informations marquées comme obligatoires, notamment son nom, prénom, adresse email professionnelle et mot de passe. Il reconnaît et accepte que l’adresse email renseignée sur le formulaire d’inscription constitue son identifiant de connexion.</h6><br>
            <h6>Toute inscription incomplète ne sera pas validée. </h6><br>
            <h6>L’inscription entraîne l’ouverture d’un compte au nom du Client , lui donnant accès à un espace personnel qui lui permet de gérer son utilisation des Services sous une forme et selon les moyens techniques que Formation.mg juge les plus appropriés pour rendre lesdits Services.</h6><br>
            <h6>Le Client garantit que toutes les informations qu’il donne dans le formulaire d’inscription sont exactes, à jour et sincères et ne sont entachées d’aucun caractère trompeur.</h6><br>
            <h6>Il s’engage à mettre à jour ces informations dans son Espace Personnel en cas de modifications, afin qu’elles correspondent toujours aux critères susvisés.</h6><br>
            <h6 id="usage"> Client est informé et accepte que les informations saisies aux fins de création ou de mise à jour de son Compte, par lui ou par le biais de l’Administrateur, vaillent preuve de son identité. Les informations saisies par le Client l’engagent dès leur validation.</h6>
        </div>
        <div>
            <h2>Usage strictement personnel, Comptes administrateurs et utilisateurs</h2>
            <h6>Une fois son inscription validée, le Client, ou l’administrateur qu’il aura désigné, dispose de la faculté de créer plusieurs comptes utilisateurs via son Espace Personnel, donnant accès aux Services.</h6><br>
            <h6> appartient au Client ou à l’administrateur de sélectionner les utilisateurs ayant accès à l’Application ou aux Services, dans la limite du nombre maximum prévu dans l’abonnement du Client, de déterminer la nature des accès qui leur sont donnés, ainsi que les données et informations auxquelles ils ont accès.</h6><br>
            <h6>L’utilisateur et/ou l’administrateur peuvent accéder à tout moment au Compte du Client par le biais de leur propre Espace Personnel, après s’être identifiés à l’aide de leur identifiant de connexion ainsi que de leur mot de passe.</h6><br>
            <h6>L’utilisateur et l’administrateur s’engagent à utiliser personnellement les Services et à ne permettre à aucun tiers de les utiliser à leur place ou pour leur compte, sauf à en supporter l’entière responsabilité.</h6><br>
            <h6>Ils sont pareillement responsables du maintien de la confidentialité de leur identifiant et de leur mot de passe, et reconnaissent expressément que toute utilisation des Services depuis leur Compte sera réputée avoir été effectuée par eux. Ces derniers doivent immédiatement contacter Formation;mg s’ils remarquent que leur Compte a été utilisé à leur insu. Ils reconnaissent à formation.mg le droit de prendre toutes mesures appropriées en pareil cas.</h6><br>
            <h6 id="duree">Le Client est responsable de l’utilisation des Services par l’administrateur et les utilisateurs. Toute utilisation des Services avec l’identifiant et le mot de passe d’un Compte administrateur et/ou utilisateur est réputée effectuée par le Client.</h6><br>
        </div>
        <div>
            <h2>Durée de l’abonnement, désinscription</h2>
            <h6>1. La licence d’utilisation de l’Application et l’ensemble des Services prévus aux présentes sont souscrits par le Client sous la forme d’un abonnement mensuel ou annuel, dont la date de début est indiquée dans l’email de confirmation de son inscription. Cet abonnement se renouvellera ensuite tacitement pour une période de même durée, sauf dénonciation par l’une ou l’autre des parties adressée à l’autre partie par tout moyen écrit 8 (huit) jours au moins avant l’expiration de la période en cours.
            </h6><br>
            <h6 id="description">2. Tout abonnement aux Services est souscrit pour une durée indéterminée. La suppression d’un compte ne pourrait pas se faire, du fait que c’est un site collaboratif. Cependant, le client peut suspendre son compte et y avoir accès dès qu’il entre son identifiant et son mot de passe.
            </h6><br>
        </div>
        <div>
            <h2>Description des Services</h2>
            <h6>1. Licence(s) d’utilisation de l’Application</h6>
            <h6 style="margin-left: 10px">1.1 Objet de la licence</h6>
            <h6>A WORLD FOR US concède au Client une licence non exclusive, personnelle et non transmissible d’utilisation de son Application, dans sa version existante à la date des présentes et dans toutes éventuelles versions à venir, aux seules fins de la fourniture des Services.</h6><br>
            <h6>L’accès à l’Application est fourni : </h6><br>
            <ul>
                <li>- Gratuitement en ce qui concerne l’abonnement basique ;</li>
                <li>- Moyennant un abonnement payant concernant les fonctionnalités Premium proposées sur le Site.
                </li>
            </ul>
            <h6>Cette licence est consentie pour le monde entier et pour la durée de l’abonnement souscrit.</h6><br>
            <h6>Il est interdit au Client d’en céder ou d’en transférer le bénéfice à un tiers, quel qu’il soit.</h6><br>
            <h6 style="margin-left: 10px">1.2 Hébergement</h6>
            <h6>Le Client n’autorise aucune utilisation des données collectées par le biais de l’Application par A WORLD FOR US ou par un tiers, qui ne serait pas rendue nécessaire par l’exécution du Contrat, sans son autorisation explicite et écrite.</h6><br>
            <h6>En cas de changement de prestataire d’hébergement, A WORLD FOR US s’engage à en aviser le Client dans les plus brefs délais, par tout moyen écrit utile. L’identité du nouvel hébergeur, ainsi que le territoire dans lequel ses serveurs seront situés s’ils sont hors Europe, seront communiqués au Client.</h6><br>
            <h6>A WORLD FOR US s’engage à mettre en œuvre l’ensemble des moyens techniques conformes à l’état de l’art nécessaires pour assurer la sécurité et l’accès à l’Application et aux Services, portant sur la protection et la surveillance des infrastructures, le contrôle de l’accès physique et/ou immatériel auxdites infrastructures, ainsi que sur la mise en œuvre des mesures de détection, de prévention et de récupération pour protéger ses serveurs d’actes malveillants.</h6><br>
            <h6>Eu égard à la complexité d’Internet, l’inégalité des capacités des différents sous-réseaux, l’afflux à certaines heures des Clients de l’Application, aux différents goulots d’étranglement sur lesquels A WORLD FOR US n’a aucune maîtrise, la responsabilité de A WORLD FOR US sera limitée au fonctionnement de ses propres serveurs, dont les limites extérieures sont constituées par les points de raccordement.</h6><br>
            <h6>A WORLD FOR US ne saurait être tenue pour responsable (i) de l’indisponibilité des serveurs du Client ou de ceux de son système d’exploitation, (ii) des vitesses d’accès à ses serveurs, (iii) des ralentissements externes à ses serveurs, et (iv) des mauvaises transmissions dues à une défaillance ou à un dysfonctionnement de ses réseaux.</h6><br>
            <h6 style="margin-left: 10px">1.3 Maintenance évolutive</h6>
            <h6>A WORLD FOR US s’engage à faire bénéficier le Client des évolutions et mises à jour de son Application, dont la nature et la fréquence seront laissées à la libre appréciation de A WORLD FOR US.</h6><br>
            <h6>A WORLD FOR US se réserve la possibilité de limiter ou de suspendre l’accès à l’Application pendant les opérations de maintenance. Elle informera le Client au préalable par tout moyen utile de la réalisation de ces opérations.</h6><br>
            <h6 style="margin-left: 10px">1.4 Support technique</h6>
            <h6>En dehors des dysfonctionnements et pour toute question liée à la simple utilisation des Services, A WORLD FOR US offre au Client un support technique consistant en une assistance et un conseil.</h6><br>
            <h6>Le support technique est accessible à l’adresse email info@digiforma.com ou par chat.</h6><br>
            <h6 style="margin-left: 10px">1.5 Autres Services</h6>
            <h6>A WORLD FOR US se réserve le droit de proposer tous autres Services ou abonnement qu’elle jugera utile, sous une forme et selon les fonctionnalités et moyens techniques qu’elle estimera les plus appropriés pour rendre lesdits Services. Aucune prestation supplémentaire n’aura lieu sans que le Client n’en ait accepté le prix et les conditions de mise en œuvre de façon expresse, préalable et par écrit.</h6><br>
        </div>
        <div>
            <h2>Conditions financières</h2>
            <h6>1. Prix des Services </h6>
            <h6>En contrepartie de la réalisation des Services, le Client s’engage à payer à A WORLD FOR US le prix de l’abonnement choisi, tel qu’indiqué sur le Site et préalablement à son inscription mensuelle ou annuelle, par virement bancaire.</h6><br>
            <h6>2. Facturation </h6>
            <h6>Les Services font l’objet de factures ponctuelles ou mensuelles communiquées au Client par email et à chaque nouvelle souscription de Service ou d’abonnement.</h6><br>
            <h6 id="condition">3. Révision du Prix </h6>
            <h6>Le Prix a été calculé en fonction de l’abonnement choisi par le Client et des options éventuellement souscrites. Si l’un de ces paramètres venait à évoluer en cours de Contrat, le Prix des Services serait recalculé en conséquence.</h6><br>
            <h6>4. Retards et défauts de paiement
                <h6>De convention expresse entre les parties, tout retard de paiement de tout ou partie d’une somme due à son échéance au titre de l’exécution des Services entraînera automatiquement et sans mise en demeure préalable : (i) la déchéance du terme de l’ensemble des sommes dues par le Client et leur exigibilité immédiate, (ii) la suspension immédiate des Services jusqu’au complet paiement de l’intégralité des sommes dues et (iii) la facturation au profit de A WORLD FOR US d’un intérêt de retard au taux de 3 fois (trois fois) le taux d’intérêt légal, assis sur le montant de l’intégralité des sommes dues par le Client.</h6><br>
        </div> --}}
{{-- <div>
            <h2>Responsabilités et garanties du Client</h2>
            <h6>1. Le Client est seul responsable du respect des lois et règlements en vigueur applicables à son activité. Il est notamment seul responsable du bon accomplissement de toutes les formalités administratives, fiscales et/ ou sociales qui lui incombent en relation avec son utilisation des Services.</h6><br>
            <h6>2. Le Client reconnait être seul responsable du traitement des données à caractère personnel pouvant être collectées à travers les Services et s’engage à respecter la législation applicable. A WORLD FOR US n’intervient qu’en qualité de sous-traitant et met en œuvre les moyens nécessaires au maintien de la sécurité et de la confidentialité desdites données. </h6><br>
            <h6>3.
            Le Client s’interdit, en son nom et au nom des Utilisateurs, de céder, concéder ou transférer tout ou partie de ses droits ou obligations au titre des présentes à un quelconque tiers, y compris si ce tiers a un lien direct ou indirect avec le Client, de quelque manière que ce soit.
            <h6>4.
            Le Client est informé et accepte que la mise en œuvre des Services nécessite qu’il soit connecté à internet et que la qualité des Services dépend directement de cette connexion.
            <h6>5.
            Le Client déclare avoir pris connaissance des caractéristiques et des fonctionnalités de l’Application, qu’il est informé de la configuration technique nécessaire à son utilisation, qu’il a reçu de A WORLD FOR US tous conseils, instructions et précisions qui lui sont nécessaires pour souscrire aux Services en toute connaissance de cause, qu’il dispose ainsi d’une connaissance suffisante des Services et qu’il a, préalablement aux présentes, suffisamment échangé avec A WORLD FOR US pour s’assurer que les Services correspondent à ses attentes, besoins et contraintes.
            <h6>6.
            De façon générale, le Client s’engage à ne rien faire qui puisse, de quelque manière que ce soit, nuire à l’image de marque ou à la réputation de A WORLD FOR US.
            <h6>7.
            Le Client est seul responsable des contenus de toute nature (rédactionnels, graphiques, audios, audiovisuels ou autres) qu’il publie sur l’Application et de toute conséquence qui en découlerait.
            <h6>8.
            Le Client garantit à Formation.mg qu’il dispose de tous les droits et autorisations nécessaires à la diffusion de ces Contenus. Il s’engage à ce que lesdits Contenus soient licites, ne portent pas atteinte à l’ordre public, aux bonnes mœurs ou aux droits de tiers, n’enfreignent aucune disposition législative ou règlementaire et plus généralement, ne soient aucunement susceptibles de mettre en jeu la responsabilité civile ou pénale de Formation.mg.
            Le Client s’interdit ainsi de diffuser, notamment et sans que cette liste soit exhaustive :
            des Contenus pédopornographiques, pornographiques, diffamatoires, injurieux, racistes, obscènes, indécents, choquants, violents, xénophobes ou révisionnistes,
            des Contenus contrefaisants,
            des Contenus attentatoires à l’image d’un tiers,
            des Contenus mensongers, trompeurs ou proposant ou promouvant des activités illicites, frauduleuses ou trompeuses,
            et plus généralement des Contenus susceptibles de porter atteinte aux droits de tiers ou d’être préjudiciables à des tiers, de quelque manière et sous quelque forme que ce soit.
            <h6>9.
            Le Client garantit Formation.mg contre toutes plaintes, réclamations, actions et/ou revendications quelconques que Formation.mg pourrait subir du fait d’un manquement par le Client de l’une quelconque de ses obligations ou garanties aux termes des présentes. Il s’engage à indemniser Formation.mg de tout préjudice qu’il subirait et à lui payer tous les frais, charges et/ou condamnations qu’il pourrait avoir à supporter de ce fait.

        </div> --}}

{{-- </main> --}}
</div>
@endsection
