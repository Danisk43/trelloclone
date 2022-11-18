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
    
        
    <div class="green-task list-group p-3">
        
    </div>

</div>
</div>




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
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success new_project">Save</button>
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
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success save_edit_project">Edit</button>
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
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger delete_project_btn">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TaskModal -->

                <div class="modal fade" id="TaskModal" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content p-3">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TaskModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="container">
                                <div class="row">
                                <div class="task-modal-body col-8">

                                </div>
                                <div class="comments p-3 col-4">

                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger"
                                    data-bs-dismiss="modal">Discard Changes</button>
                                <button type="button" class="btn btn-success edit-task-modal">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- NewTaskModal -->

                <div class="modal fade" id="newTaskModal" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content p-3">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newTaskModalLabel">Add New Task</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                                <div class="newTaskModalBody">
                                    <h6>Title</h6>
                                    <input class="form-control new-task-tile" placeholder="Enter Title" type="text">
                                    <br>
                                    <h6>Description</h6>

                                    <textarea class="form-control new-task-description" placeholder="Enter Description"></textarea>

                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger"
                                    data-bs-dismiss="modal">Discard Changes</button>
                                <button type="button" class="btn btn-success add-new-task">Save Changes</button>
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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            fetchProjects();

            $('.js-example-basic-single').select2();


            function fetchProjects() {
                $.ajax({
                    type: "GET",
                    url: "/project",
                    dataType: "json",
                    success: function(response) {
                        $('.project-sidebar').html("")
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
                                <a href="#" class="nav-link link-dark ps-1">
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
                        
                        $('.green-task').html("");
                        $('.green-task').append(`<button type="button" class="btn btn-success p-1 mb-2 open-add-task-modal" style="width:10%;" data-projectid=${project_id} data-bs-toggle="modal" data-bs-target="#newTaskModal">
                                                    Add New Task
                                                </button>
                                                <div class="no-status"></div>`)
                        $.each(response, function (key, item) { 
                            if(item.tasks.length!=0){
                                // console.log(item.tasks);
                             $('.green-task').append(`<div class="TaskDiv${item.id}"><h5 class="statush ps-3 pe-3 status${item.id}">${item.type}</h5></div>`)
                             $.each(item.tasks,function(key,item){
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
                    }
                });
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
                        console.log(response.statusId);
                        if (response.status == 200) {
                            if(response.statusId){
                                $(`.TaskDiv${response.statusId}`).remove();
                            }
                            else{
                            $('#' + task_id).remove();
                            }
                            alert("Task deleted successfully!")
                        }
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
                        $('#TaskModalLabel').html(`View or Edit Task`);
                        $('.task-modal-body').html(`
                        <br>
                        <div class="d-flex flex-direction-column"><h6 class="pt-2">Title&ensp;</h6><input value="${response.task.title}" type="text" data-project=${project_id} data-task=${response.task.id} class="form-control task-title"></div>
                        <br>
                        <div class="d-flex flex-direction-column">
                        <h6>Current Status:&ensp;</h6>
                        <h6 class="current-status" style="color:green;">${response.status}</h6>
                            </div>
                        <select class="js-example-basic-single select-status" style="width:30%" id="select2" name="state">
                        <option>Change Status</option>
                        </select>
                        <br>
                        <br>
                        <h6>Description</h6>
                        <textarea class="form-control task-description">${response.task.description}</textarea>
                        <br>
                        
                        <h6>Attachments<h6>
                        <p>${response.task.attachment}</p>
                        <br>
                        <div class="d-flex flex-direction-column"
                        <p class="assigned-users">Assigned Users</p>
                        <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle add-users-on-task m-0 ms-3 p-1" data-project="${response.project_id}" data-task="${response.task.id}" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Add User
                        </button>
                        <ul class="dropdown-menu users-list" aria-labelledby="dropdownMenuButton1">
                        </ul>
                        </div>
                        
                        </div>

                        `)



                        var task_id = response.task.id;
                        $.each(response.task.users, function(key, item) {
                            $('.task-modal-body').append(
                                `<div class="${item.id}user d-flex flex-row justify-content-between" style="width:150px;"><p class="m-0">${item.first_name}</p>
                            <button class="btn-outline-danger btn-sm remove_user_from_task" data-task="${task_id}user" value=${item.id}><i class="bi bi-x-lg"></i></button></div>`)
                        });
                        

                    }
                });
                $.ajax({
                    type: "GET",
                    url: "/api/project/task/" + task_id + "/comment",
                    dataType: "json",
                    success: function(response) {
                        $.each(response.comments, function(key, item) {
                            $('.comments').append(`
                            <div class="commentCard p-2 m-1">
                            <div class="d-flex flex-direction-column justify-content-between"
                            <p class="mb-0 pb-0">${item.first_name}</p>
                            <p class="mb-0 pb-0">${item.created_at.slice(11,16)+" "+item.created_at.slice(0,10)}</p>
                            </div>
                            <p class="mb-1">${item.description}</p>
                            </div>
                        `)
                        });
                    }
                });



                // $.each(response.projects, function (key, item) { 

                //     $('.assigned-users').append(``)


                //     });

                $('.comments').html(`<h6 class="">Comments</h6><div class="mb-3 input-group">
                    @csrf
                            <input type="text" class="form-control" id="comment-value" placeholder="Write Comment">
                            <button type="button" data-value="${task_id}" class="btn btn-success p-1 add-comment">
                             New Comment
                </button></div>`)
                $('#TaskModal').modal('show');

            });


            $(document).on('click', '.add-comment', function(e) {
                e.preventDefault()
                var value = $('#comment-value').val();
                var data = {
                    "description": $('#comment-value').val()
                }
                // console.log($('#comment-value').val());
                var task_id = $(this).data("value")

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "/project/task/" + task_id + "/comment",
                    data: data,
                    dataType: "json",
                    success: function(response) {

                        

                        // console.log(response);
                        $('.comments').append(`
                        <div class="commentCard p-2 m-1">
                            <div class="d-flex flex-direction-column justify-content-between"
                            <p class="mb-0 pb-0">${response.username}</p>
                            <p class="mb-0 pb-0">${response.time.slice(11,16)+" "+response.time.slice(0,10)}</p>
                            </div>
                            <p class="mb-1">${value}</p>
                            </div>
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
                        $('.users-list').html("")
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
                            `<div class="${userid}user d-flex flex-row justify-content-between" style="width:150px;"><p class="m-0">${username}</p>
                            <button class="btn-outline-danger btn-sm remove_user_from_task" data-task="${task_id}user" value=${userid}><i class="bi bi-x-lg"></i></button></div>`)
                        

                    }
                });

            });


            $('body').on('shown.bs.modal', '.modal', function() {
                    var projectId=$('.add-users-on-task').data('project')
                    var taskId=$('.add-users-on-task').data('task');
                    // console.log(projectId,taskId);
                    $('#select2').select2({

                    dropdownParent: $('#TaskModal'),
                    ajax:{
                        url:`/api/project/${projectId}/task/${taskId}/status`,
                        dataType: 'json',
                        delay:250,
                        processResults: function (response) {
                            // console.log(response);
                            return {
                                results: $.map(response.statusIds, function (key, item) {
                                    // console.log(key.type);

                                                // if(key.id==22){
                                                //     return {
                                                // text:key.type,
                                                // id:key.id,
                                                // selected:selected
                                                // }
                                                // }
                                              return {
                                                text:key.type,
                                                id:key.id,
                                            }
                                        })
                                    }
                                    
                        }
                    }, cache:true

                });
                
            });

            $(document).on('click','.edit-task-modal', function (e) {
                e.preventDefault();
                var project_id=$('.task-title').data('project')
                var task_id=$('.task-title').data('task')
                var title=$('.task-title').val();
                var description=$('.task-description').val()
                var status_id=$('#select2').select2('data')
                status_id=status_id[0].id
                if(status_id!='Change Status'){
                // console.log(status_id);
                var data={
                    "title":title,
                    "description":description,
                    "status_id":status_id
                }
                }
                else{
                    var data={
                    "title":title,
                    "description":description,
                }
                }
                // console.log(project_id,task_id);
                // console.log(data);
                $.ajax({
                    type: "PATCH",
                    url: `/api/project/${project_id}/task/${task_id}`,
                    data: data,
                    dataType: "json",
                    success: function (response) {

                        // console.log(response.test);

                        if(response.delete_prev_status){
                            $(`.TaskDiv${response.prev_status}`).remove();
                        }
                        else{
                            $(`#${response.task.id}`).remove()
                        }

                        if(response.new_status){
                            $('.green-task').append(`<div class="TaskDiv${response.status_id}"><h5 class="statush ps-3 pe-3 status${response.status_id}">${response.status_type}</h5></div>`)
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
                        else{
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
                    
                    }
                });
            });

            $(document).on('click','.add-new-task', function (e) {
                e.preventDefault();
                var title=$('.new-task-tile').val()
                var description=$('.new-task-description').val()
                var project_id=$(".open-add-task-modal").data('projectid')
                // console.log(project_id);
                data={
                    "title":title,
                    "description":description,
                }
                // console.log($('meta[name="csrf-token"]').attr('content'));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax({
                    type: "POST",
                    url: `/project/${project_id}/task`,
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        // console.log('object');
                        $(`.no-status`).append(
                                    `
                                    
                                    <div class="d-flex flex-row justify-content-between ps-3 mb-2 pt-2 task-card" id=${response.id}>
                                        <div class="task-hover view_task" data-value=${response.id} data-project=${response.project_id}>
                                            <h6>${response.title}</h6>
                                            <p class="mb-2">${response.description}</p>
                                            </div>
                                            <div class="align-self-center">
                                                <button class="delete_task me-5" value=${response.id}>
                                            <i class="bi bi-trash" ></i>
                                        </button>
                                        </div>
                                        </div>
                                        
                                        
                                        `
                                        )
                         $('#newTaskModal').modal('hide')
                        
                    }
                });
            });

});
            

    </script>

</body>

</html>
