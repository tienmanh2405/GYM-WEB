<?php

class ErrorController {
    public function notFound() {
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
    }
}
?>