<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link href="/css/dashboard-styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <title>Taskit</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src='{{ asset("js/main.js")}}'></script>
    <div class="d-flex flex-column">
        <x-navbar />
        <x-sidebar />
    </div>




    <!-- AddModal -->

    <x-add-project />

    <!-- EditModal -->

    <x-edit-project />

    <!--ShareModal -->

    <x-share-project />

    <!-- DeleteModal -->

    <x-delete-project />

    <!-- TaskModal -->

    <x-view-task />


    <!-- NewTaskModal -->

    <x-add-task />



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->


    <script>
        $(document).ready(function() {
            // fetchProjects();



            $('.js-example-basic-single').select2();

            $.ajax({
                type: "GET",
                refreshRequest: true,
                url: "/set-token",
                dataType: "json",
                success: function(response) {
                    localStorage.setItem('token', response.jwt)
                }
            });



            $(document).on('click', '.show_tasks', function(e) {
                e.preventDefault();
                if ($(".show_tasks").hasClass('selected')) {
                    $(".show_tasks").removeClass('selected border border-2 border-success');
                }
                $(this).addClass('selected border border-2 border-success');

                var project_id = $(this).data('value');
                // console.log(project_id)

                var data = {
                    'id': project_id
                }


                $.ajax({
                    type: "POST",
                    url: "/api/project/" + project_id + "/tasks-with-status",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {
                            var exists = false;
                            $('.layoutalert').html("")
                            $('.layoutalert').addClass("d-none")

                            $('.green-task').html("");
                            $('.green-task').append(`<button type="button" class="btn btn-success p-1 mb-2 open-add-task-modal" style="width:10%;" data-bs-toggle="modal" data-bs-target="#newTaskModal">
                                                    Add New Task
                                                </button>
                                                <div class="dropdown">
                                                <button style="" class="d-flex flex-direction-column filter-dropdown btn btn-outline-success mb-2" data-bs-toggle="dropdown" aria-expanded="false">Filter
                                                <i class="bi bi-filter ms-1"></i>
                                                </button>
                                                <ul class="dropdown-menu filter-list" aria-labelledby="dropdownMenuButton1">
                                                </ul>
                                                </div>
                                                <div class="no-status"></div>`)

                            // console.log(response.result.length);
                            $.each(response.result, function(key, item) {
                                if (item.tasks.length != 0) {
                                    exists = true
                                    // console.log(item.tasks.length);
                                    $('.green-task').append(
                                        `<div class="TaskDiv${item.id} ${item.id}${item.type} d-flex flex-column"><h5 class="statush ps-3 pe-3 status${item.id}">${item.type}</h5></div>`
                                    )
                                    $.each(item.tasks, function(key, item) {
                                        $(`.TaskDiv${item.status_id}`).append(
                                            `

                                    <div class="d-flex flex-row justify-content-between ps-3 mb-2 pt-2 task-card" id=${item.id}>
                                        <div class="task-hover view_task" data-value=${item.id} data-project=${project_id}>
                                            <h6>${item.title}</h6>
                                            <p class="mb-2">${item.description}</p>
                                            </div>
                                            <div class="align-self-center">
                                                <button class="delete_task me-5" value=${item.id}>
                                            <i class="bi bi-trash" ></i>
                                        </button>
                                        </div>
                                        </div>


                                        `
                                        )
                                    })
                                    // console.log(item);
                                    $(`.TaskDiv${item.id}`).after(`<button class="align-self-center col-2 show-more-tasks more-tasks${item.id}" data-statusid=${item.id}><p class="text-center border border-success rounded-pill mb-0">Show More Tasks</p></button>`)

                                }
                            });
                            if (exists == false) {
                                $('.green-task').append(`<p>No Tasks Found</p>`)
                            }
                        } else {
                            $(".layoutalert").removeClass('d-none');
                            $('.layoutalert').html(`${response.message}`)
                        }
                    }
                });
            });

            $(document).on('click','.show-more-tasks', function (e) {
                                            e.preventDefault();
                                            var offset=$(this).data('offset');
                                            if(offset==undefined){
                                                $(this).data('offset','1');
                                                offset=1
                                            }
                                            else{
                                                offset++
                                                $(this).data('offset',offset);

                                            }
                                            var project_id = $('.selected').data('value');
                                            var status_id=$(this).data('statusid');

                                            $.ajax({
                                                type: "get",
                                                url: `/api/project/${project_id}/${status_id}/${offset}/show-more-tasks`,
                                                dataType: "json",
                                                success: function (response) {
                                                    // console.log(response.result[0]);
                                                    if(response.result[0]){
                                                    $(`.TaskDiv${response.result[0].status_id}`).append(
                                                                `

                                                        <div class="d-flex flex-row justify-content-between ps-3 mb-2 pt-2 task-card" id=${response.result[0].id}>
                                                            <div class="task-hover view_task" data-value=${response.result[0].id} data-project=${project_id}>
                                                                <h6>${response.result[0].title}</h6>
                                                                <p class="mb-2">${response.result[0].description}</p>
                                                                </div>
                                                                <div class="align-self-center">
                                                                    <button class="delete_task me-5" value=${response.result[0].id}>
                                                                <i class="bi bi-trash" ></i>
                                                            </button>
                                                            </div>
                                                            </div>


                                                            `)
                                                        }
                                                        else{
                                                            $(`.more-tasks${status_id}`).html("No More Task Found")
                                                        }
                                                }
                                            });
                                            // console.log(offset);

                                    });

            $(document).on('click', '.delete_task', function(e) {
                e.preventDefault();
                var task_id = $(this).val();
                // console.log(task_id)
                $.ajax({
                    type: "DELETE",
                    url: "/api/project/task/" + task_id,
                    dataType: "json",
                    success: function(response) {

                        // console.log(response.statusId);
                        if (response.status == 200) {
                            $('.layoutalert').html("")
                            $('.layoutalert').addClass("d-none")

                            if (response.statusId) {
                                $(`.TaskDiv${response.statusId}`).remove();
                                $(`.more-tasks${response.statusId}`).remove()
                            } else {
                                $('#' + task_id).remove();
                            }
                            alert("Task deleted successfully!")
                        } else {
                            $(".layoutalert").removeClass('d-none');
                            $('.layoutalert').html(`${response.message}`)
                        }
                    }
                });
            });





            $(document).on('click', '.edit-task-modal', function(e) {
                e.preventDefault();
                var project_id = $('.task-title').data('project')
                var task_id = $('.task-title').data('task')
                var title = $('.task-title').val();
                var description = $('.task-description').val()
                var status_id = $('#select2').select2('data')
                status_id = status_id[0].id
                if (status_id != 'Change Status') {
                    // console.log(status_id);
                    var data = {
                        "title": title,
                        "description": description,
                        "status_id": status_id
                    }
                } else {
                    var data = {
                        "title": title,
                        "description": description,
                    }
                }
                // console.log(project_id,task_id);
                // console.log(data);
                $.ajax({
                    type: "PATCH",
                    url: `/api/project/${project_id}/task/${task_id}`,
                    data: data,
                    dataType: "json",
                    success: function(response) {

                        // console.log(response.test);
                        if (response.status == 200) {
                            $('.edittaskalert').addClass("d-none")

                            if (response.delete_prev_status) {
                                $(`.TaskDiv${response.prev_status}`).remove();
                                $(`.more-tasks${response.prev_status}`).remove()

                            } else {
                                $(`#${response.task.id}`).remove()
                            }

                            if (response.new_status) {
                                $('.green-task').append(
                                    `<div class="TaskDiv${response.status_id}"><h5 class="statush ps-3 pe-3 status${response.status_id}">${response.status_type}</h5></div>`
                                )
                                $(`.TaskDiv${response.status_id}`).append(`
                            <div class="d-flex flex-row justify-content-between ps-3 mb-2 pt-2 task-card" id=${response.task.id}>
                                        <div class="task-hover view_task" data-value=${response.task.id} data-project=${project_id}>
                                            <h6>${response.task.title}</h6>
                                            <p class="mb-2">${response.task.description}</p>
                                            </div>
                                            <div class="align-self-center">
                                                <button class="delete_task me-5" value=${response.task.id}>
                                            <i class="bi bi-trash" ></i>
                                        </button>
                                        </div>
                                        </div>
                            `)
                            } else {
                                $(`.TaskDiv${response.status_id}`).append(`
                            <div class="d-flex flex-row justify-content-between ps-3 mb-2 pt-2 task-card" id=${response.task.id}>
                                        <div class="task-hover view_task" data-value=${response.task.id} data-project=${project_id}>
                                            <h6>${response.task.title}</h6>
                                            <p class="mb-2">${response.task.description}</p>
                                            </div>
                                            <div class="align-self-center">
                                                <button class="delete_task me-5" value=${response.task.id}>
                                            <i class="bi bi-trash" ></i>
                                        </button>
                                        </div>
                                        </div>
                            `)
                            }
                            $('#TaskModal').modal('hide')

                        } else if (response.status == 400) {
                            // console.log(response);
                            $('.edittaskalert').addClass("d-none")

                            $('.edittasktitlespan').html(response.message.title)
                            $('.edittaskdescriptionspan').html(response.message.description)

                        } else {
                            $(".edittaskalert").removeClass('d-none');
                            $('.edittaskalert').html(`${response.message}`)
                        }
                    }
                });
            });

            $(document).on('click','.filter-dropdown', function (e) {
                e.preventDefault();
                var projectId = $('.selected').data('value');
                $.ajax({
                    type: "GET",
                    url: `/api/project/${projectId}/status`,
                    dataType: "json",
                    success: function (response) {
                        $('.filter-list').html("")

                        $.each(response.statusIds, function (key, item) {
                            $('.filter-list').append(
                                `<li class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" name="status-types" value="${item.id}" aria-label="...">
                                    ${item.type}
                                </li>`
                            )
                        });
                        $('.filter-list').append(
                            "<button class='btn btn-success btn-sm p-1 checked-filter' style='width:100%;'>Show Results</button>"
                        )
                    }
                });

            });

            $(document).on('click','.checked-filter', function (e) {
                e.preventDefault();
                var statusIds=[];
                var project_id = $('.selected').data('value');

                $('input[name="status-types"]:checked').each(function(){
                    // console.log(this.value);
                    statusIds.push(this.value)
                })
                var data={
                    "statusIds[]":JSON.stringify(statusIds)
                }
                // console.log(statusIds);
                $.ajax({
                    type: "post",
                    url: `/api/project/${project_id}/filter`,
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        if (response.status == 200) {
                            var exists = false;
                            console.log('object');
                            $('.layoutalert').html("")
                            $('.layoutalert').addClass("d-none")

                            $('.green-task').html("");
                            $('.green-task').append(`<button type="button" class="btn btn-success p-1 mb-2 open-add-task-modal" style="width:10%;" data-bs-toggle="modal" data-bs-target="#newTaskModal">
                                                    Add New Task
                                                </button>
                                                <div class="dropdown">
                                                <button style="" class="d-flex flex-direction-column filter-dropdown btn btn-outline-success mb-2" data-bs-toggle="dropdown" aria-expanded="false">Filter
                                                <i class="bi bi-filter ms-1"></i>
                                                </button>
                                                <ul class="dropdown-menu filter-list" aria-labelledby="dropdownMenuButton1">
                                                </ul>
                                                </div>
                                                <div class="no-status"></div>`)

                            // console.log(response.result.length);
                            $.each(response.result, function(key, item) {
                                // console.log(item.tasks.length);
                                if (item.tasks.length != 0) {
                                    exists = true
                                    // console.log(item.tasks.length);
                                    $('.green-task').append(
                                        `<div class="TaskDiv${item.id} ${item.id}${item.type}"><h5 class="statush ps-3 pe-3 status${item.id}">${item.type}</h5></div>`
                                    )
                                    $.each(item.tasks, function(key, item) {
                                        $(`.TaskDiv${item.status_id}`).append(
                                            `

                                    <div class="d-flex flex-row justify-content-between ps-3 mb-2 pt-2 task-card" id=${item.id}>
                                        <div class="task-hover view_task" data-value=${item.id} data-project=${project_id}>
                                            <h6>${item.title}</h6>
                                            <p class="mb-2">${item.description}</p>
                                            </div>
                                            <div class="align-self-center">
                                                <button class="delete_task me-5" value=${item.id}>
                                            <i class="bi bi-trash" ></i>
                                        </button>
                                        </div>
                                        </div>


                                        `
                                        )
                                    })
                                }
                            });
                            if (exists == false) {
                                $('.green-task').append(`<p>No Tasks Found</p>`)
                            }
                        } else {
                            $(".layoutalert").removeClass('d-none');
                            $('.layoutalert').html(`${response.message}`)
                        }

                    }
                });

            });

        });
    </script>

</body>

</html>
