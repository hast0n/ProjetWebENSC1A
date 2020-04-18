@extends('layouts.quizzes')

@section("title")
    {{ __("Explore") }}
@endsection

@section('tutos')
    <h3>Parcourez les quizs !</h3>
    <p>
        Ici vous pouvez parcourir les quizs postés par les utilisateurs. Sur votre gauche les quizs les plus récents et
        sur votre droite, ceux les mieux notés ! Vous trouverez aussi en hait à droite une section dédiée aux tags les
        plus populaires en ce moment, ils vous permettent d'affiner votre recherche pour rapidement trouver ce qui vous
        intéresse le plus.
    </p>
@endsection

@section('main')

    <h2>
        {{ __("Most latest posts") }}
        @if($tag != null)
            <p>
                #{{ $tag->name }}
            </p>
        @endif
    </h2>

    <hr>

    @foreach ($latestQuizzes as $quiz)
        <a href="{{ route('quizDetail', ['id' => $quiz->id]) }}"
           class="quiz-item-link">
            <div class="quiz-item">
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
                        {{ __("By") }}
                        {{ $quiz->author->name }}
                        -
                        {{ __('Rated') }}
                        {{ number_format($quiz->rating(), 1) }}/5
                        ({{ $quiz->ratings()->count() }})
                    </div>
                </div>
            </div>
        </a>
    @endforeach
@endsection
