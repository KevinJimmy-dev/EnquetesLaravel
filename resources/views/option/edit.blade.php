@extends('layouts.main')

@section('title', 'Editar opções da enquete ' . $pollOptions->title)

@section('h1-title', 'Editar Opções')

@section('article')
    <article class="col align-self-center">
        @if($errors->any())
            <ul class="errors">
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <h2>Enquete: <strong class="text-info">{{ $pollOptions->title }}</strong></h2>

        <form action="{{ route('update.option', $pollOptions->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <div id="options">
                   
                        @foreach ($pollOptions->options as $option)
                            <div class="my-3">
                                <label for="title" class="form-label">Opção</label>
                            
                                    <abbr title="Excluir Opção">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal{{$option->id}}">
                                            <i class="fa-solid fa-trash" style="cursor: pointer"></i>
                                        </a>
                                    </abbr> 

                                <input type="text" name="title[]" class="form-control" id="title[]" minlength="1" maxlength="100" required value="{{ $option->title }}">
                            </div>
                        @endforeach
                    
                </div>

                <abbr title="Nova Opção" class="float-end">
                    <i class="fa-solid fa-plus my-4" style="cursor: pointer" onclick="newOption();"></i> 
                </abbr>

                <input type="submit" value="Salvar" class="btn btn-primary mt-5">
            </div>
        </form>

        @foreach ($pollOptions->options as $option)
            @foreach ($pollOptions->options as $option)
                <!-- Modal -->
                <form action="{{ route('delete.option', $option->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <div class="modal fade" id="exampleModal{{$option->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                    
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Excluir Opção</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                
                                <div class="modal-body">
                                    Deseja realmente excluir a opção <strong>{{$option->title}}</strong> da enquete?
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <input type="submit" class="btn btn-danger" value="Excluir">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
        @endforeach
    </article>
@endsection