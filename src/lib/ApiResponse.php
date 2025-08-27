<?php

class ApiResponse {
    /**
     * Sends a JSON response.
     *
     * @param mixed $data The data to be encoded as JSON.
     * @param int $statusCode The HTTP status code to send.
     */
    public static function json($data, $statusCode = 200) {
        // Set the content type header to application/json
        header('Content-Type: application/json');

        // Set the HTTP response code
        http_response_code($statusCode);

        // Echo the JSON encoded data
        echo json_encode($data);

        // Terminate the script
        exit();
    }
}
