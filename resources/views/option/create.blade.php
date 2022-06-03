@extends('layouts.main')

@section('title', 'Criar opções para a enquete ' . $pollOptions->title)

@section('h1-title', 'Criar Opções')

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

        <form action="{{ route('store.option', $pollOptions->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <div id="options">
                    <label for="title" class="form-label">Opção 1</label>
                    <input type="text" name="title[]" class="form-control" id="title[]" minlength="1" maxlength="100" required value="{{ old('title[]') }}">

                    <label for="title" class="form-label">Opção 2</label>
                    <input type="text" name="title[]" class="form-control" id="title[]" minlength="1" maxlength="100" required value="{{ old('title[]') }}">

                    <label for="title" class="form-label">Opção 3</label>
                    <input type="text" name="title[]" class="form-control" id="title[]" minlength="1" maxlength="100" required value="{{ old('title[]') }}">
                </div>

                <abbr title="Nova Opção" class="float-end">
                    <i class="fa-solid fa-plus my-4" style="cursor: pointer" onclick="newOption();"></i> 
                </abbr>

                <input type="submit" value="Salvar" class="btn btn-primary mt-5">
            </div>
        </form>
    </article>
@endsection