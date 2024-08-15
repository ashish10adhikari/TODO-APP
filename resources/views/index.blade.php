<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-Do App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
</head>

<body class="bg-blue-900 flex justify-center items-center min-h-screen">

    <div class=" bg-white rounded-lg shadow-lg w-full max-w-xl">
        <div class=" bg-sky-700 flex items-center justify-center rounded-t-lg p-3 font-bold">
            <h4 class=" text-xl text-white">To-Do List</h4>
            <img class="w-10 h-10" src="to-do-list.png" alt="">
        </div>
        <div class="px-4 mb-3">
            <form action="{{ route('addtask') }}" method="POST" id="addtask">
                @csrf
                <div class=" bg-white flex items-center justify-center rounded-lg p-3 ">
                    <input type="text" id="title" name="title" placeholder="Enter Your Task"
                        class="w-full p-2 focus:outline-none" autofocus>
                    <input type="submit" value="Add"
                        class="p-2 text-white bg-yellow-500 hover:bg-yellow-800 hover:cursor-pointer rounded-lg">
                </div>
            </form>

            <hr class="border">
        </div>
        <div class="px-4" id="message">

        </div>

        <div class="px-4 mb-4">
            <ul id="todo-box" class="space-y-3">
                @foreach ($tasks as $task)
                    <li
                        class ="bg-gray-200 hover:bg-gray-400 hover:cursor-pointer flex  px-4 py-2 rounded-lg justify-between items-center {{ $task->completed ? 'line-through' : '' }}">
                        <span>{{ $task->title }}</span> <button class="delete-task" data-id="{{ $task->id }}"><i
                                class="fas fa-times text-red-400"></i></button></a>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>

    <script>
        $('#addtask').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('addtask') }}",
                type: 'POST',
                data: $('#addtask').serialize(),
                success: function(success) {
                    $('#message').html(
                        '<div class=" text-red-700 px-4 py-3 rounded relative" role="alert">Task Added</div>'
                    );
                    setTimeout(function() {
                        $('#message').html('');
                    }, 3000);
                    $('#todo-box').append(
                        '<li  class ="bg-gray-200 hover:bg-gray-400 hover:cursor-pointer flex  px-4 py-2 rounded-lg justify-between items-center" >' +
                        success.title +
                        '<button class="delete-task" data-id="' + success.id +
                        '"><i class="fas fa-times text-red-400"></i></button></li>'
                    );
                    $('#title').val('');
                }
            });
        });

        $('#todo-box').on('click', '.delete-task', function() {
            const taskId = $(this).data('id');
            const listItem = $(this).closest('li');
            $.ajax({
                url: "{{ route('delete', '') }}/" + taskId,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: 'DELETE'
                },
                success: function(response) {
                    $('#message').html(
                        '<div class=" text-red-700 px-4 py-3 rounded relative" role="alert">Task Deleted</div>'
                    );
                    setTimeout(function() {
                        $('#message').html('');
                    }, 3000);
                    listItem.remove();
                }
            });
        });

        $('#todo-box').on('click', 'li', function(event) {

            if (event.target === this || event.target.tagName === 'SPAN') {
                $(this).toggleClass('line-through');

                const taskId = $(this).find('.delete-task').data('id');
                const completed = $(this).hasClass('line-through') ? 1 : 0;
                $.ajax({
                    url: "{{ route('updatetask', '') }}/" + taskId,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: 'PATCH',
                        completed: completed
                    },
                    success: function(response) {
                        $('#message').html(
                            '<div class=" text-red-700 px-4 py-3 rounded relative" role="alert">' +
                            (completed ? 'Task Completed' : 'Task Marked Incomplete') +
                            '</div>'
                        );
                        setTimeout(function() {
                            $('#message').html('');
                        }, 3000);
                        listItem.remove();

                    }
                });
            }
        });
    </script>

</body>

</html>
