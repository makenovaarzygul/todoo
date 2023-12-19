@extends('layout.app')
@section('contents')
    <div class="container">
        <h1>Внимание!</h1>
        <div class="alert alert-warning">
            <p>Задача "{{ $todo->name }}" начнется через 10 минут.</p>
            <p><strong>Дополнительная информация:</strong> Задача должна быть завершена к {{ $todo->due_date }}.</p>
        </div>

        <h2>{{ $todo->name }}</h2>
        <p>{{ $todo->description }}</p>

        <h3>Список дел:</h3>
        <ul>
            @foreach($todo->items as $item)
                <li>{{ $item->title }}</li>
            @endforeach
        </ul>
    </div>
@endsection
