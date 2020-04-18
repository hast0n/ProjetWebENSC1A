@extends("layouts.app")

@section("title")
    Profil de {{ Auth::user()->name }}
@endsection

@section("tutos")
    <h3>Page de profil</h3>
    <p>
        Bon, y'a pas grand chose à faire ici à part se rediriger vers des section un peu plus intéressantes.
        Essaie de cliquer sur "Explorer" ou de rechercher des quiz avec la barre de recherche. Si ça fonctionne alors
        t'as tout gagné.
    </p>

    <h3>Comment ça marche ?</h3>
    <p>
        Dans cette section tu trouvera toute l'aide dont tu as besoin pour te repérer sur le site !
        Si tu ne trouves pas ta voie, clique sur le symbole "?" en bas à droite de votre écran, il est là pour ça
    </p>
@endsection

@section("content")
    @card
        @slot('main')
            <h2>Profile de {{ Auth::user()->name }}</h2>
            <hr>

            <h5>Votre email : {{ Auth::user()->email }}</h5>
            <h5>Compte créé le : {{ date_format(Auth::user()->created_at, __("F d, Y")) }}</h5>

            <h2 class="heading">Vos quiz</h2>
            <hr>
            @foreach (Auth::user()->quizzes as $quiz)
                <div class="d-flex w-100 justify-content-between">
                    <a href="{{ route('quizDetail', ['id' => $quiz->id]) }}"
                       class="quiz-item-link w-100">
                        <div class="quiz-item py-2">
                            <div>
                                <h2 class="quiz-title">
                                    {{ $quiz->title }}
                                </h2>
                                <p class="quiz-date">
                                    {{ __("On") }}
                                    {{ date_format($quiz->created_at, __("F d, Y")) }}
                                </p>
                                <p class="quiz-short-description">{{ $quiz->short_description }}</p>
                            </div>
                            <div class="rating">
                                <div>
                                    {{ __('Rated') }}
                                    {{ number_format($quiz->rating(), 1) }}/5
                                    ({{ $quiz->ratings()->count() }})
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="align-self-center">
                        <a href="{{ route('quizEdit', ['id' => $quiz->id]) }}"
                           style="margin: 0 15px; height: auto; padding: 10px; color: #c12626"
                        >Modifier</a>
                    </div>
                </div>
            @endforeach

            <h2 class="heading">Vos questions</h2>
            <hr>
            <question-edit-list :data="{{auth()->user()->questions->map(function($q) { $q["answers"] = $q->answers; return $q; })}}"></question-edit-list>

        @endslot

        @slot('side')
            <h2>Niveau d'accréditation</h2>
            <hr class="w-100 my-2 mb-3">
            @if(Auth::user()->is_admin)
                <h4 class="alert-danger" style="text-align: center; border-radius: 10px">Administrateur</h4>
                <hr class="w-100 my-2 mb-3">
            @else
                <h4 class="alert-info" style="text-align: center; border-radius: 10px">Joueur</h4>
                <hr class="w-100 my-2 mb-3">
            @endif
                <form action="{{ route('switchUserType') }}" method="post">
                    @csrf
                    <button class="btn btn-primary w-100 mt-0">
                        @if(Auth::user()->is_admin)
                            Passer au niveau Joueur
                        @else
                            Passer au niveau Administrateur
                        @endif
                    </button>
                </form>
        @endslot
    @endcard
@endsection
