<?php

namespace App\Console\Commands;

use Google\Client;
use Google\Service\Drive;
use Illuminate\Console\Command;

class GoogleDriveAuthorize extends Command
{
    protected $signature = 'google-drive:authorize';
    protected $description = 'Authorize Google Drive access and get refresh token';

    public function handle()
    {
        $client = new Client();
        $client->setClientId(config('google_drive.client_id'));
        $client->setClientSecret(config('google_drive.client_secret'));
        $client->setRedirectUri('urn:ietf:wg:oauth:2.0:oob');
        $client->setScopes([Drive::DRIVE_FILE]);
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        // Generate auth URL
        $authUrl = $client->createAuthUrl();
        $this->info('Go to the following link in your browser:');
        $this->line($authUrl);
        
        // Get authorization code
        $authCode = $this->ask('Enter the authorization code');
        
        // Exchange authorization code for access token
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
        
        if (isset($accessToken['refresh_token'])) {
            $this->info('✅ Refresh Token obtenu avec succès !');
            $this->newLine();
            $this->warn('Ajoutez cette ligne à votre fichier .env :');
            $this->line('GOOGLE_DRIVE_REFRESH_TOKEN=' . $accessToken['refresh_token']);
            $this->newLine();
            $this->info('Puis exécutez: php artisan optimize:clear');
        } else {
            $this->error('❌ Aucun refresh token reçu. Assurez-vous que access_type=offline est défini.');
            if (isset($accessToken['error'])) {
                $this->error('Erreur: ' . $accessToken['error_description'] ?? $accessToken['error']);
            }
        }
    }
}