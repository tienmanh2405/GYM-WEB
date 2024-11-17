<?php

class HomeController_Admin {
    public function dashboard() {
        // Render view
        $this->render('Admin/home/dashboard');
    }

    protected function render($view, $data = []) {
        // extract($data); // Truyền biến vào view
        require_once BASE_PATH . "/views/$view.php";
    }
}
?>