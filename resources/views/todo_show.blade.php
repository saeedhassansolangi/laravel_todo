@extends('layouts.html_temp')


@section('title')
    Todo
@endsection

@section('content')
    <h1>Todos</h1>

    <button class="btn btn-primary" type="button" data-toggle="modal" onclick="resetForm()" data-target="#create_todo_modal">
        Create Todo
    </button>

    <div class="todos_container"></div>
    <p class="loader_todos"></p>

    <div class="modal" id="create_todo_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Todo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_create">
                        <input type="text" name="title" id="title" placeholder="title">
                        <pre class='text-danger text-center' id="error_title_create"></pre>

                        <input type="text" name="description" id="description" placeholder="description">
                        <pre class='text-danger text-center' id="error_description_create"></pre>

                        <button type="submit" id="form_create_btn">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal" id="createeditmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit todo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_update">
                        <input type="text" hidden name="todo_id" id="todo_id">

                        <input type="text" name="title" id="title_edit" placeholder="title">
                        <pre class='text-danger text-center' id="error-title"></pre>

                        <input type="text" name="description" id="description_edit" placeholder="description">
                        <pre class='text-danger text-center' id="error-description"></pre>

                        <div class="tag active">
                            <label>Active:</label>
                            <input type="radio" name="status" id="active_radio" value="0">

                        </div>

                        <div class="tag completed">
                            <label>Completed:</label>
                            <input type="radio" name="status" id="completed_radio" value="1">
                        </div>
                        <button type="submit" id="form_edit_btn">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    {{-- @forelse ($todos as $todo)
        <div @class([
            'todos',
            'todo-complete' => !!$todo->is_task_complete,
            'todo-uncomplete' => !$todo->is_task_complete,
        ])>
            <div class="text">
                <h3>{{ $todo->task_title }}</h3>
                <p>{{ $todo->task_description }}</p>
            </div>

            <div class="btn_container">
                <p class="btn edit"><a href="/todos/{{ $todo->id }}">Edit Todo</a></p>
                <p class="btn delete"><a href="/todos/delete/{{ $todo->id }}">Delete Todo</a></p>
            </div>
        </div>
    @empty
        <p><a href="/todo-form">No todo found, lets create one</a></p>
    @endforelse --}}

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <script>
        window.addEventListener('load', function() {
            if (window.jQuery || window['$']) {
                console.log('%c jQuery is loaded ', 'background: #00b33c');

                $('#myModal').on('shown.bs.modal', function() {
                    $('#myInput').trigger('focus')
                })

                $(document).ready(function() {

                    function getTodos(text) {
                        const el = $('.todos_container')
                        const loader = $('.loader_todos')
                        loader.text(text)
                        $.get('{{ route('list_todos') }}', function(data, status) {
                            loader.empty()
                            el.empty()

                            if (data.todos.length > 0) {
                                for (let todo of data.todos) {
                                    const isCompleted = !!todo.is_task_complete ?
                                        'todo-complete' : 'todo-uncomplete';

                                    const todosEl = $('<div></div>').addClass(
                                        `todos ${isCompleted}`
                                    ).attr({
                                        id: 'todo_' + todo.id
                                    })

                                    const h3 = $('<h3></h3>').attr({
                                        id: 'todo_title_' + todo.id
                                    }).text(`${todo.task_title}`);

                                    const p = $('<p></p>').attr({
                                        id: 'todo_description_' + todo.id
                                    }).text(`${todo.task_description}`)

                                    const textContainer = $('<div></div>').addClass('text').append(
                                        h3, p)

                                    const btnEdit = $('<p></p>').addClass('btn edit').append(
                                        $('<a ></a>').text('Edit Todo'))

                                    btnEdit.on('click', function(e) {
                                        onEditTodo(e, todo.id)
                                    });

                                    const btnDelete = $('<p></p>').addClass('btn delete ')
                                        .append(
                                            $('<a></a>').attr({
                                                'aria-todo-id': todo.id
                                            }).text('Delete Todo')
                                        )

                                    btnDelete.on('click', function(e) {
                                        onDeleteTodo(e, todo.id)
                                    })

                                    const btnContainer = $('<div></div>').addClass(
                                            'btn_container')
                                        .append(btnEdit, btnDelete)

                                    todosEl.append(textContainer, btnContainer);
                                    el.append(
                                        todosEl)
                                }
                            } else {
                                el.append('<a>No, todos found</a>')
                            }
                        });
                    }


                    getTodos('loading initial todos...')

                    function onDeleteTodo(e, todoId) {
                        const btnContainer = $(e.currentTarget).closest('div')
                        const el = e.target.getAttribute('aria-todo-id');
                        let url = '{{ route('delete_single_todo', ['id' => ':todoId']) }}'
                            .replace(
                                ':todoId', todoId);


                        $.get(url, function(data, status) {
                            if (data.message ==
                                'Todo Deleted Successfully') {
                                $(e.currentTarget).closest('div.todos').fadeOut();
                            }
                        })
                    }


                    function onEditTodo(e, todoId) {

                        let url = '{{ route('get_single_todo', ['id' => ':todoId']) }}'
                            .replace(
                                ':todoId',
                                todoId);

                        $.get(url, function(data, status) {
                            $('#title_edit').val(data.todo.task_title);
                            $('#description_edit').val(data.todo.task_description)
                            $('#todo_id').val(todoId)
                            if (data.todo.is_task_complete === 0) {
                                $('#active_radio').prop('checked', true);
                            } else if (data.todo.is_task_complete === 1) {
                                $('#completed_radio').prop('checked', true);
                            }

                            $('#createeditmodal').modal('show')
                        })
                    }

                    // form_update

                    $('#form_update').on('submit', function(e) {
                        const elSubmit = $('#form_edit_btn')
                        $("#error-title").empty()
                        $("#error-description").empty()

                        e.preventDefault();

                        const title = $('#title_edit').val();
                        const description = $('#description_edit').val();
                        var status = $('input[name="status"]:checked').val();
                        const id = $('#todo_id').val()

                        if (!title || !description) {
                            alert('Title and Description are mandatory fields')
                            return
                        }

                        elSubmit.text('updating...')

                        const data = {
                            _token: "{{ csrf_token() }}",
                            todo_id: id,
                            title,
                            description,
                            status
                        }

                        $.post('{{ route('edit_single_todo') }}', data,
                            function(data, textStatus, jqXHR) {
                                if (data.messgage = 'Todo Updated Successfully') {
                                    $('#createeditmodal').modal('hide');
                                    updateTodoOnUI({
                                        todoId: id,
                                        title,
                                        description,
                                        status
                                    })
                                }
                            }
                        ).fail(function(xhr, textStatus, errorThrown) {
                            if (Object.keys(xhr.responseJSON.errors).length > 0) {

                                if (xhr.responseJSON.errors.title !== undefined) {
                                    xhr.responseJSON.errors.title.forEach((error) => {
                                        $("#error-title").html(error + '</br>')
                                    })
                                }

                                if (xhr.responseJSON.errors.description !== undefined) {
                                    xhr.responseJSON.errors.description.forEach((error) => {
                                        $("#error-description").html(error +
                                            '</br>')
                                    })
                                }
                            }
                        }).always(function() {
                            // reseting
                            elSubmit.text('Submit')

                        });


                    })


                    function updateTodoOnUI({
                        todoId,
                        title,
                        description,
                        status
                    }) {
                        $('#todo_title_' + todoId).text(title);
                        $('#todo_description_' + todoId).text(description);
                        const todoContainer = $("#todo_" + todoId);

                        if (status == 0) {
                            todoContainer.removeClass("todo-complete");
                            todoContainer.addClass('todo-uncomplete')
                        } else if (status == 1) {
                            todoContainer.removeClass("todo-uncomplete");
                            todoContainer.addClass('todo-complete')
                        }
                    }


                    function resetForm() {
                        alert('yes called')
                        $("#error_title_create").empty();
                        $("#error_description_create").empty();
                        $('#form_create')[0].reset()

                    }


                    $('#form_create').on('submit', function(e) {
                        const elSubmit = $('#form_create_btn')
                        e.preventDefault();
                        const title = $('#title').val();
                        const description = $('#description').val()

                        if (!title || !description) {
                            alert('Title and Description are mandatory fields')
                            return
                        }

                        elSubmit.text('loading...')

                        const data = {
                            _token: "{{ csrf_token() }}",
                            title,
                            description
                        }

                        $.post('{{ route('add_single_todo') }}', data,
                                function(data, textStatus, jqXHR) {
                                    if (data.messgage = 'success') {
                                        $('#create_todo_modal').modal('hide')
                                        getTodos('adding new todo....')
                                    }

                                }
                            ).fail(function(xhr) {
                                if (Object.keys(xhr.responseJSON.errors).length > 0) {

                                    if (xhr.responseJSON.errors.title !== undefined) {
                                        xhr.responseJSON.errors.title.forEach((error) => {
                                            $("#error_title_create").html(error +
                                                '</br>')
                                        })
                                    }

                                    if (xhr.responseJSON.errors.description !== undefined) {
                                        xhr.responseJSON.errors.description.forEach((error) => {
                                            $("#error_description_create").html(error +
                                                '</br>')
                                        })
                                    }
                                } else {
                                    alert('Something went wrong')
                                }
                            })
                            .always(function() {
                                elSubmit.text('Submit')
                                $('#form_create').reset();

                            });

                    })
                })

                $('#create_todo_modal').on('hidden.bs.modal', function() {
                    $(this).find('#form_create').trigger('reset');
                    $("#error_title_create").empty();
                    $("#error_description_create").empty();
                })



            } else {
                console.log('%c jQuery is not loaded ', 'background: #b30047');

            }
        })
    </script>
@endsection
