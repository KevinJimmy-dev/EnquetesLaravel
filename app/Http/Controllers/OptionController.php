<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOptionRequest;
use App\Models\{
    Poll,
    Option
};
use Illuminate\Http\Request;

class OptionController extends Controller{
    
    public function create(){
        $poll_id = request('id');

        $pollOptions = Poll::pollOptionsId($poll_id);

        return view('option.create', ['pollOptions' => $pollOptions]);
    }

    public function store(StoreOptionRequest $request){
        $info = $request->all();

        for($i = 0; $i < count($info['title']); $i++){
            $option[$i] = new Option();

            $option[$i]->title = $info['title'][$i];
            $option[$i]->poll_id = $request->id;

            $option[$i]->save();
        }

        if($option){
            Poll::pollUpdate($request->id, count($info['title']));

            return redirect()->route('index.poll')->with('success', 'Opções adicionadas com sucesso!');

        } else{
            return redirect()->route('index.poll')->with('error', 'Erro ao adicionar opções...');
        }
    }

    public function edit($id){
        if(!$poll = Poll::pollOptionsId($id)){
            return redirect()->back();
        }

        return view('option.edit', ['pollOptions' => $poll]);
    }

    public function update(StoreOptionRequest $request, $id){
        if(!$poll = Poll::find($id)){
            return redirect()->back();
        }

        $newOptions = count($request->title) - $poll->totalOptions;
        $newTotalOptions = count($request->title);

        if($newOptions == 0){
            $options = Option::searchOptions($id);

            for($i = 0; $i < count($request->title); $i++){
                $options[$i]->update([
                    'title' => $request->title[$i]
                ]);
            }

            if($options){
                return redirect()->route('index.poll')->with('success', 'Alterações realizadas  com sucesso!');

            } else{
                return redirect()->back()->with('error', 'Erro ao editar as opções!');
            }
        } else{
            for($i = $poll->totalOptions; $i < $newTotalOptions; $i++){
                $new[$i] = new Option();
    
                $new[$i]->title = $request->title[$i];
                $new[$i]->poll_id = $request->id;
    
                $new[$i]->save();
            }

            if($new){
                Poll::pollUpdate($request->id, $newTotalOptions);

                return redirect()->route('index.poll')->with('success', 'Alterações concluidas!');

            } else{
                return redirect()->back()->with('error', 'Erro ao fazer alterações!');
            }
        }
    }

    public function delete(Request $request){
        $id = $request['id'];

        if(!$option = Option::find($id)){
            return redirect()->back();
        }

        $totalOptionsPoll = Poll::select('totalOptions')
                                ->where('id', $option->poll_id)
                                ->first();

        if($option->delete()){
            Poll::where('id', $option->poll_id)
                ->update(['totalOptions' => $totalOptionsPoll->totalOptions - 1, 
                        'active' => 2]);

            return redirect()->route('edit.option', [$option->poll_id])->with('success', 'Remoção concluida!');

        } else{
            return redirect()->route('edit.option', [$option->poll_id])->with('error', 'Erro ao excluir opção!');
        }
    }
    
    public function vote(Request $request){
        $vote = Option::vote($request->vote);

        if($vote){
            return redirect()->route('index.poll')->with('success', 'Votado com sucesso!');
            
        } else{
            return redirect()->route('index.poll')->with('error', 'Selecione uma opção para votar!');
        }
    }
}

