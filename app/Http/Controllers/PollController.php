<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePollRequest;
use App\Http\Requests\StoreUpdateRequest;
use App\Models\Poll;
use Illuminate\Http\Request;

class PollController extends Controller{
    
    public function index(){
        $allPolls = Poll::all();

        Poll::verifyPolls($allPolls);

        $allPollsOptions = Poll::pollOptionsAll();

        $date = date('Y-m-d');

        return view('index', ['allPolls' => $allPollsOptions, 'date' => $date]);
    }

    public function create(){
        $date = date('Y-m-d');

        return view('poll.create', ['date' => $date]);
    }

    public function store(StorePollRequest $request){
        $info = $request->all();

        $info['active'] = -1;

        $searchResult = Poll::searchPoll($info['title']);

        if($info['startDate'] > $info['finishDate']){
            return redirect()->back()->with('error', 'A data de inicio deve ser menor do que a final!');
            
        } elseif($info['startDate'] == $info['finishDate']){
            return redirect()->back()->with('error', 'A data de inicio deve ser diferente da final!');
        }

        if($searchResult == null){
            $poll = Poll::create($info);

            return redirect()->route('create.option', $poll->id)->with('warning', 'Cadastre no minimo 3 opções para abrir a enquete!');

        } else{
            return redirect()->route('index.poll')->with('error', 'Já existe uma enquete com esse título!');
        }
    }

    public function edit($id){
        if(!$poll = Poll::find($id)){
            return redirect()->back();
        }

        return view('poll.edit', ['poll' => $poll]);
    }

    public function update(StorePollRequest $request, $id){
        if(!$poll = Poll::find($id)){
            return redirect()->back();
        }

        $poll->update([
            'title' => $request->title,
            'startDate' => $request->startDate,
            'finishDate' => $request->finishDate
        ]);

        if($poll){
            return redirect()->route('index.poll')->with('success', 'Enquete editada com sucesso!');
            
        } else{
            return redirect()->route('index.poll')->with('error', 'Erro ao editar a enquete!');
        }
    }

    public function delete(Request $request){
        $id = $request['id'];

        if(!$poll = Poll::find($id)){
            return redirect()->back();
        }

        if($poll->delete()){
            return redirect()->route('index.poll')->with('success', 'Enquete removida com sucesso!');

        } else{
            return redirect()->route('index.poll')->with('error', 'Erro ao excluir enquete!');
        }
    }
}
