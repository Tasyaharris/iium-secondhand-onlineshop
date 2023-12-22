/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    //authEndpoint: '/broadcasting/auth',
    enabledTransports: ['ws', 'wss'],
});

// Subscribe to a presence channel
const channel = window.Echo.join(`chat.${room.id}`);

// Bind to events
channel.here((users) => {
    // Log the list of users present in the channel
    console.log("Users present in the channel:", users);
});

channel.joining((user) => {
    // Log when a user is joining the channel
    console.log(user.name + ' is joining the channel');
});

channel.leaving((user) => {
    // Log when a user is leaving the channel
    console.log(user.name + ' is leaving the channel');
});

//window.Echo = new Echo({
//    broadcaster: 'pusher',
//    key: import.meta.env.VITE_PUSHER_APP_KEY,
//    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'ap1',
//    encrypted: true,
//});
