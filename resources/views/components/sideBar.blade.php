{{ $info ?? '' }}
<div class="popular-tags">
    <h2>{{ __("Popular tags") }}</h2>
    <hr>
    <div class="content">
        @foreach($sharedData["popularTags"] as $tag)
            <a class="tag"
               href="{{ route('quiz', ['lang' => app()->getLocale(), 'tag' => $tag->name]) }}">
                {{ $tag->name }}
            </a>
        @endforeach
    </div>
</div>
<div class="popular-quizzes">
    <h2>{{ __("Popular quizzes") }}</h2>
    <hr>
    <div class="d-flex flex-column">
        @foreach($sharedData["popularQuizzes"] as $quiz)
            <a class="popular-quizzes-row"
               href="{{ route('quizDetail', ['lang' => app()->getLocale(), 'id' => $quiz->id]) }}">
                <p>
                    {{ sprintf("%02d", $loop->index + 1) }}
                </p>
                <div>
                    <p>
                        {{ $quiz->title }}
                    </p>
                    <p>
                        {{ __("On") }}
                        {{ date_format($quiz->created_at, __("F d, Y")) }}
                        -
                        {{ $quiz->author->name }}
                    </p>
                </div>
            </a>
        @endforeach
    </div>
</div>
