$(function () {

    Pusher.logToConsole = false;

    $(".messaging--dropdown").hide();




    var pusher = new Pusher('857abf648584080c1ae0', {
        cluster: 'mt1',
        forceTLS: true
    });

    let channel = pusher.subscribe('chat');


    // on click on any chat btn render the chat box
    $(".chat-toggle").on("click", function (e) {
        e.preventDefault();

        let ele = $(this);

        let user_id = ele.attr("data-id");

        let username = ele.attr("data-user");

        let chatBox = $("#chat_box_" + user_id);

        if(!chatBox.hasClass("chat-opened")) {
            chatBox.addClass("chat-opened").slideDown("fast");
        } else {
            $("div.chat-opened").removeClass("chat-opened").hide();
            return false;
        }

        cloneChatBox(user_id, username, function () {

            let chatBox = $("#chat_box_" + user_id);

            if(!chatBox.hasClass("chat-opened")) {

                chatBox.addClass("chat-opened").slideDown("fast");

                loadLatestMessages(chatBox, user_id);

                chatBox.find(".chat-area").animate({scrollTop: chatBox.find(".chat-area").offset().top + chatBox.find(".chat-area").outerHeight(true)}, 800, 'swing');
            }
        });
    });

    // on close chat close the chat box but don't remove it from the dom
    $(".close-chat").on("click", function (e) {
        $(this).parents("div.chat-opened").removeClass("chat-opened").slideUp("fast");
    });



    // on click the btn send the message
    $(".btn-chat").on("click", function (e) {
        send($(this).attr('data-to-user'), $("#chat_box_" + $(this).attr('data-to-user')).find(".trumbowyg-editor").text());
    });

    // listen for the send event, this event will be triggered on click the send btn
    channel.bind('send', function(data) {
        displayMessage(data.data);
    });

    // handle the scroll top of any chat box
    // the idea is to load the last messages by date depending of last message
    // that's already loaded on the chat box
    let lastScrollTop = 0;

    $(".chat-area").on("scroll", function (e) {

        let st = $(this).scrollTop();

        if(st < lastScrollTop) {

            fetchOldMessages($(this).parents(".chat-opened").find("#to_user_id").val(), $(this).find(".msg_container:first-child").attr("data-message-id"));
        }

        lastScrollTop = st;
    });

    // listen for the oldMsgs event, this event will be triggered on scroll top
    channel.bind('oldMsgs', function(data) {
        displayOldMessages(data);
    });
});


/**
 * loaderHtml
 *
 * @returns {string}
 */
function loaderHtml() {
    return '<i class="glyphicon glyphicon-refresh loader"></i>';
}

/**
 * getMessageSenderHtml
 *
 * this is the message template for the sender
 *
 * @param message
 * @returns {string}
 */
function getMessageSenderHtml(message)
{
    return `
           <div class="conversation msg_container" data-message-id="${message.id}">
        <div class="head">
            <div class="chat_avatar">
                <img src="/chat/images/usr_avatar.png" alt="Notification avatar">
            </div>

            <div class="name_time">
                <div>
                    <h4>${message.fromUserName}</h4>
                    <p><time datetime="${message.dateTimeStr}"> ${message.fromUserName} • ${message.dateHumanReadable} </time></p>
                </div>
                <span class="email">${message.from_user.email}</span>
            </div>
            <!-- end /.name_time -->
        </div>
        <!-- end /.head -->

        <div class="body">
            <p>
                ${message.content}
            </p>
        </div>
        <!-- end /.body -->
    </div>
    `;
}

function notificationMessages(message)
{
    let total_messages = $(".notification_count.msg").text();



    if(total_messages == '' || total_messages == 0){
        $(".notification_count.msg").text('1');
        $("span.msg").text('1');
    } else {
        total_messages = parseInt(total_messages) + 1;
        $(".notification_count.msg").text(total_messages);
        $("span.msg").text(total_messages);
    }



    let new_messages = `
    <a href="javascript:void(0)" class="message recent">
                                                <div class="message__actions_avatar">
                                                    <div class="avatar">
                                                        <img src="/chat/images/notification_head4.png" alt="">
                                                    </div>
                                                </div>
                                                <!-- end /.actions -->

                                                <div class="message_data">
                                                    <div class="name_time">
                                                        <div class="name">
                                                            <p>${message.fromUserName}</p>
                                                            <span class="lnr lnr-envelope"></span>
                                                        </div>

                                                        <span class="time">&nbsp;&nbsp;${message.dateHumanReadable} </span>
                                                        <p>Te enviou uma mensagem ... <br>${message.content}</p>
                                                    </div>
                                                </div>
                                                <!-- end /.message_data -->
                                            </a>
    `;

    $(".messaging--dropdown").show();
    $(".dropdowns .messages").append(new_messages);

}


/**
 * getMessageReceiverHtml
 *
 * this is the message template for the receiver
 *
 * @param message
 * @returns {string}
 */
function getMessageReceiverHtml(message)
{
    return `
           <div class="row msg_container base_receive" data-message-id="${message.id}">
           <div class="col-md-2 col-xs-2 avatar">
             <img src="/chat/images/user-avatar.png" width="50" height="50" class="img-responsive">
           </div>
        <div class="col-md-10 col-xs-10">
            <div class="messages msg_receive text-left">
                <p>${message.content}</p>
                <time datetime="${message.dateTimeStr}"> ${message.fromUserName}  • ${message.dateHumanReadable} </time>
            </div>
        </div>
    </div>
    `;
}


function closeChat()
{
    $("div.chat-opened").removeClass("chat-opened").hide();
}


/**
 * cloneChatBox
 *
 * this helper function make a copy of the html chat box depending on receiver user
 * then append it to 'chat-overlay' div
 *
 * @param user_id
 * @param username
 * @param callback
 */
function cloneChatBox(user_id, username, callback)
{


    closeChat();

    if($("#chat_box_" + user_id).length == 0) {

        let cloned = $("#chat_box").clone(true);

        // change cloned box id
        cloned.attr("id", "chat_box_" + user_id);

        cloned.find(".name").text(username);

        cloned.find(".btn-chat").attr("data-to-user", user_id);

        cloned.find("#to_user_id").val(user_id);

        $("#chat-overlay").append(cloned);
    }

    callback();
}

/**
 * loadLatestMessages
 *
 * this function called on load to fetch the latest messages
 *
 * @param container
 * @param user_id
 */
function loadLatestMessages(container, user_id)
{
    let chat_area = container.find(".chat-area");

    chat_area.html("");

    $.ajax({
        url: "/chat/load-latest-messages",
        data: {user_id: user_id, _token: $("meta[name='csrf-token']").attr("content")},
        method: "GET",
        dataType: "json",
        beforeSend: function () {
            if(chat_area.find(".loader").length  == 0) {
                chat_area.html(loaderHtml());
            }
        },
        success: function (response) {
            if(response.state == 1) {
                response.messages.map(function (val, index) {
                    $(val).appendTo(chat_area);
                });
            }
        },
        complete: function () {
            chat_area.find(".loader").remove();
        }
    });
}

/**
 * send
 *
 * this function is the main function of chat as it send the message
 *
 * @param to_user
 * @param message
 */
function send(to_user, message)
{



    let chat_box = $("#chat_box_" + to_user);
    let chat_area = chat_box.find(".chat-area");

    $.ajax({
        url: "/chat/send",
        data: {to_user: to_user, message: message, _token: $("meta[name='csrf-token']").attr("content")},
        method: "POST",
        dataType: "json",
        beforeSend: function () {
            if(chat_area.find(".loader").length  == 0) {
                chat_area.append(loaderHtml());
            }
        },
        success: function (response) {

        },
        complete: function () {
            chat_area.animate({scrollTop: $('.chat-area')[1].scrollHeight}, 800, 'swing');
        }
    });
}

/**
 * This function called by the send event triggered from pusher to display the message
 *
 * @param message
 */
function displayMessage(message)
{
    let alert_sound = document.getElementById("chat-alert-sound");

    if($("#current_user").val() == message.from_user_id) {


        let messageLine = getMessageSenderHtml(message);

        $("#chat_box_" + message.to_user_id).find(".chat-area").append(messageLine);

    } else if($("#current_user").val() == message.to_user_id) {

        alert_sound.play();

        notificationMessages(message);



        // for the receiver user check if the chat box is already opened otherwise open it
        cloneChatBox(message.from_user_id, message.fromUserName, function () {

            let chatBox = $("#chat_box_" + message.from_user_id);

            if(!chatBox.hasClass("chat-opened")) {

                chatBox.addClass("chat-opened").slideDown("fast");

                loadLatestMessages(chatBox, message.from_user_id);

                let chat_box = $("#chat_box_" + message.to_user_id);
                let chat_area = chat_box.find(".chat-area");

                chat_area.animate({scrollTop: $('.chat-area')[0].scrollHeight}, 800, 'swing');


                // chatBox.find(".chat-area").animate({scrollTop: chatBox.find(".chat-area").offset().top + chatBox.find(".chat-area").outerHeight(true)}, 800, 'swing');
            } else {



                let messageLine = getMessageReceiverHtml(message);

                // append the message for the receiver user
                $("#chat_box_" + message.from_user_id).find(".chat-area").append(messageLine);
            }
        });
    }
}

/**
 * fetchOldMessages
 *
 * this function load the old messages if scroll up triggerd
 *
 * @param to_user
 * @param old_message_id
 */
function fetchOldMessages(to_user, old_message_id)
{
    let chat_box = $("#chat_box_" + to_user);
    let chat_area = chat_box.find(".chat-area");

    $.ajax({
        url: "/chat/fetch-old-messages",
        data: {to_user: to_user, old_message_id: old_message_id, _token: $("meta[name='csrf-token']").attr("content")},
        method: "GET",
        dataType: "json",
        beforeSend: function () {
            if(chat_area.find(".loader").length  == 0) {
                chat_area.prepend(loaderHtml());
            }
        },
        success: function (response) {
        },
        complete: function () {
            chat_area.find(".loader").remove();
        }
    });
}

function displayOldMessages(data)
{
    if(data.data.length > 0) {
        data.data.map(function (val, index) {
            $("#chat_box_" + data.to_user).find(".chat-area").prepend(val);
        });
    }
}
