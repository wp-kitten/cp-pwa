// Initialize the service worker
if ( 'serviceWorker' in navigator ) {
    navigator.serviceWorker.register( CpPwaServiceLocale.service_worker_url, {
        scope: '.'
    } ).then( function (registration) {
        // Registration was successful
        console.log( 'ValPress PWA: ServiceWorker registration successful with scope: ', registration.scope );
    }, function (err) {
        // registration failed :(
        console.log( 'ValPress PWA: ServiceWorker registration failed: ', err );
    } );
}
