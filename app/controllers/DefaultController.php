<?php
    class DefaultController extends Controller{
        public function __construct(){
           
        }

        public function index(){
            $data = [
                'title' => SITENAME,
                'description' => 'В системата ' . SITENAME . ' студентите могат
                                    да разглеждат учебните планове на специалностите от различни випуски и изучаваните дисциплини.'
            ];

            $this->view('default/index', $data);
        }
    }
?>