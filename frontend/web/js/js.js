$(document).on("click", '.block', function () {
    var block = $(this);
    var messageId = $(this).data('message_id');
    $.ajax({
        type: "POST",
        url: "/messages/block?id=" + messageId,
        contentType: "application/json; charset=utf-8",
        dataType: "json"
    });

    var func = function (data) {
        console.log('Block')
        block.removeClass('btn-danger');
        block.addClass('btn-success');

        block.text('Blocked');
        block.removeClass('block');
        block.addClass('blocked');
    }

    func();
});

$(document).on("click", '.blocked', function () {
    var block = $(this);
    var messageId = $(this).data('message_id');

    $.ajax({
        type: "POST",
        url: "/messages/un-block?id=" + messageId,
        contentType: "application/json; charset=utf-8",
        dataType: "json"
    });

    var func = function (data) {
        console.log('Blocked')
        block.addClass('btn-danger');
        block.removeClass('btn-success');
        block.text('Unblock');
        block.addClass('block');
        block.removeClass('blocked');
    }

    func();
});


$(document).on("click", '.change-role', function () {
    var block = $(this);
    var userId = $(this).data('user_id');
    $.ajax({
        type: "POST",
        url: "/admin/change-role?user_id=" + userId,
        contentType: "application/json; charset=utf-8",
        dataType: "json"
    });

    var func = function (data) {
        block.removeClass('btn-primary');
        block.addClass('btn-danger');

        block.text('Change back');

        block.addClass('changed-role');
        block.removeClass('change-role');
    }

    func()

});

$(document).on("click", '.changed-role', function () {
    var block = $(this);
    var userId = $(this).data('user_id');

    $.ajax({
        type: "POST",
        url: "/admin/un-change-role?user_id=" + userId,
        contentType: "application/json; charset=utf-8",
        dataType: "json"
    });

    var func = function (data) {
        block.addClass('btn-primary');
        block.removeClass('btn-danger');
        block.text('Change role');

        block.addClass('change-role');
        block.removeClass('change-role');
    }
    func();

});
