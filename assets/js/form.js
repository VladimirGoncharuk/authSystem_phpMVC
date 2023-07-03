$('#registr').on('click', function () {
    $('#registration').submit(function (e) {
        e.preventDefault();
        var data = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'Form',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                swal(
                    {title: "Отлично!", text: "Пользователь успешно зарегистрирован!", icon: "success"}
                ).then(() => {
                    location.assign('/galleryadd');
                });

            },

            error: function (response, status, error) {

                var errors = JSON.parse(response['responseText']);
                if (errors.errors) {
                    errors
                        .errors
                        .forEach(function (data, index) {
                            var field = Object.getOwnPropertyNames(data);
                            var value = data[field];
                            var div = $("#" + field[0]).closest('div');
                            div.addClass('has-danger');
                            div
                                .children('.form-control-feedback')
                                .text(value)
                        });
                }
            }
        });

    });
});

$('#authorization').on('click', function () {
    $('#registration').submit(function (e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'Authorization',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {

                swal({title: "Отлично!", text: "Пользователь авторизован!", icon: "success"}).then(
                    () => {
                        location.assign('/galleryadd');
                    }
                );
            },
            error: function (response, status, error) {

                var errors = JSON.parse(response['responseText']);

                if (errors.errors) {
                    errors
                        .errors
                        .forEach(function (data, index) {
                            var field = Object.getOwnPropertyNames(data);
                            var value = data[field];
                            var div = $("#" + field[0]).closest('div');
                            div.addClass('has-danger');
                            div
                                .children('.form-control-feedback')
                                .text(value)
                        });
                }
            }
        });

    });
});

$('#authVK').on('click', function () {
    $('#registration').submit(function (e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'AuthVK',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {

                swal({title: "VK!", text: "Авторизация VK!", icon: "success"}).then(() => {
                    location.assign(
                        "https://oauth.vk.com/authorize?client_id=51691065&scope=email,offline&redirect" +
                        "_uri=http://localhost:8000/VKconfirm/index/&response_type=code"
                    )
                });
            },
            error: function (response, status, error) {
                var errors = JSON.parse(response['responseText']);

                if (errors.errors) {
                    errors
                        .errors
                        .forEach(function (data, index) {
                            var field = Object.getOwnPropertyNames(data);
                            var value = data[field];
                            var div = $("#" + field[0]).closest('div');
                            div.addClass('has-danger');
                            div
                                .children('.form-control-feedback')
                                .text(value)
                        });
                }
            }
        });

    });
});

document
    .querySelector(`#out`)
    .onclick = function () {
        $.ajax({
            url: 'Home/out',
            success: function (response) {
                location.assign('/home');
            }
        })
    }