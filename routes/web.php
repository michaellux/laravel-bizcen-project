<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Google\Client as GoogleClient;
use Google\Service\Sheets as GoogleSheets;
use Google\Service\Drive as GoogleDrive;
use Illuminate\Http\Request;
use App\Models\SpreadsheetLink;
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
    $links = SpreadsheetLink::all();
    return Inertia::render('List', ['links' => $links]);
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
                'title' => 'Заявка'
            ]
        ]);
        $spreadsheet = $service->spreadsheets->create($spreadsheet, [
            'fields' => 'spreadsheetId'
        ]);

        $spreadsheetId = $spreadsheet->spreadsheetId;

        $requests = [
            new Google_Service_Sheets_Request([
                'updateSpreadsheetProperties' => [
                    'properties' => [
                        'title' => 'Заявка ' . $spreadsheetId
                    ],
                    'fields' => 'title'
                ]
            ])
        ];
        $batchUpdateRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
            'requests' => $requests
        ]);
        $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);

        $driveService = new GoogleDrive($client);
        $drivePermission = new Google_Service_Drive_Permission([
            'type' => 'anyone',
            'role' => 'reader'
        ]);
        $driveService->permissions->create($spreadsheetId, $drivePermission);

        $range = 'Sheet1!A1:D1'; // Adjust the range as needed for the header row
        $headerValues = [array_keys($request->all())]; // Get the column names from the request data

        // Append the header (column names) to the Google Sheet
        $headerBody = new Google_Service_Sheets_ValueRange([
            'values' => $headerValues
        ]);
        $headerParams = [
            'valueInputOption' => 'RAW'
        ];
        $service->spreadsheets_values->append($spreadsheetId, $range, $headerBody, $headerParams);


        // Assuming you want to append all request data to the first sheet
        $range = 'Sheet1!A2'; // Adjust the range as needed
        $values = $request->all(); // Get request data
        $values = [array_values($values)]; // Convert the request data to a 2D array

        // Append the data to the Google Sheet
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'RAW'
        ];
        $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);

        // Construct the URL to the newly created Google Sheet
        $sheetUrl = "https://docs.google.com/spreadsheets/d/{$spreadsheetId}/edit";

        SpreadsheetLink::create([
            'spreadsheet_id' => $spreadsheetId,
            'link' => $sheetUrl,
        ]);
        return redirect('/list');
    } catch (\Google_Service_Exception $e) {
        return response()->json(['error' => 'Authentication failed: ' . $e->getMessage()], 401);
    }
});
