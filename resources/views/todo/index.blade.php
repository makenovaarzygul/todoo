@extends('layout.app')
@section('contents')

	<div class="container-fluid my-4" >

		<div class="card shadow" style="min-height:90vh ">
			<div class="card-header">
				Список дел
				<a href="{{ route('logout') }}" class="btn btn-sm btn-dark float-right">Выйти</a>
				<a href="{{ route('todo.create') }}" class="btn btn-sm btn-dark float-right mr-2">Добавить</a>
                <a href="{{ route('todo.calendar') }}" class="btn btn-sm btn-dark float-right mr-2">Календарь</a>
                <a class="btn btn-sm float-right ml-2">{{ auth()->user()->name }}</a>


				<button
					data-url="{{ route('todo.destroy.bulk') }}"
					class="btn btn-sm btn-danger mx-1 float-right deleteRequest--bulk
					" style="display: none;">Удалить выбранное</button>
{{--				<button--}}
{{--					data-url="{{ route('todo.edit.bulk') }}"--}}
{{--					class="btn btn-sm btn-outline-info mx-1 float-right editRequest--bulk--}}
{{--					" style="display: none;">Редактировать выбранный статус/приоритет</button>--}}
			</div>
			<div class="card-body ">

				@unless ($todos->count())
					<div class="alert alert-danger">В системе не найдено данных</div>
				@endunless



                    <div class="row todoCards">

		    		@foreach ($todos as $key => $todo)
					<div class="col-lg-4 col-md-6  ">

						<div class="card shadow mb-4">
				  			<div class="card-header">
				  				{{ $todo->name }}

								<span class="badge float-right rounded-0 badge-dark">{{ $todo->status }}</span>
				  				<span class="badge float-right rounded-0 badge-info mx-1">{{ $todo->priority }}</span>

				  			</div>
					  		<div class="card-body">
			  					<table class="table  text-muted table-sm table-borderless">
			  						<tr><td>Создано: </td> <td>{{ $todo->due_date->diffForHumans() }}</td><tr>
			  						<tr><td>Срок выполнения: </td> <td>{{ $todo->due_date }}</td><tr>

			  						<tr><td>Обновлено : </td> <td>{{ $todo->updated_at }}</td><tr>
			  					</table>

					  		</div>
					  		<div class="card-footer p-1">
					  			<span class="border px-2 py-1 text-muted">
					  				<input type="checkbox" id="cp{{ $todo->id }}" value="{{ $todo->id }}" class="mx-2">
					  			<label for="cp{{ $todo->id }}">Выбрать</label>
					  			</span>
					  			<button
						  				data-url="{{ route('todo.destroy',$todo->id) }}"
						  				class="btn btn-sm deleteRequest--btn btn-outline-danger mx-1 float-right "
						  			>Удалить</button>

						  			<a
						  				href="{{ route('todo.edit',$todo->id) }}"
						  				class="btn btn-sm btn-outline-info float-right"
						  			>Редактировать</a>
					  		</div>
				  		</div>

					</div>
		    		@endforeach

				</div>

			</div>
		</div>
	</div>
@include('modals.edit-bulk')
@endsection
