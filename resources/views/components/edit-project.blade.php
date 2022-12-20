<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center m-0 p-2 editprojectalert d-none" role="alert">

                </div>
                <form>
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Project Name</label>
                        <input type="text" placeholder="Enter Project Name" class="form-control name"
                            id="edit_project_name" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Project Name can be changed later</div>
                        <span class="text-danger text-md editmodalspan"></span>
                        <label for="" class="form-label">Add Custom Status</label>
                        <input type="text" placeholder="Enter Status" class="form-control"
                            id="add_custom_status">
                        <div class="form-text">Leave this empty if no new custom status needed</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success save_edit_project">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '.edit_project', function(e) {
            e.preventDefault();
            var project_id = $(this).val();
            // console.log(project_id)
            $('.save_edit_project').val(project_id);
            $('#editProjectModal').modal('show');
            $('.name').val($(this).data('value'))
            $('.editmodalspan').html("")
            $('.editprojectalert').addClass("d-none")

            // console.log($('.save_edit_project').val())
        });

        $(document).on('click', '.save_edit_project', function(e) {
            e.preventDefault();
            var data = {
                "id": $('.save_edit_project').val(),
                "name": $('#edit_project_name').val(),
                "custom-status":$('#add_custom_status').val()
            }
            var project_id = $('.save_edit_project').val();
            var project_name = $('#edit_project_name').val();
            // if(project_name==""){$(".editmodalspan").html("The name field is required")}

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
                        $('.editprojectalert').html("")
                        $('.editprojectalert').addClass("d-none")

                        $(`#changename${project_id}`).html(project_name)
                        $('#message').html("");
                        $('#message').addClass('alert alert-success')
                        $('#message').text(response.message)
                        $('#editProjectModal').modal('hide')
                        $('#editProjectModal').find('input').val("")
                        // $('#edit' + project_id + '').html(project_name)
                    } else if (response.status == 400) {
                        $('.editprojectalert').html("")
                        $('.editmodalspan').html(response.message.name)
                    } else {
                        $(".editprojectalert").removeClass('d-none');
                        $('.editprojectalert').html(`${response.message}`)
                    }
                },
                // error:function(request, status, error){ console.log(request, status, error)}
            });
        });
    })
</script>
