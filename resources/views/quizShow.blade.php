@extends("layouts.play")

@section("title")
    {{ $quiz->title }}
@endsection

@section("tutos")
    <h3>Jouer à un quiz !</h3>

    <p>
        Dans cette section du site, vous allez pouvoir jouer au quiz proposé par l'un des utilisateurs de Quizflare !
        Vous êtes donc sur la "page d'accueil" du quiz en question, vous pouvez voir les informations que l'auteur à
        souhaité partager avec les utilisateurs de Quizflare.
    </p>

    <p>
        Pour démarrer le quiz, cliquez sur le gros bouton rouge intitulé "Démarrer le quiz". Vous allez ensuite pouvoir
        commencer à répondre aux questions. Si jamais vous ne trouvez pas le bouton "Valider" pour envoyer votre réponse
        à une question, naviguez vers le bas sur la zone des questions, le bouton devrait apparaître !
    </p>

    <p>
        Une fois le quiz terminé,
    </p>
@endsection

@section("main")

    <h2 class="quiz-play-title" title="{{ $quiz->title }}">{{ $quiz->title }}</h2>
    <hr>

    <h2 class="quiz-play-author" title="{{ $quiz->author->name }}">
        Créé par {{ $quiz->author->name }}
        le {{ date_format($quiz->created_at, __("F d, Y")) }}
    </h2>

    <h4 class="mt-4">{!! __("Short Description") !!}</h4>
    <h5 class="quiz-short-description">{{ $quiz->short_description }}</h5>

    @isset($quiz->long_description)
        <h4 class="mt-4">{!! __("Additional Information") !!}</h4>
        <h5 class="quiz-short-description">{{ $quiz->long_description }}</h5>
    @endisset


    <quiz-play-context :quiz-id="{{ $quiz->id }}" :question-data="{{ $quiz->questions }}"></quiz-play-context>

    <h2 class="mt-5">Les meilleurs scores</h2>
    <hr>
    <p>Ci-dessous, la liste des 10 meilleurs scores réalisés sur ce quiz.</p>
    <best-scores :data="{{ $quiz->scores()->orderBy('quiz_user.correct_ratio', 'desc')->get()->makeHidden(['created_at', 'email', 'email_verified_at', 'id', 'is_admin', 'updated_at']) }}"></best-scores>

@endsection

@section('side')

@endsection
