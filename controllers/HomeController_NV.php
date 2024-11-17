<?php

class HomeController_NV {
    public function dashboard() {
        // Render view
        $this->render('NV_Quay/home/dashboard');
    }

    protected function render($view, $data = []) {
        // extract($data); // Truyền biến vào view
        require_once BASE_PATH . "/views/$view.php";
    }
}
?>