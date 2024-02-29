<?php

/*

|----------------------------------------------------------------------------
| Google OAuth 2.0 access
|----------------------------------------------------------------------------
|
| Keys for OAuth 2.0 access, see the API console at
| https://developers.google.com/console
|
*/
return [
'client_id' => env('GOOGLE_CLIENT_ID', ''),
'client_secret' => env('GOOGLE_CLIENT_SECRET', ''),
'redirect_uri' => env('GOOGLE_REDIRECT', ''),
'scopes' => [\Google\Service\Sheets::DRIVE, \Google\Service\Sheets::SPREADSHEETS],
'access_type' => 'online',
'approval_prompt' => 'auto',
    /*
|----------------------------------------------------------------------------
| Google service account
|----------------------------------------------------------------------------
|
| Set the credentials JSON's location to use assert credentials, otherwise
| app engine or compute engine will be used.
|
*/
    'service' => [
        /*
    | Enable service account auth or not.
    */
        'enable' => env('GOOGLE_SERVICE_ENABLED', false),

        /*
     * Path to service account json file. You can also pass the credentials as an array
     * instead of a file path.
     */
        'file' => storage_path('credentials.json'),
    ],  
];
