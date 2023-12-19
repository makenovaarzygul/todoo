<form action="{{ route('todo.edit.bulk.submit') }}" class="appForm">
@csrf
@method('PUT')
<div class="row">
	@foreach ($todos as $todo)
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">{{ $todo->name }}</div>
				<div class="card-body">
                    <div class="col-md-6 form-group">
                        <label>Status</label>
                        <select class="form-control form-control-sm" name="status">
                            <option value="Не закончена" {{ $todo->status === 'Не закончена' ? 'selected' : '' }}>Не закончена</option>
                            <option value="Выполнена" {{ $todo->status === 'Выполнена' ? 'selected' : '' }}>Выполнена</option>
                            <option value="Отменена" {{ $todo->status === 'Отменена' ? 'selected' : '' }}>Отменена</option>
                        </select>
                    </div>

                    <div class="form-group">
						<label>Priority</label>
						<input type="number" min="1" name="priority[{{ $todo->id }}]" class="form-control form-control-sm"  value="{{ $todo->priority }}">
					</div>
				</div>
			</div>
		</div>
	@endforeach
	<div class="col-12 my-2 appForm--response"></div>
	<div class="col-12">
		<button class="btn btn-dark btn-submit appForm--submit btn-sm float-right">Update</button>
	</div>
</div>

</form>
