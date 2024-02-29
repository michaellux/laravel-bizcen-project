<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Google\Client as GoogleClient;
use Google\Service\Sheets as GoogleSheets;
use Google\Service\Drive as GoogleDrive;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/list', function () {
    return Inertia::render('List');
});

Route::post('/send-query', function (Request $request) {
    $client = new GoogleClient();
    $client->setApplicationName('BizcenTestProject');
    $client->setScopes([GoogleSheets::SPREADSHEETS, GoogleDrive::DRIVE]);

    $credentialsPath = storage_path('credentials.json');

    $client->setAuthConfig($credentialsPath);
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    try {
        // Attempt to create a new Google Sheet to test authentication
        $service = new GoogleSheets($client);
        $spreadsheet = new Google_Service_Sheets_Spreadsheet([
            'properties' => [
                'title' => 'New Spreadsheet'
            ]
        ]);
        $spreadsheet = $service->spreadsheets->create($spreadsheet, [
            'fields' => 'spreadsheetId'
        ]);

        $spreadsheetId = $spreadsheet->spreadsheetId;

        $driveService = new GoogleDrive($client);
        $drivePermission = new Google_Service_Drive_Permission([
            'type' => 'anyone',
            'role' => 'reader'
        ]);
        $driveService->permissions->create($spreadsheetId, $drivePermission);

        // Construct the URL to the newly created Google Sheet
        $sheetUrl = "https://docs.google.com/spreadsheets/d/{$spreadsheetId}/edit";

        // Redirect to the Google Sheet
        return redirect($sheetUrl);
    } catch (\Google_Service_Exception $e) {
        return response()->json(['error' => 'Authentication failed: ' . $e->getMessage()], 401);
    }

    // return Inertia::render('List');
});
