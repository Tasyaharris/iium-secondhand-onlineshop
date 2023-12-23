//import axios from "axios";

document.addEventListener("DOMContentLoaded", function (e) {
    document.querySelector("#type-area").addEventListener("keydown", function (e) {
        if (e.key === 'Enter') {
            let input = this.value;
            if (input !== "") {
                sendMessage(input)

                this.value = ""
            }
        }
    });

    // Add an event listener to the "Send" button
    document.querySelector("#send-button").addEventListener("click", function () {
        let input = document.querySelector("#type-area").value;
        if (input !== "") {
            sendMessage(input);
            document.querySelector("#type-area").value = "";
        }
    });

    // handel click friend
    document.querySelectorAll(".friends").forEach(function (el) {
        el.addEventListener("click", function () {
            let id = el.getAttribute("data-id");
            let name = el.getAttribute("data-name");
            
            // set chat room properties
            document.querySelector(".friend-name").innerHTML = name
            createRoom(id)
        });
    });
});


/*
    handel send message function
 */
function sendMessage(message, date) {
    let html = ' <div id="your-chat" class="your-chat">\n' +
        '                <p class="your-chat-balloon">'+ message +'</p>\n' +
        '            </div>';

    var chatBody = document.querySelector("#chat-area");
        chatBody.insertAdjacentHTML("beforeend", html);
        chatBody.scrollTo({ left: 0, top: chatBody.scrollHeight, behavior: "smooth" });
}

/*
    handel to left message from friend
 */
function handelLeftMessage(message , avatar) {

    let html = '<div class="friends-chat">\n' +
        '                <div class="profile friends-chat-photo">\n' +
        '                    <img src="'+ avatar +'" alt="">\n' +
        '                </div>\n' +
        '                <div class="friends-chat-content">\n' +
        '                    <p class="friends-chat-name">'+ message +'</p>\n' +
        '                </div>\n' +
        '            </div>';

    var chatBody = document.querySelector("#chat-area");
        chatBody.insertAdjacentHTML("beforeend", html);
        chatBody.scrollTo({ left: 0, top: chatBody.scrollHeight, behavior: "smooth" });
}

/*
    handel show hide chatbox
 */
function showHideChatBox(show) {
    if (show == true) { 
        document.getElementById("main-right").classList.remove("hidden")
        document.getElementById("main-empty").classList.add("hidden")
    } else {
        document.getElementById("main-right").classList.add("hidden")
        document.getElementById("main-empty").classList.remove("hidden")
    }
}

function createRoom(friendId) {
    let url = document.getElementById("room-url").value;
    let authUserId = document.getElementById("auth-user-id").value;
    
 
    let formData = new FormData();
    formData.append("friend_id", friendId);
    formData.append("user_id", authUserId);


    axios.post(url, formData)
        .then(function (res) {
            let room = res.data.data;
            // Convert to string if not already
            room.id = String(room.id);

            Echo.join(`chat.${room.id}`)
            .here((users) => {
                console.log("join channel success");
            })
            .joining((user) => {
                console.log(user.name);
            })
            .leaving((user) => {
                console.log(user.name);
            })
            .error((error) => {
                console.log("join channel failed");
                console.log(error);
                console.log(room.id)

            });

            showHideChatBox(true);
         });
} 