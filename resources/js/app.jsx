import './bootstrap';
import 'flowbite';
import axios from 'axios';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

// function getCookie(name){
//     const value = `; ${document.cookie}`;
//     const parts = value.split(`; ${name}=`);
//     if (parts.length === 2) {
//         return parts.pop().split(';').shift();
//     }
// }

// function request(url, options){
//     // get cookie
//     const csrfToken = getCookie('XSRF-TOKEN');
//     return fetch(url, {
//         headers: {
//             'content-type': 'application/json',
//             'accept': 'application/json',
//             'X-XSRF-TOKEN': decodeURIComponent(csrfToken),
//         },
//         credentials: 'include',
//         ...options,
//     })
// }

// function logout(){
//     return request('/logout', {
//         method: 'POST'
//     });
// }

// function login(){
//     return request('/login', {
//         method: "POST",
//         body: JSON.stringify({
//             email: 'luz72@example.net',
//             'password': 'password'
//         })
//     })
// }

// fetch('/sanctum/csrf-cookie', {
//     headers: {
//         'content-type': 'application/json',
//         'accept': 'application/json'
//     },
//     credentials: 'include'
// }).then(() => logout())
// .then(() => {
//     return login();
// }).then(() => {
    const channel = Echo.channel('messages');

channel.subscribed(()=>{
    console.log('subscribed!');
}).listen('.messages', (event)=> {
    console.log(event);
    const message = event.messages;

    const li = document.createElement('li');

    li.textContent = message;

    listMessage.append(li);
});


// })






