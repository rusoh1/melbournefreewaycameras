<?php
// Check if the required POST parameters are set
if (isset($_POST['to']) && isset($_POST['message']) && isset($_POST['senderID'])) {
    // Your API key
    $apiKey = "YOUR_API_KEY";

    // Fetch parameters from POST request
    $smsTo = urlencode($_POST['to']);
    $mess = urlencode($_POST['message']);
    $smsFrom = urlencode($_POST['senderID']);
    $origin = "a";  // 'a' for Australian Carrier
    $tracking = 1;
    $returnMID = 1;

    // Construct the SMS API URL
    $url = "https://smsmanager.com.au/httpsend.php?key=$apiKey&to=$smsTo&mess=$mess&from=$smsFrom&origin=$origin&tracking=$tracking&returnMID=$returnMID";

    // Make the request to the SMS API
    $response = file_get_contents($url);

    // Check if the response indicates success
    if (strpos($response, "success") !== false) {
        echo json_encode(["status" => "success", "message" => "SMS sent successfully!", "response" => $response]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send SMS.", "response" => $response]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid parameters."]);
}
?>
