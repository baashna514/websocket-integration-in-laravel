# Laravel WebSocket Configuration Guide

This guide outlines the steps to configure WebSocket in a Laravel project using the `beyondcode/laravel-websockets` package. WebSocket allows real-time, bi-directional communication between clients and servers.

## Installation Steps

1. Install the `beyondcode/laravel-websockets` package using Composer:

    ```bash
    composer require beyondcode/laravel-websockets
    ```

2. Publish the package's migrations:

    ```bash
    php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"
    ```

3. Migrate the database:

    ```bash
    php artisan migrate
    ```

4. Publish the package's configuration file:

    ```bash
    php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"
    ```

5. Require the Pusher PHP SDK:

    ```bash
    composer require pusher/pusher-php-server "~3.0"
    ```

6. Update the `.env` file to set the broadcast driver to Pusher:

    ```dotenv
    BROADCAST_DRIVER=pusher
    ```

7. Update the broadcasting configuration in `config/broadcasting.php`:

    ```php
    'pusher' => [
        'driver' => 'pusher',
        'key' => env('PUSHER_APP_KEY'),
        'secret' => env('PUSHER_APP_SECRET'),
        'app_id' => env('PUSHER_APP_ID'),
        'options' => [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => env('PUSHER_APP_TLS', true), // Set to true for localhost, false for production
            'host' => env('PUSHER_APP_HOST', '127.0.0.1'),
            'port' => env('PUSHER_APP_PORT', 6001),
            'scheme' => env('PUSHER_APP_SCHEME', 'http'),
        ],
    ],
    ```

8. Install NPM dependencies:

    ```bash
    npm install
    ```

9. Install Laravel Echo and Pusher JS:

    ```bash
    npm install --save-dev laravel-echo pusher-js
    ```

10. Update `resources/js/bootstrap.js`:

    ```javascript
    import Echo from 'laravel-echo';
    window.Pusher = require('pusher-js');
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY,
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        forceTLS: true, // Set to false for localhost
        wsHost: window.location.hostname,
        wsPort: 6001,
        disableStats: true,
    });
    ```

11. Compile assets:

    ```bash
    npm run dev
    ```

## Usage

You can now use Laravel WebSocket for real-time communication between clients and servers in your Laravel application.
