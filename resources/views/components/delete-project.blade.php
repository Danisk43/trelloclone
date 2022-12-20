<div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center m-0 p-2 deleteprojectalert d-none" role="alert">

                </div>
                <h4>Project will be deleted permanently, do you still want to proceed?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger delete_project_btn">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $(document).on('click', '.delete_project', function(e) {
            e.preventDefault();
            var project_id = $(this).val();
            // console.log(project_id)

            $('.delete_project_btn').val(project_id);
            $('#deleteProjectModal').modal('show');
            $('.deleteprojectalert').addClass("d-none")
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
                        $('.layoutalert').html("")
                        $('.layoutalert').addClass("d-none")

                        // console.log(response);
                        $(`#edit${project_id}`).remove();
                        $('#message').html("");
                        $('#message').addClass('alert alert-success')
                        $('#message').text(response.message)
                        $('#deleteProjectModal').modal('hide')
                        $('#deleteProjectModal').find('input').val("")
                    } else {
                        $(".deleteprojectalert").removeClass('d-none');
                        $('.deleteprojectalert').html(`${response.message}`)
                    }
                }
            });
        });
    })
</script>
