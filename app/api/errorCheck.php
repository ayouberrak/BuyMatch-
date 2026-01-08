
<?php
set_error_handler(function($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

set_exception_handler(function($exception) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $exception->getMessage(),
        'file' => $exception->getFile(),
        'line' => $exception->getLine(),
        'trace' => $exception->getTraceAsString()
    ]);
    exit;
});

register_shutdown_function(function() {
    $error = error_get_last();
    if ($error) {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => $error['message'],
            'file' => $error['file'],
            'line' => $error['line']
        ]);
        exit;
    }
});