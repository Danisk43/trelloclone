<div class="modal fade" id="TaskModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="TaskModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert alert-danger text-center m-0 p-2 edittaskalert d-none" role="alert">

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
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Discard
                    Changes</button>
                <button type="button" class="btn btn-success edit-task-modal">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    $(document).on('click', '.view_task', function(e) {
                e.preventDefault();
                var task_id = $(this).data('value');
                var project_id = $(this).data('project');
                $.ajax({
                    type: "GET",
                    url: "/api/project/" + project_id + "/task/" + task_id,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {
                            $('.edittaskalert').addClass("d-none")

                            $('#TaskModalLabel').html(`View or Edit Task`);
                            $('.task-modal-body').html(`
                        <br>
                        <div class="d-flex flex-direction-column"><h6 class="pt-2">Title&ensp;</h6><input value="${response.task.title}" required type="text" data-project=${project_id} data-task=${response.task.id} class="form-control task-title">
                            </div>
                            <span class="text-danger text-md edittasktitlespan"
                                            ></span>
                        <br>
                        <div class="d-flex flex-direction-column">
                        <h6>Current Status:&ensp;</h6>
                        <h6 class="current-status" style="color:green;">${response.taskstatus}</h6>
                            </div>
                        <select class="js-example-basic-single select-status" style="width:30%" id="select2" name="state">
                        <option>Change Status</option>
                        </select>
                        <br>
                        <br>
                        <h6>Description</h6>
                        <textarea class="form-control task-description">${response.task.description}</textarea>
                        <span class="text-danger text-md edittaskdescriptionspan"
                                            ></span>
                        <br>

                        <div class="filenames">

                        </div>
                        <form id="file-upload" data-id=${response.task.id}>
                            @csrf
                        <input type="file" name="files[]" class="file" multiple="multiple">
                        <button class="btn btn-success btn-sm m-0 p-1 submit-file" type="submit" data-id=${response.task.id}>Submit</button>
                        </form>
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

                        for(i=0;i<response.attachments.length;i++){
                            $('.filenames').append(`<div class="d-flex flex-direction-column">
                                <i class="bi bi-paperclip"></i>
                                <p class="file-name">${response.attachments[i].path}</p>
                                <a href="http://localhost:8000/project/task/${response.task.id}/${response.attachments[i].id}/download-file" target="_blank">
                                <button>
                                <i class="bi bi-file-earmark-arrow-down download" data-id=></i>
                                </button></a>
                                <p>Uploaded by <strong>${response.usernames[i]}</strong></p>
                                </div>`)
                        }



                            var task_id = response.task.id;
                            $.each(response.task.users, function(key, item) {
                                $('.task-modal-body').append(
                                    `<div class="${item.id}user d-flex flex-row justify-content-between" style="width:150px;"><p class="m-0">${item.first_name}</p>
                            <button class="btn-outline-danger btn-sm remove_user_from_task" data-task="${task_id}user" value=${item.id}><i class="bi bi-x-lg"></i></button></div>`
                                )
                            });

                        } else {
                            $(".edittaskalert").removeClass('d-none');
                            $('.edittaskalert').html(`${response.message}`)
                        }
                    }

                });
                $.ajax({
                    type: "GET",
                    url: "/api/project/task/" + task_id + "/comment",
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {
                            $('.edittaskalert').addClass("d-none")
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
                        } else {
                            $(".edittaskalert").removeClass('d-none');
                            $('.edittaskalert').html(`${response.message}`)
                        }
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
                </button></div>
                <span class="text-danger text-md commentspan"
                                            ></span>`)
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
                    url: "/api/project/task/" + task_id + "/comment",
                    data: data,
                    dataType: "json",
                    success: function(response) {

                        if (response.status == 200) {
                            $('.edittaskalert').addClass("d-none")

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
                        } else if (response.status == 400) {
                            $('.edittaskalert').addClass("d-none")

                            $('.commentspan').html(response.message.description)

                        } else {
                            $(".edittaskalert").removeClass('d-none');
                            $('.edittaskalert').html(`${response.message}`)
                        }
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

                        if (response.status == 200) {
                            $('.edittaskalert').addClass("d-none")
                            $(`.${user_id}user`).remove()
                        } else {
                            $(".edittaskalert").removeClass('d-none');
                            $('.edittaskalert').html(`${response.message}`)
                        }
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
                        if (response.status == 200) {

                            $('.users-list').html("")
                            $.each(response.users, function(key, item) {
                                $('.users-list').append(`
                             <li><a class="dropdown-item action-add-user" data-task=${task_id} data-userid=${item.id} data-username=${item.first_name}>${item.first_name}</a></li>
                             `)
                            });
                        } else {
                            $(".edittaskalert").removeClass('d-none');
                            $('.edittaskalert').html(`${response.message}`)
                        }
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
                        if (response.status == 200) {

                            $('.task-modal-body').append(
                                `<div class="${userid}user d-flex flex-row justify-content-between" style="width:150px;"><p class="m-0">${username}</p>
                            <button class="btn-outline-danger btn-sm remove_user_from_task" data-task="${task_id}user" value=${userid}><i class="bi bi-x-lg"></i></button></div>`
                            )


                        } else {
                            $(".edittaskalert").removeClass('d-none');
                            $('.edittaskalert').html(`${response.message}`)
                        }
                    }
                });

            });


            $('body').on('shown.bs.modal', '.modal', function() {
                var projectId = $('.add-users-on-task').data('project')
                var taskId = $('.add-users-on-task').data('task');
                // console.log(projectId,taskId);
                $('#select2').select2({

                    dropdownParent: $('#TaskModal'),
                    ajax: {
                        url: `/api/project/${projectId}/status`,
                        dataType: 'json',
                        delay: 250,
                        processResults: function(response) {
                            // console.log(response);
                            return {
                                results: $.map(response.statusIds, function(key, item) {
                                    // console.log(key.type);

                                    // if(key.id==22){
                                    //     return {
                                    // text:key.type,
                                    // id:key.id,
                                    // selected:selected
                                    // }
                                    // }
                                    return {
                                        text: key.type,
                                        id: key.id,
                                    }
                                })
                            }

                        }
                    },
                    cache: true

                });

            });

            $(document).on('click','.submit-file', function (e) {
                e.preventDefault();
                // console.log($('#file-upload'));
                var task_id=$(this).data('id')
                // var file=new FormData($('#file-upload')[0]);
                // console.log('object');
                var formData =new FormData()
                var totalfiles = $('.file')[0].files;
                // console.log(totalfiles);
                for(var i=0;i<totalfiles.length;i++){
                    formData.append('files[]',totalfiles[i])
                }

                // console.log(formData);
                $.ajax({
                    type: "POST",
                    url: `/api/project/task/${task_id}/upload-file`,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        for(var i=0;i<response.filename.length;i++){
                            $('.filenames').append(`<div class="d-flex flex-direction-column ">
                                <i class="bi bi-paperclip"></i>
                                <p class="file-name">${response.filename[i].path}</p>
                                <a href="http://localhost:8000/project/task/${task_id}/${response.filename[i].id}/download-file" target="_blank">
                                <button>
                                <i class="bi bi-file-earmark-arrow-down download" data-id=></i>
                                </button></a>
                                <p>Uploaded by <strong>${response.username}</strong></p>
                                </div>`)

                        }
                    }
                });

            });
})

    </script>
