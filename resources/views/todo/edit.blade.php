@extends('layout.app')
@section('contents')

    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                Редактировать задачу
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark float-right">Назад</a>
            </div>
            <div class="card-body">
                <form method="POST" class="appForm" action="{{ route('todo.update',$todo->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="col-12 form-group">
                            <label>Название</label>
                            <input type="text" class="form-control" name="name"  value="{{ $todo->name }}" />
                        </div>


                        <div class="col-md-6 form-group">
                            <label>Срок выполнения</label>
                            <input type="datetime-local" class="form-control form-control-sm" name="due_date" value="{{ $todo->due_date->format('Y-m-d\TH:i:s') }}" />
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Статус</label>
                            <select class="form-control form-control-sm" name="status">
                                <option value="Не закончена" {{ $todo->status === 'Не закончена' ? 'selected' : '' }}>Не закончена</option>
                                <option value="Выполнена" {{ $todo->status === 'Выполнена' ? 'selected' : '' }}>Выполнена</option>
                                <option value="Отменена" {{ $todo->status === 'Отменена' ? 'selected' : '' }}>Отменена</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Приоритет</label>
                            <input type="number" min="1" class="form-control form-control-sm"  value="{{ $todo->priority }}" name="priority"  />
                        </div>

                        <div class="col-12 form-group ">
                            Элементы списка дел
                        </div>

                        <div class="col-12 itemsContainer">

                            @foreach ($todo->items as $item)
                                <div class="input-group mb-1 item">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" aria-label="">
                                        </div>
                                    </div>
                                    <input type="text" name="items[]" class="form-control form-control-sm" value="{{ $item->title }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary btn-sm deleteItem--btn" type="button" >Удалить</button>
                                    </div>
                                </div>
                            @endforeach

                            <div class="input-group mb-1 item">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" aria-label="">
                                    </div>
                                </div>
                                <input type="text" name="items[]" class="form-control form-control-sm" placeholder="Новый элемент" >
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm deleteItem--btn" type="button" >Удалить</button>
                                </div>
                            </div>

                        </div>

                        <div class="col-12">
                            <button class="btn btn-outline-success btn-sm addItem--btn"  type="button">Добавить элемент</button>
                            <button class="btn btn-outline-danger btn-sm removeSelected--btn"  type="button" style="display: none;">Удалить выбранные</button>
                        </div>

                    </div>
                    <div class="appForm--response my-2"></div>
                    <button class="btn btn-dark btn-sm float-right ">Обновить</button>
                </form>
            </div>
        </div>
    </div>

@endsection
