<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'startDate',
        'finishDate',
        'totalOptions',
        'active'
    ];

    public function options(){
        return $this->hasMany('App\Models\Option');
    }

    public static function verifyPolls($polls){
        for($i = 0; $i < count($polls); $i++){
            $date = date('Y-m-d');

            if($polls[$i]->finishDate == $date){
                Poll::closePoll($polls[$i]->id);

            } elseif($polls[$i]->startDate > $date){
                Poll::where('id', $polls[$i]->id)
                    ->update(['active' => 1]);
            }
            
            if($polls[$i]->totalOptions < 3){
                Poll::where('id', $polls[$i]->id)
                    ->update(['active' => -1]);
            }
        }
    }

    public static function closePoll($id){
        Poll::where('id', $id)
            ->where('active', 1)
            ->orWhere('active', 2)
            ->update(['active' => 0]);
    }

    public static function searchPoll($title){
        $poll = Poll::where([['title', $title]])
                    ->get()
                    ->first();
        
        return $poll;
    }

    public static function pollOptionsId($poll_id){
        $pollOptions = Poll::where([['id', $poll_id]])
                           ->with('options')->first();

        return $pollOptions;
    }

    public static function pollOptionsAll(){
        $pollOptions = Poll::with('options')
                           ->orderBy('active', 'desc')
                           ->get();

        return $pollOptions;
    }

    public static function pollUpdate($poll_id, $totalOptions){
        Poll::where('id', $poll_id)
            ->update(['totalOptions' => $totalOptions, 
                      'active' => 2]);
    }
}
