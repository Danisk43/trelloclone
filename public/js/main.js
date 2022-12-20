$(document).ready(function() {
    // fetchProjects();


    $.ajaxPrefilter(async function(options, originalOptions, jqXHR) {
            // console.log(originalOptions.url);
            if (originalOptions.url == 'set-token' || originalOptions.url == 'logout' || options
                .refreshRequest == true) {
                // console.log('object');
                return
            } else {
                function parseJwt(token) {
                    var base64Url = token.split('.')[1];
                    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                    var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(
                        c) {
                        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                    }).join(''));

                    return JSON.parse(jsonPayload);
                }
                // console.log(parseJwt(localStorage.getItem('token')).exp,(Date.now()/1000));
                if (localStorage.getItem('token') == null || parseJwt(localStorage.getItem('token'))
                    .exp < (Date.now() / 1000)) {
                    localStorage.removeItem("token");
                    jqXHR.abort();
                    let tokenW = await $.ajax({
                        type: "GET",
                        refreshRequest: true,
                        url: "/set-token",
                        dataType: "json",
                    });
                    localStorage.setItem('token', tokenW.jwt);
                    $.ajax(options)
                }
            }
        }

    )

    $.ajaxSetup({
        beforeSend: function(xhr) {
            xhr.setRequestHeader('token', localStorage.getItem('token'));
        }
        
    });


})
