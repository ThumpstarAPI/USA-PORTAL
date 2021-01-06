<?php
/**
 * A PHP class file that performs viewing, updating and inserting data using 
 * Google Sheet API
 * 
 * @author Michael "Mike" Jericho Dariano.
 */

/**
 * ===========NOTE===========
 * 
 * MAKE SURE THAT CLIENT EMAIL HAS ACCESS TO THE GOOGLE SHEETS THAT WILL BE USED!
 * 
 * CLIENT EMAIL IS FOUND IN CREDENTIALS FOR EACH FEATURE OF THE DEALER PORTAL PAGE
 * 
 *===========================
 */

 class ThumpstarApiCalls{
 

    /**
     * This function is for VIEWING all data from a specific google sheet
     *
     * @param string $sheetID variable is for the ID from the google sheet URL
     * @param string $sheetRange variable is for the sheet name and A1 notation example Sheet1!A1:B2
     * @param string $credentials specific credentials to be used example portal-credentials
     * @return void
     */
     public  function viewSheetData($sheetID, $sheetRange,$credentials){
        require __DIR__ . '/vendor/autoload.php';
        $client = new Google_Client();
        $client-> setApplicationName("Thumpstar Google API");
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig(__DIR__ . "/credentials/$credentials");
        $service = new Google_Service_Sheets($client);
        $spreadSheetID = $sheetID;
        $range = $sheetRange;
        $response = $service->spreadsheets_values->get($spreadSheetID, $range);
        $values = $response->getValues();

        return $values;
      }

      /**
       * This function is for UPDATING specific column in the google sheet
       *
       * 
       * @param string $sheetID variable is for the ID from the google sheet URL
       * @param string $sheetRange variable is for the sheet name and A1 notation example Sheet1!A1:B2
       * @param array $data every index of the array corresponds to the column where the data will be updated 
       * @return void
       */
      public function updateSheetData($sheetID, $sheetRange,$data,$credentials){
        require __DIR__ . '/vendor/autoload.php';
        $client = new Google_Client();
        $client-> setApplicationName("Thumpstar Google API");
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig(__DIR__ . "/credentials/$credentials");
        $service = new Google_Service_Sheets($client);
        $spreadSheetID = $sheetID;
        $range = $sheetRange;
        $values = $data;
    
        $body = new Google_Service_Sheets_ValueRange([
            "values" => $values
        ]);
    
        $params = [
            'valueInputOption' => "RAW"
        ];
    
        $result =$service->spreadsheets_values->update($spreadSheetID,$range,$body,$params);

        if($result){
          return true;
        }else{
          return false;
        }
      }

      /**
       * This function is for INSERTING data to the sheet.
       * 
       * @param string $sheetID variable is for the ID from the google sheet URL
       * @param string $sheetRange variable is for the sheet name  Sheet1\
       * @param array $data every index of the array corresponds to the column where the data will be inserted 
       * @return void
       */
      public function insertSheetData($sheetID,$sheetRange,$data,$credentials){
        require __DIR__ . '/vendor/autoload.php';
        $client = new Google_Client();
        $client-> setApplicationName("Thumpstar Google API");
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig(__DIR__ . "/credentials/$credentials");
        $service = new Google_Service_Sheets($client);
        $spreadSheetID = $sheetID;
        $range = $sheetRange;
        $values = $data;
        $body = new Google_Service_Sheets_ValueRange([
          "values" => $values
          ]);
          
        $params = [
          'valueInputOption' => "RAW"
        ];
        
        $insert = [
          'insertDataOption' => "INSERT_ROW"
        ];

        $result =$service->spreadsheets_values->append($spreadSheetID,$range,$body,$params,$insert);
        
        if($result){
          return true;
        }else{
          return false;
        }

      }

      public function clearData($sheetID,$sheetRange){
        require __DIR__ . '/vendor/autoload.php';

        $client = new Google_Client();
        $client-> setApplicationName("Thumpstar Google API");
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig(__DIR__ . '/credentials.json');
        $service = new Google_Service_Sheets($client);
        $spreadSheetID = $sheetID;
        $range = $sheetRange;
        $requestBody = new Google_Service_Sheets_ClearValuesRequest();
        $response = $service->spreadsheets_values->clear($spreadSheetID, $range, $requestBody);

      }

 }

 ?>