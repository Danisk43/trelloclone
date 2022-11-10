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


    <title>Taskit</title>
</head>

<body>
    <div class="d-flex flex-column">
    <div class="header">
        <div class="menubar">
            <nav class="navbar navbar-light fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand"><b>Taskit</b></a>
                    <div class="d-flex">
                        <form class="d-flex me-3">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                        <a href="/logout"> <button class="upper-btn btn btn-success form-control"
                                style="width:100px;">Logout</button></a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="d-flex flex-row">
    <div class="d-flex flex-column flex-shrink-0 p-3 sidebar fixed-top" style="width: 280px;">
        {{-- <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"></use>
            </svg>
        </a> --}}
        <span class="fs-4 align-self-center">Projects</span>
        <hr>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add New Project
        </button>
        
        <hr>
        <ul class="nav nav-pills flex-column mb-auto project-sidebar">
            
        </ul>
        
    </div>
    <div class="green-task list-group">
        
    </div>
</div>
</div>



    <div class="container ms-0">
        <div class="row">
            <div class="column">
                <h1>Projects</h1>
                <div id="message">
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add New Project
                </button>
                <br>
                <br>

                <!-- AddModal -->

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New Project</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    @csrf
                                    <div class="mb-3">
                                        <label for="" class="form-label">Project Name</label>
                                        <input type="text" placeholder="Enter Project Name"
                                            class="form-control name" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text">Project Name can be changed later</div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary new_project">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- EditModal -->

                <div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Project</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    @csrf
                                    <div class="mb-3">
                                        <label for="" class="form-label">Project Name</label>
                                        <input type="text" placeholder="Enter Project Name"
                                            class="form-control name" id="edit_project_name"
                                            aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text">Project Name can be changed later</div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary save_edit_project">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DeleteModal -->

                <div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Project</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4>Project will be deleted permanently, do you still want to proceed?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary delete_project_btn">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TaskModal -->

                <div class="modal fade" id="TaskModal"tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TaskModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                <div class="task-modal-body">

                                </div>
                                <div class="comments">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-row">
                    <div class="list-group projects-list">
                        <!-- <a href="#" class="list-group-item list-group-item-action active">
                        Cras justo odio
                    </a> -->

                    </div>
                    <div class="task-type">
                        <div class="list-group tasks-list">


                        </div>
                    </div>
                    <div class="task-details">

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            fetchProjects();

            function fetchProjects() {
                $.ajax({
                    type: "GET",
                    url: "/project",
                    dataType: "json",
                    success: function(response) {
                        $('.projects-list').html("")
                        $.each(response.projects, function(key, item) {
                            $('.projects-list').append(
                                '  <div class="d-flex flex-row" data-id="' + item.id + '">\
                                    <div class="list-group-item list-group-item-action show_tasks" id="edit' + item.id +
                                '"data-value="' + item.id + '" style="width:200px"><h3>' +
                                item.name + '</h3></div>\
                                    <button class="btn btn-primary btn-sm edit_project" value="' + item.id + '">Edit</button>\
                                    <button class="btn btn-danger btn-sm delete_project" id="' + item.id + '"value="' +
                                item.id + '">Delete</button>\
                                    </div>'
                            );
                        });
                        $.each(response.projects, function(key, item) {
                            $('.project-sidebar').append(`
                                <li class="d-flex justify-content-between show_tasks" id="edit${item.id}" data-value=${item.id} data-id=${item.id}>
                                    <a href="#" class="nav-link link-dark ps-1">
                                   <span id="changename${item.id}">${item.name}</span>
                                  </a>
                                  <div class="mt-2">
                                    <button class="edit_project" value=${item.id}>
                                      <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="delete_project" value=${item.id}>
                                      <i class="bi bi-trash" ></i>
                                    </button>
                                  </div>
                                </li>
                                 `)
                        });

                    }
                });
            }


            $(document).on('click', '.delete_task', function(e) {
                e.preventDefault();
                var task_id = $(this).val();
                console.log(task_id)
                $.ajax({
                    type: "DELETE",
                    url: "/api/project/task/" + task_id,
                    dataType: "json",
                    success: function(response) {
                        console.log(response, $('#' + task_id));
                        if (response.status == 200) {
                            $('#' + task_id).remove();
                            alert("Task deleted successfully!")
                        }
                    }
                });
            });

            $(document).on('click', '.delete_project', function(e) {
                e.preventDefault();
                var project_id = $(this).val();
                // console.log(project_id)

                $('.delete_project_btn').val(project_id);
                $('#deleteProjectModal').modal('show');
            });

            $(document).on('click', '.delete_project_btn', function(e) {
                e.preventDefault();
                var project_id = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/api/project/" + project_id,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {
                        console.log(response);
                            $(`#edit${project_id}`).remove();
                            $('#message').html("");
                            $('#message').addClass('alert alert-success')
                            $('#message').text(response.message)
                            $('#deleteProjectModal').modal('hide')
                            $('#deleteProjectModal').find('input').val("")
                        } else {
                            $('#message').html("");
                            $('#message').addClass('alert alert-danger')
                            $('#message').text("Something went wrong")
                            $('#deleteProjectModal').modal('hide')
                            $('#deleteProjectModal').find('input').val("")
                        }
                    }
                });
            });

            $(document).on('click', '.edit_project', function(e) {
                e.preventDefault();
                var project_id = $(this).val();
                // console.log(project_id)
                $('.save_edit_project').val(project_id);
                $('#editProjectModal').modal('show');
                // console.log($('.save_edit_project').val())
            });

            $(document).on('click', '.save_edit_project', function(e) {
                e.preventDefault();
                var data = {
                    "id": $('.save_edit_project').val(),
                    "name": $('#edit_project_name').val()
                }
                var project_id = $('.save_edit_project').val();
                var project_name = $('#edit_project_name').val();
                // console.log($('#edit_project_name').val())

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PATCH",
                    url: `/api/project/${project_id}`,
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {
                            $(`#changename${project_id}`).html(project_name)
                        
                            $('#message').html("");
                            $('#message').addClass('alert alert-success')
                            $('#message').text(response.message)
                            $('#editProjectModal').modal('hide')
                            $('#editProjectModal').find('input').val("")
                            // $('#edit' + project_id + '').html(project_name)
                        } else {
                            $('#message').html("");
                            $('#message').addClass('alert alert-danger')
                            $('#message').text("Something went wrong")
                            $('#editProjectModal').modal('hide')
                            $('#editProjectModal').find('input').val("")
                        }
                    }
                });
            });


            $(document).on('click', '.new_project', function(e) {
                e.preventDefault();
                var name=$('.name').val()
                var data = {
                    'name': name
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // console.log(data);
                $.ajax({
                    type: "POST",
                    url: "/project",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {
                            $('.project-sidebar').append(`
                                <li class="d-flex justify-content-between show_tasks" id="edit${response.id}" data-value=${response.id} data-id=${response.id}>
                                    <a href="#" class="nav-link link-dark">
                                        <svg class="bi me-2" width="16" height="16"></svg>
                                   <span id="changename${response.id}">${response.name}</span>
                                  </a>
                                  <div class="mt-2">
                                    <button class="edit_project" value=${response.id}>
                                      <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="delete_project" value=${response.id}>
                                      <i class="bi bi-trash" ></i>
                                    </button>
                                  </div>
                                </li>
                                 `)


                            $('#message').html("");
                            $('#message').addClass('alert alert-success')
                            $('#message').text(response.message)
                            $('#exampleModal').modal('hide')
                            $('#exampleModal').find('input').val("")
                        } else {
                            $('#message').html("");
                            $('#message').addClass('alert alert-danger')
                            $('#message').text("Something went wrong")
                            $('#exampleModal').modal('hide')
                            $('#exampleModal').find('input').val("")
                        }
                    }
                });
            });

            $(document).on('click', '.show_tasks', function(e) {

                e.preventDefault();
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
                        $('.tasks-list').html("");
                        $.each(response, function(key, item) {
                            $('.tasks-list').append('<h5>' + item.type + '</h5>')
                            $.each(item.tasks, function(key, item) {


                                $('.tasks-list').append(
                                    '<div class="d-flex flex-row" id="' +
                                    item.id + '">\
                                <div class="list-group-item list-group-item-action">\
                                <h6>' + item.title + '</h6>\
                                <p>' + item.description + '</p>\
                                </div>\
                                <button class="btn btn-primary btn-sm view_task" value="' + item.id +
                                    '" data-project="' + project_id + '">View</button>\
                                <button class="btn btn-danger btn-sm delete_task" value="' + item.id + '">Delete</button>\
                        </div>');
                            });
                        })

                        $('.green-task').html("");
                        $.each(response, function (key, item) { 
                             $('.green-task').append(`<h5 class="statush ps-3 pe-3">${item.type}</h5>`)
                             $.each(item.tasks,function(key,item){
                                $('.green-task').append(
                                    `
                                    
                                    <div class="d-flex flex-row justify-content-between ps-3 mb-2 task-card" id=${item.id}>
                                        <div class="task-hover view_task" data-value=${item.id} data-project=${project_id}>
                                            <h6>${item.title}</h6>
                                            <p>${item.description}</p>
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
                        });
                    }
                });
            });


            $(document).on('click', '.view_task', function(e) {
                e.preventDefault();
                var task_id = $(this).data('value');
                var project_id = $(this).data('project');
                $.ajax({
                    type: "GET",
                    url: "/api/project/" + project_id + "/task/" + task_id,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        $('#TaskModalLabel').html(response.task.title);
                        $('.task-modal-body').html(`<h5>${response.task.description}</h5>
                        <br>
                        <br>
                        <h6>Attachments<h6>
                        <p>${response.task.attachment}</p>
                        <br>
                        <p class="assigned-users">Assigned Users</p>

                        <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle add-users-on-task" data-task="${response.task.id}" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Add New User
                        </button>
                        <ul class="dropdown-menu users-list" aria-labelledby="dropdownMenuButton1">
                        </ul>
                        </div>

                        `)



                        var task_id = response.task.id;
                        $.each(response.task.users, function(key, item) {
                            $('.task-modal-body').append(
                                `<div class=${item.id}user><p >${item.first_name}</p>
                            <button class="btn btn-danger btn-sm remove_user_from_task" value=${item.id}>Remove User</button></div>`)
                        });
                        $('.remove_user_from_task').data('task', `${task_id}user`);

                    }
                });
                $.ajax({
                    type: "GET",
                    url: "/api/project/task/" + task_id + "/comment",
                    dataType: "json",
                    success: function(response) {
                        $.each(response.comments, function(key, item) {
                            $('.comments').append(`
                        <p>${item.description}</p>
                        <p>by ${item.first_name}</p>
                        <p>${item.created_at}</p>
                        `)
                        });
                    }
                });



                // $.each(response.projects, function (key, item) { 

                //     $('.assigned-users').append(``)


                //     });

                $('.comments').html(`<h6>Comments</h6>
                            <input type="text" id="comment-value">
                            <button type="button" data-value="${task_id}" class="btn btn-primary add-comment">
                             New Comment
                </button>`)
                $('#TaskModal').modal('show');

            });


            $(document).on('click', '.add-comment', function(e) {
                e.preventDefault()
                var value = $('#comment-value').val();
                var data = {
                    "description": $('#comment-value').val()
                }
                console.log($('#comment-value').val());
                var task_id = $(this).data("value")
                $.ajax({
                    type: "POST",
                    url: "/api/project/task/" + task_id + "/comment",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $('.comments').append(`
                        <p>${value}</p>
                        <p>
                        `)
                        $('#comment-value').val("");
                    }
                })

            });

            $(document).on('click', ".remove_user_from_task", function(e) {
                e.preventDefault();
                var user_id = $(this).val()
                var task_id = $(this).data('task')
                $.ajax({
                    type: "DELETE",
                    url: `/api/project/task/${task_id}/user/${user_id}`,
                    dataType: "json",
                    success: function(response) {
                        $(`.${user_id}user`).remove()
                    }
                });

            });

            $(document).on('click', '.add-users-on-task', function(e) {
                e.preventDefault();
                var task_id = $(this).data('task');
                $.ajax({
                    type: "GET",
                    url: `/api/project/task/${task_id}/user`,
                    dataType: "json",
                    success: function(response) {
                        $.each(response.users, function(key, item) {
                            $('.users-list').append(`
                             <li><a class="dropdown-item action-add-user" data-task=${task_id} data-userid=${item.id} data-username=${item.first_name}>${item.first_name}</a></li>
                             `)
                        });
                    }
                });

            });

            $(document).on('click', '.action-add-user', function(e) {
                e.preventDefault();
                var task_id = $(this).data('task')
                var username = $(this).data('username')
                var userid = $(this).data('userid')



                $.ajax({
                    type: "GET",
                    url: `/api/project/task/${task_id}/user/${userid}`,
                    dataType: "json",
                    success: function(response) {
                        $('.task-modal-body').append(
                            `<div class=${userid}user><p >${username}</p>
                            <button class="btn btn-danger btn-sm remove_user_from_task" value=${userid}>Remove User</button></div>`)
                    }
                });

            });



        });
    </script>

</body>

</html>
