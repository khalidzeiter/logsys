$('.notifications').hide();
$('.signup').hide();

function notification(data, color) {
    $('.notifications').css('background', color);
    $('.notifications').text(data);
    $('.notifications').slideDown('slow');
}

$('#signup').on('click', function () {
    $('.login').hide();
    $('.signup').fadeIn('slow');
});
$('#login').on('click', function () {
    $('.signup').hide();
    $('.login').fadeIn('slow');
});

$('input[value=Login]').on('click', function (e) {
    e.preventDefault();
    username = 'username=' + $('.login input[name=username]').val();
    password = 'password=' + $('.login input[name=password]').val();
    if ($('input[name="privilege"]').prop('checked') === true) {
        privilege = 'privilege=' + 1;
    } else {
        privilege = 'privilege=' + 2;
    }
    $.ajax({
        type: "POST",
        url: 'login.php',
        data: username + '&' + password + '&' + privilege,
        success: function (html) {
            if (html == "Login Successfully!") {
                color = "#393";
                notification(html, color);
                setTimeout(function () {
                    window.location = "dash"
                }, 1500);
            } else {
                color = "#c33";
                notification(html, color);
                setTimeout(function () {
                    $('.notifications').slideUp('slow');
                }, 1500);
            }
        }
    });
    return false;
});

$('input[value=Signup]').on('click', function (e) {
    e.preventDefault();
    name = 'name=' + $('.signup input[name=name]').val();
    username = 'username=' + $('.signup input[name=username]').val();
    email = 'email=' + $('.signup input[name=email]').val();
    bio = 'bio=' + $('.signup textarea[name=bio]').val();
    password = 'password=' + $('.signup input[name=password]').val();
    $.ajax({
        type: "POST",
        url: 'register.php',
        data: name + '&' + username + '&' + email + '&' + bio + '&' + password,
        success: function (html) {
            if (html == "User Created Successfuly!") {
                color = "#393";
                notification(html, color);
                setTimeout(function () {
                    $.ajax({
                        type: "POST",
                        url: 'dash/logout.php',
                        data: 'redirect',
                        success: function (redirect) {
                            window.location = redirect;
                        }
                    });
                }, 1500);
            } else {
                color = "#c33";
                notification(html, color);
                setTimeout(function () {
                    $('.notifications').slideUp('slow');
                }, 1500);
            }
        }
    });
    return false;
});

$('#logout').on('click', function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: 'logout.php',
        data: 'logout',
        success: function (html) {
            color = "#393";
            notification(html, color);
            setTimeout(function () {
                $.ajax({
                    type: "POST",
                    url: 'logout.php',
                    data: 'redirect',
                    success: function (redirect) {
                        window.location = redirect;
                    }
                });
            }, 1500);
        }
    });
    return false;
});

$('input[value=Edit]').on('click', function (e) {
    e.preventDefault();
    name = 'name=' + $('.editProfile input[name=name]').val();
    username = 'username=' + $('.editProfile input[name=username]').val();
    email = 'email=' + $('.editProfile input[name=email]').val();
    bio = 'bio=' + $('.editProfile textarea[name=bio]').val();
    password = 'password=' + $('.editProfile input[name=password]').val();
    $.ajax({
        type: "POST",
        url: 'users.php',
        data: name + '&' + username + '&' + email + '&' + bio + '&' + password + '&' + 'editUser',
        success: function (html) {
            if (html == "User Updated Successfuly!") {
                color = "#393";
                notification(html, color);
                setTimeout(function () {
                    $.ajax({
                        type: "POST",
                        url: 'users.php',
                        data: 'redirect',
                        success: function (redirect) {
                            window.location = redirect + '/dash';
                        }
                    });
                }, 1500);
            } else {
                color = "#c33";
                notification(html, color);
                setTimeout(function () {
                    $('.notifications').slideUp('slow');
                }, 1500);
            }
        }
    });
    return false;
});
$('.deleteUser').on('click', function (e) {
    e.preventDefault();
    userId = 'id=' + this.getAttribute('value');
    if (window.confirm("Are you sure?!") === true) {
        $.ajax({
            type: "POST",
            url: 'users.php',
            data: 'deleteUser&' + userId,
            success: function (html) {
                if (html.search('User') === 0) {
                    color = "#393";
                    notification(html, color);
                    setTimeout(function () {
                        window.location.reload();
                    }, 1500);
                } else {
                    color = "#c33";
                    notification(html, color);
                    setTimeout(function () {
                        $('.notifications').slideUp('slow');
                    }, 1500);
                }
            }
        });
    }
    return false;
});
$('.editUser').on('click', function (e) {
    e.preventDefault();
    window.location = 'profile.php?edit&' + userId;
});
$('.banUser').on('click', function (e) {
    e.preventDefault();
    userId = 'id=' + this.getAttribute('value');
    banState = 'state=' + this.getAttribute('ban');
    console.log(userId + '&' + banState + '&' + 'banUser');
    $.ajax({
        type: "POST",
        url: 'users.php',
        data: userId + '&' + banState + '&' + 'banUser',
        success: function (html) {
            if (html) {
                color = "#393";
                notification(html, color);
                setTimeout(function () {
                    window.location.reload();
                }, 1500);
            }
        }
    });
    return false;
});