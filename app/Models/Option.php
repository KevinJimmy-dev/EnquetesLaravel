<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'poll_id',
        'totalVotes'
    ];

    public function poll(){
        return $this->belongsTo('App\Models\Poll');
    }

    public static function searchOptions($poll_id){
        $options = Option::where([['poll_id', $poll_id]])
                           ->get();

        return $options;
    }

    public static function vote($id){
        $totalVotes = Option::select('totalVotes')
                            ->where('id', $id)
                            ->first();

        if($totalVotes == null){
            return null;
        }

        $vote = Option::where('id', $id)
                      ->update(['totalVotes' => $totalVotes->totalVotes + 1]);

        return $vote;
    }
}
