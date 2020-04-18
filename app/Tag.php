<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];
    /**
     * Get popular tags from storage
     *
     * @param null $nb
     * @return Quiz[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public static function popular($nb = null) {
        return Quiz::popular()->map(
            function ($quiz) {
                return $quiz->tags;
            }
        )->flatten()->unique('id')->take($nb);
    }

    /**
     * Fetch all quizzes associated with the tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function quizzes() {
        return $this->belongsToMany(Quiz::class);
    }
}
