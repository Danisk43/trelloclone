<div class="d-flex flex-row">
    <div class="d-flex flex-column flex-shrink-0 p-3 sidebar fixed-top" style="width: 280px;">
        {{-- <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
    <svg class="bi me-2" width="40" height="32">
        <use xlink:href="#bootstrap"></use>
    </svg>
</a> --}}
        <span class="fs-4 align-self-center">Projects</span>
        <hr>
        <button type="button" class="btn btn-success add-new-project" data-bs-toggle="modal"
            data-bs-target="#addProjectModal">
            Add New Project
        </button>

        <hr>
        <ul class="nav nav-pills flex-column mb-auto project-sidebar">

        </ul>

    </div>

    <div class="green-task list-group p-3">
        <div class="alert alert-danger text-center m-0 p-2 layoutalert d-none" role="alert">

        </div>

    </div>

</div>
<script>
    $(document).ready(function() {

        $.ajax({
            type: "GET",
            url: "/api/project",
            dataType: "json",
            success: function(response) {
                if (response.status == 200) {
                    $('.layoutalert').html("")
                    $('.layoutalert').addClass("d-none")
                    $('.project-sidebar').html("")
                    // console.log(response.projects.length);
                    if (response.projects.length == 0) {
                        $('.project-sidebar').append(`<p class="text-center">No Projects Found</p>`)
                        $('.project-sidebar').addClass('no-project')
                    }
                    $.each(response.projects, function(key, item) {
                        $('.project-sidebar').append(`
                <li class="d-flex justify-content-between show_tasks" id="edit${item.id}" data-value=${item.id} data-id=${item.id}>
                    <a href="#" class="nav-link link-dark ps-1">
                   <span id="changename${item.id}">${item.name}</span>
                  </a>
                  <div class="mt-2">
                    <button class="edit_project" value=${item.id} data-value=${item.name}>
                        <i class="bi bi-pencil-square"></i>
                        </button>
                    <button class="share_project" value=${item.id}>
                        <i class="bi bi-share"></i>
                    </button>
                    <button class="delete_project" value=${item.id}>
                      <i class="bi bi-trash" ></i>
                    </button>
                  </div>
                </li>
                 `)
                    });
                } else {
                    // console.log(response);
                    $(".layoutalert").removeClass('d-none');
                    $('.layoutalert').html(`${response.message}`)
                }
                var base64Url = localStorage.getItem('token').split('.')[1];
                var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(
                    c) {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                }).join(''));
                var user = JSON.parse(jsonPayload);
                $('.usernamehead').html(user.userid.first_name)
            }
        });

    })
</script>
