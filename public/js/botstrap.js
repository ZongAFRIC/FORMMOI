import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});


Echo.channel('message')
    .listen('MessageSent', (e) => {
        console.log(e.message);
        // Code pour ajouter le nouveau message dans le DOM sans recharger la page
    });
