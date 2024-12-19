<?php
class Home extends Controller {
    public function index() {
        $data = [
            'title' => 'themuaz97',
            'name' => 'Muaz Rahman'
        ];
        $this->view('home', $data);  // Render the view (home.php)
    }
}
