<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center m-0 p-2 addprojectalert d-none" role="alert">

                </div>
                <form>
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Project Name</label>
                        <input type="text" placeholder="Enter Project Name" class="form-control name"
                            id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Project Name can be changed later</div>
                        <span class="text-danger text-md addmodalspan">{{ $errors->first('name') }}</span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success new_project">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $(document).on('click', '.new_project', function(e) {
            e.preventDefault();
            var name = $('.name').val()
            // if(name==""){$(".addmodalspan").html("The name field is required")

            // }
            var data = {
                'name': name
            }
            

            // console.log(data);
            $.ajax({
                type: "POST",
                url: "/api/project",
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response.status == 200) {
                        if($('.project-sidebar').hasClass('no-project')){
                            $('.project-sidebar').removeClass('no-project')
                            $('.project-sidebar').html('')

                        }
                        $('.addprojectalert').html("")
                        $('.addprojectalert').addClass("d-none")

                        $('.project-sidebar').append(`
                            <li class="d-flex justify-content-between show_tasks" id="edit${response.id}" data-value=${response.id} data-id=${response.id}>
                                <a href="#" class="nav-link link-dark ps-1">
                                    <span id="changename${response.id}">${response.name}</span>
                                    </a>
                                    <div class="mt-2">
                                        <button class="edit_project" value=${response.id}>
                                            <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button class="share_project" value=${response.id}>
                                               <i class="bi bi-share"></i>
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
                        $('#addProjectModal').modal('hide')
                        $('#addProjectModal').find('input').val("")
                    } else if (response.status == 400) {
                        $('.addprojectalert').html("")

                        $('.addmodalspan').html(response.message.name)
                    } else if (response.status == 403) {
                        $('.addmodalspan').html(response.message)
                    } else {
                        $(".addprojectalert").removeClass('d-none');
                        $('.addprojectalert').html(`${response.message}`)
                    }
                }
            });
        });

        $(document).on('click', '.add-new-project', function(e) {
            e.preventDefault();
            $('.name').val("");
            $('.addmodalspan').html("");
        })
    })
</script>
