<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public $timestamps = true;

    protected $guarded = [];

    /**
     * Get latest quizzes with tag or not from storage
     *
     * @param $nb
     * @param null $tag
     * @return mixed
     */
    public static function latest($nb, $tag = null) {
        return $tag->quizzes ?? Quiz::take($nb)->latest()->get();
    }

    /**
     * Get popular quizzes from storage
     *
     * @return Quiz[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function popular($nb = null) {
        return Quiz::all()
        ->sortByDesc(
            function ($quiz) {
                return $quiz->rating();
            }
        )->sortByDesc(
            function ($quiz) {
                return $quiz->ratings()->count();
            }
        )->take($nb);
    }

    /**
     * Get the creator of the quiz from storage.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the associated questions from storage.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questions() {
        return $this->BelongsToMany(Question::class);
    }

    /**
     * Get the associated tags from storage.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get user's evaluation from storage.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings() {
            return $this->hasMany(Rating::class);
    }

    /**
     * Get user's evaluation from storage.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rating() {
        return $this->ratings()->average('rating');
    }

    /**
     * Fetch all quizzes'scores scored by user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function scores() {
        return $this->BelongsToMany(User::class)
            ->withTimestamps()
            ->withPivot('correct_ratio', 'time_passed');
    }
}
