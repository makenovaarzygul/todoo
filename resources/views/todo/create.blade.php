@extends('layout.app')
@section('contents')

    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                Добавить задачу
                <a href="{{ route('todo.index') }}" class="btn btn-sm btn-dark float-right">Назад</a>
            </div>
            <div class="card-body">
                <form method="POST" class="appForm" action="{{ route('todo.store') }}">
                    @csrf
                    <div class="row">

                        <div class="col-12 form-group">
                            <label>Название</label>
                            <input type="text" class="form-control form-control-sm" name="name"  />
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Срок выполнения</label>
                            <input type="datetime-local" class="form-control form-control-sm" name="due_date" value="{{ date('Y-m-d\TH:i:s') }}" />
                            @error('due_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Статус</label>
                            <select class="form-control form-control-sm" name="status">
                                <option value="Не закончена">Не закончена</option>
                                <option value="Выполнена">Выполнена</option>
                                <option value="Отменена">Отменена</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Приоритет</label>
                            <input type="number" min="1" class="form-control form-control-sm" name="priority" value="1"  />
                            @error('priority')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 form-group">
                            Элементы списка дел
                        </div>

                        <div class="col-12 itemsContainer">
                            <div class="input-group mb-1 item">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" aria-label="">
                                    </div>
                                </div>
                                <input type="text" name="items[]" class="form-control form-control-sm" placeholder="Название элемента" >
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
                    <button class="btn btn-dark btn-sm float-right" type="submit">Создать</button>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('custom-script')

<script type="text/javascript">
    const App = {
    init() {
        $(document).on('submit','.appForm',App.submitAppForm);
        $(document).on('click','.deleteItem--btn',App.deleteItem);
        $(document).on('click','.addItem--btn',App.addItem);
        $(document).on('click','.deleteRequest--btn',App.deleteRequest);
        $(document).on('click','.deleteRequest--bulk',App.deleteRequestBulk);
        $(document).on('click','.todoCards input[type=checkbox]',App.handleCheckboxClick);
        $(document).on('click','.editRequest--bulk',App.handleBulkEditClick);
        $(document).on('click','.itemsContainer input[type=checkbox]',App.handleItemCheckboxClick);
        $(document).on('click','.removeSelected--btn',App.handleRemoveItemSelected);
    },

    //todos
    //items
    deleteItem() {
        $(this).parent().parent().remove();
    },
    handleItemCheckboxClick() {
        let selectedData = [];
        $(".itemsContainer").find("input[type=checkbox]").each(function(){
            if($(this).is(':checked'))
            selectedData.push($(this).val());
        });
        if(!selectedData.length)
            $('.removeSelected--btn').hide();
        else
            $('.removeSelected--btn').show();
    },
    handleRemoveItemSelected(){
        $(".itemsContainer").find("input[type=checkbox]").each(function(){
            if($(this).is(':checked'))
                $(this).parent().parent().parent().remove();
        });
        $(this).hide();
    },

    addItem(){
        $('.itemsContainer').append(`
            <div class="input-group mb-1 item">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="checkbox" aria-label="">
                    </div>
                </div>
                <input type="text" name="items[]" class="form-control form-control-sm" placeholder="Item name" >
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary btn-sm deleteItem--btn" type="button" >Delete</button>
                </div>
            </div>
        `);
    },


    deleteRequestBulk(){
        let selectedData = [];
        let route = event.target.getAttribute('data-url');

        $(".todoCards").find("input[type=checkbox]").each(function(){
            if($(this).is(':checked'))
            selectedData.push($(this).val());
        });
        if(!selectedData.length){
            alert('Select atleast one card');
            return false;
        }
        if(!confirm('Вы действительно хотите удалить?')) return false;
        axios.post(route,{
            ids : selectedData
        }).then((response) => {
            location.reload();
        }).catch((error) => {
            console.error(error);
            alert("Error in deleting contact support");
        });
    },

    handleCheckboxClick() {
        let selectedData = [];
        $(".todoCards").find("input[type=checkbox]").each(function(){
            if($(this).is(':checked'))
            selectedData.push($(this).val());
        });
        if(!selectedData.length)
            $('.deleteRequest--bulk,.editRequest--bulk').hide();
        else
            $('.deleteRequest--bulk,.editRequest--bulk').show();
    },


    handleBulkEditClick(){
        let selectedData = [];
        let route = event.target.getAttribute('data-url');
        let modal = $('#editModal');

        $(".todoCards").find("input[type=checkbox]").each(function(){
            if($(this).is(':checked'))
            selectedData.push($(this).val());
        });
        if(!selectedData.length){
            alert('Select atleast one card');
            return false;
        }
        modal.modal();
        modal.find('.modal-body').html('Loading...');

        axios.post(route, {
          ids : selectedData
        }).then((response) => {
          modal.find('.modal-body').html(response.data)
        }).catch((error) => {
          console.error(error);
        }).finally(() => {
          // TODO
        });

    },

    //global functions
    loader() {
        return '<div class="text-center">  Loading..</div>';
    },

    submitAppForm() {
        event.preventDefault();
        let form = new FormData($('.appForm')[0]);
        let url  = $('.appForm').attr('action');
        let submitBtn = $('.appForm--submit');
        let responseBlock  = $('.appForm--response');
        responseBlock.html(`${App.loader()}`);
        submitBtn.prop('disabled',true);

        axios.post(url,form).then((response) => {
            responseBlock.html(`<div class="alert alert-info successResponse"> ${response.data.message}</div>`);
            if(response.data.url != undefined)
                window.location.href = response.data.url;
            submitBtn.prop('disabled',false);
        }).catch((error,other) => {
            responseBlock.html('');
            submitBtn.prop('disabled',false);
            error.response.data.errors.map((err) => {
                responseBlock.append(`<div class="alert alert-danger">${err}</div>`)
            })
        });
    },

    deleteRequest(){
        let route = event.target.getAttribute('data-url');
        let message = event.target.getAttribute('data-message')
        message = message == undefined ? 'Yes, delete it!': message;
        if(confirm(message)){
            axios.delete(route).then((response) => {
                location.reload();
            }).catch((error) => {
                console.error(error);
                alert("Error in deleting contact support");
            });
        }
    },
}
App.init();
</script>
