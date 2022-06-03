@extends('layouts.main')

@section('title', 'Editar Enquete: ' . $poll->title)

@section('h1-title', 'Editar Enquete: ' . $poll->title)

@section('article')
    <article class="col align-self-center">
        @if($errors->any())
            <ul class="errors">
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('update.poll', $poll->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Título da Enquete</label>
                <input type="text" name="title" class="form-control" id="title" minlength="5" maxlength="200" required value="{{ $poll->title }}">

                <div class="mb-3 mt-3">
                    <label for="date" class="form-label">Data para Fechamento da Enquete</label>
                    <input type="date" name="finishDate" class="form-control" id="date" min="{{ date('Y-m-d') }}" required value="{{ $poll->finishDate }}">
                </div>

                <input type="submit" value="Salvar" class="btn btn-primary mt-2">
            </div>
        </form>
    </article>
@endsection