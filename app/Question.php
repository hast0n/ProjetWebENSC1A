<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    /**
     * Get the list of quizzes the question belongs to from storage.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function quizzes() {
        return $this->belongsToMany(Quiz::class);
    }

    /**
     * Get the list of answers to the question from storage.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers() {
        return $this->hasMany(Answer::class);
    }

    /**
     * Get the list of answers to the question from storage.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function untaggedAnswers() {
        return $this->answers->map(function ($a) {
            return $a->untagged();
        });
    }
}
