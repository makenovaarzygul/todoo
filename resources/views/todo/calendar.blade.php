
@extends('layout.app')
@section('contents')

    <div class="container-fluid my-4" >

        <div class="card shadow" style="min-height:90vh ">
            <div class="card-header">
                Список дел
                <a href="{{ route('logout') }}" class="btn btn-sm btn-dark float-right">Выйти</a>
                <a href="{{ route('todo.create') }}" class="btn btn-sm btn-dark float-right mr-2">Добавить</a>
                <a href="{{ route('todo.index') }}" class="btn btn-sm btn-dark float-right mr-2">Cтандартный</a>
                <a class="btn btn-sm float-right ml-2">{{ auth()->user()->name }}</a>


              </div>
            <div class="card-body ">

                <div class="container my-4">
                    <h2>Календарь</h2>
                    <div class=" flex-row">
                        <label for="viewSelector" class="form-label">Выберите представление календаря:</label>
                        <select id="viewSelector" class="form-select form-control col-md-4">
                            <option value="dayGridMonth">Месяц</option>
                            <option value="dayGridWeek">Неделя</option>
                            <option value="timeGridDay">День</option>
                            <option value="listWeek">Список на неделю</option>
                        </select>
                    </div>

                    <div id="calendar"></div>
                </div>

                <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var calendarEl = document.getElementById('calendar');
                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            initialView: 'dayGridMonth', // Начальное представление календаря
                            locale: 'ru', // Устанавливаем русский язык
                            events: [
                                    @foreach($todos as $todo)
                                {
                                    title: '{{ $todo->name }}',
                                    start: '{{ $todo->due_date }}',
                                    url: '{{ route('todo.edit', $todo->id) }}'
                                },
                                @endforeach
                            ],
                            eventDidMount: function(info) {
                                // Добавляем стили для событий задач
                                var element = info.el;
                                element.style.backgroundColor = 'lightblue';
                                element.style.borderColor = 'blue';
                            }
                        });
                        calendar.render();

                        // Обработчик изменения значения выбранного представления
                        document.getElementById('viewSelector').addEventListener('change', function() {
                            var selectedValue = this.value;
                            calendar.changeView(selectedValue);
                        });
                    });
                </script>

            </div>
        </div>
    </div>
@endsection
