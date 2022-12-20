<div class="modal fade" id="shareProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Share Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center m-0 p-2 shareprojectalert d-none" role="alert">

                </div>
                <form>
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">User Details</label>
                        <input type="email" required placeholder="Enter User's Email" class="form-control share-mail"
                            id="share_project_email" aria-describedby="emailHelp">
                        <span class="text-danger text-md sharemodalspan"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success save_share_project">Share</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '.share_project', function(e) {
            e.preventDefault();
            var project_id = $(this).val();
            // console.log(project_id)
            $('.save_share_project').val(project_id);
            $('#shareProjectModal').modal('show');
            $('.share-mail').val("");
            $('.sharemodalspan').html("")
            $('.shareprojectalert').addClass("d-none")

            // console.log($('.save_edit_project').val())
        });

        $(document).on('click', '.save_share_project', function(e) {
            e.preventDefault();
            var data = {
                "email": $('#share_project_email').val()
            }
            var project_id = $('.save_share_project').val();
            var email = $('#edit_project_name').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: `/api/project/${project_id}/share`,
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response.status == 200) {
                        $('.shareprojectalert').html("")
                        $('.shareprojectalert').addClass("d-none")

                        $('#shareProjectModal').modal('hide')
                        $('#shareProjectModal').find('input').val("")
                        // $('#edit' + project_id + '').html(project_name)
                    } else if (response.status == 400) {
                        $('.shareprojectalert').html("")
                        $('.sharemodalspan').html(response.message.email)
                    } else {
                        $(".shareprojectalert").removeClass('d-none');
                        $('.shareprojectalert').html(`${response.message}`)
                    }
                },
                // error:function(request, status, error){ console.log(request, status, error)}
            });
        });
    })
</script>
