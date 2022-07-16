<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  use HasFactory;

  protected $table = 'answers';

  protected $fillable=[
    'content',
    'question_id',
    'user_id'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function vote()
  {
      return $this->hasMany(Vote::class);
  }
}
