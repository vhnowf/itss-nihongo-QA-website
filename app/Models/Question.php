<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'type',
        'owner_id',
        'tag_id',
        'comment_id',
        'views',
        'status',
    ];

    public function user()
    {
      return $this->belongsTo(User::class, 'owner_id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

    public function vote()
    {
        return $this->hasMany(Vote::class);
    }

    public function bookmark()
    {
        return $this->hasMany(Bookmark::class);
    }
}
