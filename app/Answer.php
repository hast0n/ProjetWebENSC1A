<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    /**
     * Get the specific question from storage.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question() {
        return $this->belongsTo(Question::class);
    }

    /**
     * Get the specific question from storage.
     *
     * @return Answer
     */
    public function untagged() {
        if ($this->question->type == 3) {
            return $this->makeHidden(['text', 'question']);
        }
        else {
            return $this->makeHidden(['is_right_answer', 'question']);
        }
    }
}
