$(document).ready(function(){

    $.ajax({
      url: "http://localhost/Abnorm-test/app/getListMessages.php",
      dataType: 'json',
      success: function(data){
        if (data.status === "OK") {
          const messageList = $(".messages-container__list")[0];

          $("#lastId").val(data.lastId);

          $(messageList).prepend(addNewMessages(data.messages));
        }
      },
      complete: function(){
            createLikeEvent();
      }
    });



    
    $(".chat-container__form").submit(function (e) {
        e.preventDefault();
        
        const name = $("#name-form-chat").val().trim();
        const message = $("#message-form-chat").val().trim();
        const lastId = $("#lastId").val().trim();
        
        if (name.length <= 0 || message.length <= 0) {
            return;
        }
        
        $.ajax({
          url: "http://localhost/Abnorm-test/app/createMessage.php",
          method: "POST",
          dataType: "json",
          data: {
              name,
              message,
              lastId
          },
          success: function (data) {
            if (data.status === "OK") {
              const messageList = $(".messages-container__list")[0];

              $("#lastId").val(data.lastId);
              $(messageList).prepend(addNewMessages(data.messages));
            }
          },
          complete: function () {
            createLikeEvent();
          },
        });
    });
    

    function createLikeEvent() {
      $(".heart").click(function () {
        const element = $(this);
        let action = "";

        if (element.hasClass("far")) {
            action = "like";
        } else if (element.hasClass("fas")) {
            action = "dislike";
        }

        if (action !== "") {
            const data = {
              action,
              messageId: $(this).parent().parent().attr("data-id"),
            };

            $.ajax({
              url: "http://localhost/Abnorm-test/app/updateLikes.php",
              method: "POST",
              dataType: "json",
              data,
              success: function (data) {
                  if(data.status === 'OK'){
                      $(element).siblings(".like__count").text(`(${data.likes})`);;
                      $(element).toggleClass("far fas");
                  }
              }
            });
        }

      });
    }

    function addNewMessages(messages){
        const newList = [];

        messages.forEach(function ({ id, name, message, created_at, likes }) {
            const messageContainer = $(`<div class='list__message' data-id='${id}'></div>`);

            messageContainer.append($(`<h4 class='message__name'>${name}</h4>`));
            messageContainer.append($(`<p class='message__content'>${message}</p>`));
            messageContainer.append($(`<p class='message__date'>${created_at}</p>`));
            messageContainer.append(
              $(`<span class='message__like'>
                    <b class="like__count">(${likes})</b>
                    <i class="pointer heart far fa-heart"></i>
                </span>`));

            newList.push(messageContainer);
        });

        return newList;
    }

    $(".chat-container__title").click(function () {
        $(".chat-container__form").toggle("slow");
    });

    $(".messages-container__title").click(function () {
        $(".messages-container__list").toggle("slow");
    });


});

