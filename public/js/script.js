$(document).ready(function(){
    $(document).on('click','.delete',function(e){
        e.preventDefault();

        $.post($(this).attr('href'), {id: $(this).data('id')}, function(data, status) {
            $('.container').find('.error').remove();
            if(data === "error") {
                var errorTag = $('.container').find('.error');
                if(errorTag.length) {
                    errorTag.remove();
                }
                $('.container').prepend('<p class="error">Uživatel je online a nelze odstranit.</p>');

            } else {
                var users = JSON.parse(data);
                var usersBody = $('#users > tbody');
                usersBody.empty();
                $.each(users, function(key, user) {
                    $html = "<tr>" +
                        "<td>" + user.id + "</td>" +
                        "<td>" + user.username + "</td>" +
                        "<td>" + user.email + "</td>" +
                        "<td>" + user.created_at + "</td>" +
                        "<td>" + (user.updated_at || '') + "</td>" +
                        "<td>" + (user.last_activity || '') + "</td>" +
                        "<td><a href='edit/" + user.id + "'>Upravit</a></td>" +
                        "<td><a class='delete' href='delete' data-id='" + user.id + "'>Smazat</a></td>" +
                        "</tr>";
                    usersBody.append($html);
                });
            }

        });
    });
});

function update_user_activity() {
    $.ajax({
        url: 'updateActivity',
        method: 'post',
        cache: false,

    });
}
