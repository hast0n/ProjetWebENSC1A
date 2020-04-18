@extends('layouts.app')

@section('title')
    {{ __("Home") }}
@endsection

@section('content')

    <hr class="home-sep">

    <div class="d-flex brand-title align-items-center">
        <img src="{{asset('images/icons/logo_wobg.svg')}}" id="bigBigLogo" alt="{{ config('app.name') }} logo">
        <p style="font-size: 7em !important">
            Bienvenue sur {{ config('app.name', 'Quizflare') }}
        </p>
    </div>

    <hr class="home-sep">

    <div class="d-flex mt-5 w-75 ml-auto mr-auto justify-content-center align-items-center">
        <p class="expo-text mr-5">
            {{ config('app.name') }} est une site collaboratif qui vous permet de créer et de partager des questionnaires
            pour ensuite y jouer et tout cela, peu importe le sujet ! Vous êtes libre de créer et de partager ce que vous voulez
            alors faites vous plaisir !
        </p>
        <img class="home-expo shadow-lg" src="{{ asset('images/computer-desk-electronics-indoors-374074.jpg') }}">
    </div>

    <hr class="home-sep">

    <div class="d-flex mt-5 w-75 ml-auto mr-auto justify-content-center align-items-center">
        <img class="home-expo shadow-lg" src="{{ asset('images/person-writing-on-notebook-669615.jpg') }}">
        <p class="expo-text ml-5">
            {{ config('app.name') }} peut aussi s'avérer être un outils éducatif très performant ! Et oui ! Le saviez-vous ?
            J'pense pas non parce que niveau perf on y est pas vraiment... Mais par contre on peut faire des quiz à but
            éducatif comme par exemple sur le signal ou les stats ou encore Denzel Washington !
            Vous l'aurez compris : TOUT EST PERMIS (et oui c'est vendredi le jour du dépôt alors bon... et vu que je suis confiné et tout seul
            sur ce projet y'a personne pour m'empêcher de me plaindre <span class="brand-gradient">~ how cool is that</span>)
        </p>
    </div>

    <hr class="home-sep">

    <div class="d-flex mt-5 w-75 ml-auto mr-auto justify-content-center align-items-center">
        <p class="expo-text mr-5">
            Sur votre droite une magnifique image qui n'a aucun sens et qui vient d'un dépôt gratuit sans demande de
            créditation de l'auteur comme tout le reste donc on râle pas.
            Au fait ! Si jamais tu te questionne sur l'utilisation du site, un petit bouton rouge-orange avec un point
            d'intérogation en bas à droite de l'écran pourra éventuellement t'aider !
        </p>
        <img class="home-expo shadow-lg" src="{{ asset('images/think-outside-of-the-box-6375.jpg') }}">
    </div>

    <hr class="home-sep">

@endsection

@section('tutos')
    <h3>Page d'accueil</h3>
    <p>
        Bon, y'a pas grand chose à faire ici à part se rediriger vers des section un peu plus intéressantes.
        Essaie de cliquer sur "Explorer" ou de rechercher des quiz avec la barre de recherche. Si ça fonctionne alors
        t'as tout gagné.
    </p>

    <p>D'ailleurs la barre de recherche ne fonctionne pas... Donc pour l'instant ça sert à rien d'essayer.</p>

    <h3>Comment ça marche ?</h3>
    <p>
        Dans cette section tu trouvera toute l'aide dont tu as besoin pour te repérer sur le site !
        Si tu ne trouves pas ta voie, clique sur le symbole "?" en bas à droite de votre écran, il est là pour ça
    </p>
@endsection
