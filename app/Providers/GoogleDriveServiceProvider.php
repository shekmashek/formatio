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
            // $client->setApplicationName($this->projectName);
            // $client->setScopes(SCOPES);
            // $client->setAuthConfig($this->jsonKeyFilePath);
            // $client->setRedirectUri($this->redirectUri);
            $client->setAccessType('offline');
            $client->setApprovalPrompt('force');

        //    // Load previously authorized credentials from a file.
        //    if (file_exists($this->)) {
        //      $accessToken = json_decode(file_get_contents($this->tokenFile),
        //      true);
        //   } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));

            if (isset($_GET['code'])) {
                $authCode = $_GET['code'];
                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                header('Location: ' . filter_var($this->redirectUri,
                FILTER_SANITIZE_URL));
                if(!file_exists(dirname($this->tokenFile))) {
                    mkdir(dirname($this->tokenFile), 0700, true);
                }

                file_put_contents($this->tokenFile, json_encode($accessToken));
            }else{
                exit('No code found');
            }
        // }
        $client->setAccessToken($accessToken);

        // Refresh the token if it's expired.
        if ($client->isAccessTokenExpired()) {

            // save refresh token to some variable
            $refreshTokenSaved = $client->getRefreshToken();

            // update access token
            $client->fetchAccessTokenWithRefreshToken($refreshTokenSaved);

            // pass access token to some variable
            $accessTokenUpdated = $client->getAccessToken();

            // append refresh token
            $accessTokenUpdated['refresh_token'] = $refreshTokenSaved;

            //Set the new acces token
            $accessToken = $refreshTokenSaved;
            $client->setAccessToken($accessToken);

            // save to file
            file_put_contents($this->tokenFile,
           json_encode($accessTokenUpdated));
        }
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