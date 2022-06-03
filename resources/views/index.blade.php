@extends('layouts.main')

@section('title', 'Enquetes')

@section('activeIndex', 'active')

@section('h1-title', 'Enquetes')

@section('article')
    <article class="flex-container">   
        @foreach ($allPolls as $poll)
                <div class="card m-3" style="width: 18rem;">
                    <form action="{{ route('vote.option', $poll->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <h5 class="card-title text-center">
                                @if($poll->active == 0)
                                    <strong class="text-danger">Enquete Finalizada</strong>     
                                @elseif($poll->active == 1)
                                    <strong class="text-warning">Enquete não Iniciada</strong>
                                @elseif($poll->active == 2) 
                                    <strong class="text-success">Enquete em Andamento</strong>
                                @else 
                                    <strong class="text-secondary">Enquete sem Opções</strong>
                                    <p>Adicione 3 opções para a enquete ficar ativa!</p>
                                @endif
                            </h5>

                            <p class="card-text"><strong class="text-primary">Título da Enquete:</strong>
                                <strong>{{$poll->title}}</strong>
                                <abbr title="Editar enquete">
                                    <a href="{{ route('edit.poll', $poll->id) }}">
                                        <i class="fa-solid fa-pencil float-end"></i>
                                    </a>
                                </abbr>
                            </p>

                            <strong class="text-success">Data de Início:</strong> <strong>
                                {{ date('d/m/Y', strtotime($poll->startDate)) }}
                            </strong>

                            <br>

                            <strong class="text-danger">Data de Fechamento:</strong> <strong>
                                {{ date('d/m/Y', strtotime($poll->finishDate)) }}
                            </strong>
                        </div>

                        <ul class="list-group list-group-flush">
                        
                            <li class="list-group-item">
                                <label class="m-0"><i class="fa-solid fa-list"></i> <strong>Opções</strong></label>
                                <label class="float-end"><strong>Votos <i class="fa-solid fa-square-poll-vertical"></i></strong></label>
                            </li>

                            @foreach ($poll->options as $option)
                                <li class="list-group-item">
                                    <input type="radio" name="vote" id="option{{$option->id}}" value="{{$option->id}}">
                                    <label for="option{{$option->id}}">{{$option->title}}</label>
                                    <label class="float-end text-primary">{{ $option->totalVotes }}</label>
                                </li>
                            @endforeach

                        </ul>
                        
                        <div class="card-body mb">
                            <a href="{{ route('edit.option', $poll->id) }}">
                                <i class="fa-solid fa-pencil float-start me-2"></i>
                                Editar opções

                                <br>
                            </a>

                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal{{$poll->id}}">
                                <i class="fa-solid fa-trash float-start me-2"></i>
                                Excluir enquete
                            </a>

                            @if($poll->active == 0 || $poll->active == 1 || $poll->active == -1)
                                <input type="submit" class="card-link btn btn-primary float-end mb-2" value="Votar" disabled>
                            @else
                                <input type="submit" class="card-link btn btn-primary float-end mb-2" value="Votar">
                            @endif  
                        </div>
                    </form>

                    <!-- Modal -->
                    <form action="{{ route('delete.poll', $poll->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="modal fade" id="exampleModal{{$poll->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                        
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Excluir Enquete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        Deseja realmente excluir a enquete <strong>{{$poll->title}}</strong>?
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <input type="submit" class="btn btn-danger" value="Excluir">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        @endforeach

    </article>
@endsection