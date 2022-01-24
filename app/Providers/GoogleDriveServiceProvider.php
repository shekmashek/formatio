<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('google', function($app, $config) {
            $client = new \Google_Client();
            $client->setClientId($config['clientId']);
            $client->setClientSecret($config['clientSecret']);
            $client->refreshToken($config['refreshToken']);
            $client->setAccessType('offline');
            $client->fetchAccessTokenWithRefreshToken($config['refreshToken']);
            $client->setApprovalPrompt('force');
            $service = new \Google_Service_Drive($client);

            $options = [];
            if(isset($config['teamDriveId'])) {
                $options['teamDriveId'] = $config['teamDriveId'];
            }

            $adapter = new GoogleDriveAdapter($service, $config['folderId'], $options);

            return new \League\Flysystem\Filesystem($adapter);
        });
        // \Storage::extend('google', function($app, $config) {
        //     $client = new \Google_Client();
        //     $client->setClientId($config['clientId']);
        //     $client->setClientSecret($config['clientSecret']);
        //     $client->refreshToken($config['refreshToken']);
        //     $client->fetchAccessTokenWithRefreshToken($config['refreshToken']);
        //     $service = new \Google_Service_Drive($client);
        //     $adapter = new \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter($service, $config['folderId']);

        //     return new \League\Flysystem\Filesystem($adapter);
        // });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}