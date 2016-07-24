<?php

class Controller {
    public function model($model) {
        require_once "../project_test2/models/$model.php";
        return new $model ();
    }
    
    public function view($view, $data = Array()) {
        require_once "../project_test2/views/$view";
    }
}

?>
