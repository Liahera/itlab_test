@extends('layouts.admin')
@section('content')

    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <h1>Добавить статью</h1>
        <br>
        <form method="post">
            {!! csrf_field() !!}
            <p>Название статьи:<br><input type="text" name="title" class="form-control" required> </p>
            <p>Текст:<br><textarea name="text" class="form-control"></textarea></p>
            <button type="submit" class="btn btn-success" style="cursor: pointer; float: right;">Добавить</button>
            <br><br>
        </form>
    </main>
    <script>

        CKEDITOR.replace( 'text' );
    </script>
@stop
