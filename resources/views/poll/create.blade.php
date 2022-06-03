@extends('layouts.main')

@section('title', 'Criar Enquete')

@section('h1-title', 'Criar Enquete')

@section('activeCreate', 'active')

@section('article')
    <article class="col align-self-center">
        @if($errors->any())
            <ul class="errors">
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('store.poll') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Título da Enquete</label>
                <input type="text" name="title" class="form-control" id="title" minlength="5" maxlength="200" required>

                <div class="mb-3 mt-3">
                    <label for="startDate" class="form-label">Data de Inicio da Enquete</label>
                    <input type="date" name="startDate" class="form-control" id="startDate" min="{{ date('Y-m-d') }}" required>
                </div>

                <div class="mb-3 mt-3">
                    <label for="finishDate" class="form-label">Data para Fechamento da Enquete</label>
                    <input type="date" name="finishDate" class="form-control" id="finishDate" min="{{ date('Y-m-d', strtotime($date.'+ 1 days')) }}" required>
                </div>

                <input type="submit" value="Criar" class="btn btn-primary mt-2">
            </div>
        </form>
    </article>
@endsection