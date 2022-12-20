<div class="modal fade" id="newTaskModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="newTaskModalLabel">Add New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="newTaskModalBody">
                <div class="alert alert-danger text-center m-0 p-2 addtaskalert d-none" role="alert">

                </div>
                <h6>Title</h6>
                <input class="form-control new-task-tile" placeholder="Enter Title" type="text">
                <span class="text-danger text-md tasktitlespan"></span>
                <br>
                <h6>Description</h6>

                <textarea class="form-control new-task-description" placeholder="Enter Description"></textarea>
                <div class="d-flex flex-column">
                <span class="text-danger text-md taskdescriptionspan"></span>

                <span class="text-success">Note: New Task will have default status OPEN</span>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Discard
                    Changes</button>
                <button type="button" class="btn btn-success add-new-task">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '.add-new-task', function(e) {
            e.preventDefault();
            var title = $('.new-task-tile').val()
            var description = $('.new-task-description').val()
            var project_id = $('.selected').data('value');





            // console.log(project_id);
            data = {
                "title": title,
                "description": description,
            }
            // console.log($('meta[name="csrf-token"]').attr('content'));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: `/api/project/${project_id}/task`,
                data: data,
                dataType: "json",
                success: function(response) {
                    // console.log('object');
                    if (response.status == 200) {
                        $('.addtaskalert').addClass("d-none")

                        if ($('div').hasClass(`TaskDiv${response.status_id}`)) {
                            // console.log('object');
                            $(`.TaskDiv${response.status_id}`).append(`
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
                                    `)
                        }
                        else{
                            // console.log('object');
                            $('.green-task').append(
                                        `<div class="TaskDiv${response.status_id}"><h5 class="statush ps-3 pe-3 status${response.status_id}">OPEN</h5></div>`
                                    )
                            $(`.TaskDiv${response.status_id}`).append(`
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
                            `)
                        }

                        // $(`.no-status`).append(
                        //     `

                        //             <div class="d-flex flex-row justify-content-between ps-3 mb-2 pt-2 task-card" id=${response.id}>
                        //                 <div class="task-hover view_task" data-value=${response.id} data-project=${response.project_id}>
                        //                     <h6>${response.title}</h6>
                        //                     <p class="mb-2">${response.description}</p>
                        //                     </div>
                        //                     <div class="align-self-center">
                        //                         <button class="delete_task me-5" value=${response.id}>
                        //                     <i class="bi bi-trash" ></i>
                        //                 </button>
                        //                 </div>
                        //                 </div>


                        //                 `
                        // )
                        $('#newTaskModal').modal('hide')
                        $('.new-task-tile').val(null)
                        $('.new-task-description').val(null)

                    } else if (response.status == 400) {
                        $('.addtaskalert').addClass("d-none")

                        $('.tasktitlespan').html(response.message.title)
                        $('.taskdescriptionspan').html(response.message.description)

                    } else {
                        $(".addtaskalert").removeClass('d-none');
                        $('.addtaskalert').html(`${response.message}`)
                    }
                }
            });
        });

        $(document).on('click', '.open-add-task-modal', function(e) {
            e.preventDefault();
            $('.new-task-tile').val("");
            $('.new-task-description').val("");

        })
    })
</script>
