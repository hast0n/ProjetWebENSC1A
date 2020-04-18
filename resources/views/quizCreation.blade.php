@extends("layouts.quizzes")

@section("title")
    {{ __("Create a quiz") }}
@endsection

@section('main')

    <h2>{{ __("Create a quiz") }}</h2>
    <hr>

    <form class="quiz-creation-form"

          @isset($quiz) action="{{ route('quizUpdate', ["id" => $quiz->id]) }}"
          @else action="{{ route('quizStore') }}"
          @endisset

          method="post">

        @csrf

        <div class="form-item hover-indicator">
            <label for="title">{!! __("Title") !!}</label>
            <input class="form-control glow" id="title" type="text" @isset($quiz) value="{{ $quiz->title }}" @endisset
                   name="title" placeholder="{!! __("An awesome title...") !!}" required/>
        </div>

        <div class="form-item hover-indicator">
            <label for="short_desc">{!! __("Short Description") !!}</label>
            <textarea rows="2" name="short_description" class="form-control glow" id="short_desc"
                      placeholder="{!! __("Give your quiz a short description...") !!}" required
            >@isset($quiz){{ $quiz->short_description }}@endisset</textarea>
        </div>

        <div class="form-item hover-indicator">
            <label for="add_info">{!! __("Additional Information") !!}</label>
            <textarea name="additional_information" id="add_info" rows="2" class="form-control glow"
                      placeholder="{!! __("Give additional information about your thoughts on this quiz or whatever...") !!}"
            >@isset($quiz){{ $quiz->long_description }}@endisset</textarea>
        </div>

        <div class="form-item difficulty-level hover-indicator">
            <label for="difficulty_level">{!! __("Difficulty Level") !!} :</label>
            <select name="difficulty_level" id="difficulty_level" class="form-control form-select-button glow" required>
                <option value="" selected disabled hidden>
                    {!! __("-- Select One --") !!}
                </option>

                @php
                $options = [
                    0 => __("Casual"),
                    1 => __("Easy"),
                    2 => __("Medium"),
                    3 => __("Hard"),
                    4 => __("Expert")
                ];
                @endphp

                @foreach ($options as $value => $levelName)
                    <option value="{!! $value !!}"
                        @isset($quiz)
                            @if($quiz->difficulty_level == $value)
                                selected
                            @endif
                        @endisset
                    >{!! $levelName !!}</option>
                @endforeach
            </select>
        </div>

        <div class="quiz-picture-input">
            <label>{!! __("Picture") !!} :</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">{!! __("Upload") !!}</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                           aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">{!!  __("Choose picture to illustrate your quiz") !!}</label>
                </div>
            </div>
        </div>



        @isset($quiz)
            <input type="submit" value="{!! __("Save") !!}" class="btn btn-primary">
            </form>
            <h2 style="margin-top: 50px;">{!! __("Add questions") !!}</h2>
            <hr>
            <question-create-list :quiz-id="{{$quiz->id}}" :quiz-questions="{{$quiz->questions}}"></question-create-list>

            <h2 style="margin-top: 50px;">Supprimer le quiz</h2>
            <hr>
            <form action="{{ route('quizDestroy', ["id" => $quiz->id]) }}" method="post">
                @csrf
                <h5>Vous souhaitez supprimer définitivement votre quiz ? C'est ici !</h5>
                <p>Gardez bien en tête que les questions associées ne seront pas supprimées par cette opération.</p>
                <button type="submit" onSubmit="return confirm('Êtes-vous sûr(e) de vouloir supprimer le quiz ?');" class="btn btn-primary mt-0">Supprimer</button>
            </form>
        @else
            <hr>
            <p class="mt-5">Enregistrez le quiz pour pouvoir y ajouter des questions.</p>
            <input type="submit" value="{!! __("Save") !!}" class="btn btn-primary mt-0">
            </form>
        @endisset

@endsection

@section('scripts')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endsection

@section('tutos')
    <h3>Créer un quiz !</h3>
    <p>
        C'est ici que se passe la création des quiz ! Vous pouvez alors une fois votre quiz enregistré, le partager
        avec tout le monde ! Il vous faudra ensuite ajouter des questions
    </p>

    <h3>Comment ça marche ?</h3>
    <p>
        Commencez par définir le titre du quiz qui permettra au utilisateurs d'avoir un aperçu général du contenu de votre quiz.
        Ensuite, définissez une courte description expliquant le pourquoi du comment du quiz. Elle sera affichée en dessous du
        titre lors de la navigation parmi les quizs, elle permet de donner plus d'indications sur le contenu de votre quiz.
        Les informations supplémentaires sont là pour communiquer un message additionnel sur votre quiz, elles n'apparaitront
        pas dans la navigation mais uniquement lorsque l'utilisateur viendra répondre à votre quiz.
    </p>

    <p>
        Une fois que toutes ces informations seront enregistrés, la pages sera alors rafraîchie et vous pourrez
        ajouter ou encore supprimer des questions de votre quiz.
    </p>

    <p>
        Si vous souhaitez supprimer votre quiz, c'est tout en bas de la page que ça se passe, le bouton supprimer fait
        très bien son job d'ailleurs il demande pas de confirmation donc évitez les clics un peu aléatoires... À savoir que
        la suppression d'un quiz n'entraîne pas la suppresion des questions associées, donc vous pourrez facilement
        le reconstruire si un problème venait à se produire...
    </p>
@endsection
