const cacheName = 'playlist-app-v1';
const assetsToCache = [
    'index.php',
    'assets/style.css',
    'assets/app.js',
    'assets/icon.png'
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(cacheName).then(cache => {
            return cache.addAll(assetsToCache);
        })
    );
});

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request).then(response => {
            return response || fetch(event.request);
        })
    );
});
