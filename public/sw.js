const hot_cache = 'hot_cache_v1';
const staticAssets = [
    "/hothothot",
    "/public/js/main.js",
    "/public/js/modules/alert.js",
    "/public/js/modules/const.js",
    "/public/js/modules/utils.js",
    "/public/assets/favicon/favicon-16x16.png",
    "/public/assets/favicon/favicon-32x32.png",
    "/public/assets/favicon/android-chrome-192x192.png",
    "/public/assets/favicon/android-chrome-512x512.png",
    "/public/assets/logo.svg",
    "/public/assets/img/arrow.svg",
    "/public/assets/img/arrow-nobar.svg",
    "/public/assets/img/edit.svg",
    "/public/assets/img/Info.svg",
    "/public/assets/img/Info.webp",
    "/public/assets/img/NoAlert.svg",
    "/public/assets/img/profilePicture.jpg",
    "/public/assets/img/setting.svg",
    "/public/assets/img/Warning.svg",
    "/public/assets/img/Warning.webp",
]

// On install, cache static file.
self.addEventListener('install', async e => {
    const cache = await caches.open(hot_cache);
    await cache.addAll(staticAssets);
    return self.skipWaiting();
})

self.addEventListener('activate', e => {
    self.clients.claim();
})

self.addEventListener('fetch', async e => {
    const req = e.request;
    const url = new URL(req.url)

    if (url.origin === location.origin) {
        e.respondWith(cacheFirst(req));
    } else {
        e.respondWith(networkAndCache(req));
    }
})

async function cacheFirst(req) {
    const cache = await caches.open(hot_cache);
    const cached = await cache.match(req);
    return cached || fetch(req);
}

async function networkAndCache(req){
    const cache = await caches.open(hot_cache);
    try {
        const fresh = await fetch(req);
        await cache.put(req, fresh.clone());
        return fresh;
    }catch (e){
        const cached = await cache.match(req);
        return cached;
    }
}

// // On fetch, use cache but update the entry with the latest contents
// // from the server.
// self.addEventListener('fetch', function(evt) {
//     console.log('The service worker is serving the asset.');
//     // You can use `respondWith()` to answer ASAP...
//     evt.respondWith(fromCache(evt.request));
//     // ...and `waitUntil()` to prevent the worker to be killed until
//     // the cache is updated.
//     evt.waitUntil(
//         update(evt.request)
//             // Finally, send a message to the client to inform it about the
//             // resource is up to date.
//             .then(refresh)
//     );
// });
//
// // Open the cache where the assets were stored and search for the requested
// // resource. Notice that in case of no matching, the promise still resolves
// // but it does with `undefined` as value.
// function fromCache(request) {
//     return caches.open(CACHE).then(function (cache) {
//         return cache.match(request);
//     });
// }
//
//
// // Update consists in opening the cache, performing a network request and
// // storing the new response data.
// function update(request) {
//     return caches.open(CACHE).then(function (cache) {
//         return fetch(request).then(function (response) {
//             return cache.put(request, response.clone()).then(function () {
//                 return response;
//             });
//         });
//     });
// }
//
// // Sends a message to the clients.
// function refresh(response) {
//     return self.clients.matchAll().then(function (clients) {
//         clients.forEach(function (client) {
//             // Encode which resource has been updated. By including the
//             // [ETag](https://en.wikipedia.org/wiki/HTTP_ETag) the client can
//             // check if the content has changed.
//             var message = {
//                 type: 'refresh',
//                 url: response.url,
//                 // Notice not all servers return the ETag header. If this is not
//                 // provided you should use other cache headers or rely on your own
//                 // means to check if the content has changed.
//                 eTag: response.headers.get('ETag')
//             };
//             // Tell the client about the update.
//             client.postMessage(JSON.stringify(message));
//         });
//     });
// }

