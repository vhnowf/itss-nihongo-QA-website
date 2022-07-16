<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionHasTag extends Model
{
    use HasFactory;

    protected $table = "question_tag";

    protected $fillable = [
        'question_id',
        'tag_id',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
