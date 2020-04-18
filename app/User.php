<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use phpDocumentor\Reflection\Types\This;
use App\Quiz;
use App\Score;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Fetch all quizzes made by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quizzes() {
        return $this->hasMany(Quiz::class);
    }

    /**
     * Fetch all questions made by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions() {
        return $this->hasMany(Question::class);
    }

    /**
     * Fetch all quizzes'scores scored by user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function scores() {
        return $this->BelongsToMany(Quiz::class)
            ->withTimestamps()
            ->withPivot('correct_ratio', 'time_passed');
    }
}
