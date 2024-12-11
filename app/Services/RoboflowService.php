<?php


// namespace App\Services;

// use Illuminate\Support\Facades\Log;
// use Exception;

// class RoboflowService
// {
//     protected $apiKey;
//     protected $modelEndpoint;

//     public function __construct()
//     {
//         $this->apiKey = env('ROBOFLOW_API_KEY');
//         $this->modelEndpoint = env('ROBOFLOW_API_URL');
        
//         if (empty($this->apiKey) || empty($this->modelEndpoint)) {
//             Log::error('Roboflow configuration missing. Please check your .env file.');
//         }
//     }

//     public function detectHalalStatus($imagePath)
//     {
//         try {
//             if (!file_exists($imagePath)) {
//                 Log::error("Image file not found at path: {$imagePath}");
//                 return 'undetermined';
//             }

//             // Send the image to Roboflow API using sendToRoboflow
//             $result = $this->sendToRoboflow($imagePath);

//             if (isset($result['error'])) {
//                 Log::error('Roboflow API Error: ' . $result['error']);
//                 return 'undetermined';
//             }

//             Log::info('Roboflow Predictions:', $result['predictions'] ?? []);
            
//             // Check if any prediction label matches 'halal'
//             if (isset($result['predictions']) && is_array($result['predictions'])) {
//                 foreach ($result['predictions'] as $prediction) {
//                     if (isset($prediction['label']) &&
//                         strtolower($prediction['label']) === 'halal' &&
//                         isset($prediction['confidence']) &&
//                         $prediction['confidence'] > 0.5) {
//                         return 'halal';
//                     }
//                 }
//                 return 'non-halal';
//             }
//         } catch (Exception $e) {
//             Log::error('Exception in detectHalalStatus:', [
//                 'message' => $e->getMessage(),
//                 'trace' => $e->getTraceAsString()
//             ]);
//         }

//         return 'undetermined';
//     }

//     private function sendToRoboflow($imagePath)
//     {
//         try {
//             // Convert the image to base64
//             $imageBase64 = base64_encode(file_get_contents($imagePath));

//             // Prepare the GuzzleHttp client
//             $client = new \GuzzleHttp\Client();

//             // Make the POST request to Roboflow API
//             $response = $client->post($this->modelEndpoint, [
//                 'headers' => [
//                     'Content-Type' => 'application/x-www-form-urlencoded',
//                 ],
//                 'query' => [
//                     'api_key' => $this->apiKey,
//                 ],
//                 'body' => $imageBase64,
//             ]);

//             // Parse the response and return the JSON result
//             return json_decode($response->getBody()->getContents(), true);
//         } catch (Exception $e) {
//             Log::error('Error in sendToRoboflow:', ['message' => $e->getMessage()]);
//             return ['error' => $e->getMessage()];
//         }
//     }
// }
