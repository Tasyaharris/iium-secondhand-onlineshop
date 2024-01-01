<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/chat.css">

    

  </head>
  <body>

    <ul id="list-messages">

    </ul>

    <form id="form" method="post" action="/chats-create ">
      @csrf
      <label for="input-message">Message:</label>
      <input id="input-message" type="text">
    </form>

    


    {{-- url --}}
    <input type="hidden" id="chat-url" value="{{ route("chat.create") }}">
    @vite('resources/js/app.jsx')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
   
    
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>

    
    let url = document.getElementById("chat-url").value;
    const form = document.getElementById('form');
    const inputMessage = document.getElementById('input-message');
    const listMessage = document.getElementById('list-messages');
    
    form.addEventListener('submit', function (event){
        event.preventDefault();
    const userInput = inputMessage.value;

    axios.post(url, {message: userInput}
    )

});


    </script>
 

  </body>
</html>