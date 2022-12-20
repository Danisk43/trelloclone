<div class="header">
    <div class="menubar">
        <nav class="navbar navbar-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand"><b>Taskit</b></a>
                <div class="d-flex">
                    <form class="d-flex me-3">
                        <input class="form-control me-2 search-task-input" name="search-input" type="search"
                            placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success search-task" type="submit">Search</button>
                    </form>
                    <a class="navbar-brand"><b class="usernamehead text-success"></b></a>
                    <a href="/logout"> <button class="upper-btn btn btn-success form-control logout"
                            style="width:100px;">Logout</button></a>
                </div>
            </div>
        </nav>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '.search-task', function(e) {
            // console.log('object');
            e.preventDefault();
            var project_id = $('.selected').data('value');
            if (!project_id) {
                $('.green-task').html("<p class='fst-italic'>Please select a project to search</p>")
                return
            }
            var searchInput = $('.search-task-input').val();
            // console.log(project_id)

            var data = {
                'search-input': searchInput
            }


            $.ajax({
                type: "POST",
                url: "/api/project/" + project_id + "/task/search",
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

                                <p class="fst-italic">Showing results for "${searchInput}"</p>
                                <div class="no-status"></div>`)
                        // console.log(response.result.length);

                        // console.log(response.result.length);
                        $.each(response.result, function(key, item) {
                            if (item.tasks.length != 0) {
                                exists = true
                                // console.log(item.tasks.length);
                                $('.green-task').append(
                                    `<div class="TaskDiv${item.id}"><h5 class="statush ps-3 pe-3 status${item.id}">${item.type}</h5></div>`
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


        $(document).on('click', '.logout', function(e) {
            e.preventDefault();
            localStorage.removeItem("token");
            // console.log('object');
            $.ajax({
                type: "GET",
                refreshRequest: true,
                url: "/logout",
                dataType: "json",
                success: function(response) {}
            });
            window.location.href = "/login";
        });
    })
</script>
