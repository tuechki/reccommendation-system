<?php
    class Curriculums extends Controller{
        
        public function __construct(){
            
            $this->curriculumModel = $this->model('Curriculum');
        }

        
        public function index(){
            $curriculums = $this->curriculumModel->getCurriculums();

            $data = [
                'curriculums' => $curriculums
            ];

            $this->view('curriculums/index', $data);
        }

        public function details($id){
            $disciplines = $this->curriculumModel->getDisciplinesForCurriculum($id);
            $curriculum = $this->curriculumModel->getCurriculumById($id);

            $data = [
                'curriculum' => $curriculum,
                'disciplines' => $disciplines
            ];

            $this->view('curriculums/details', $data);
        }

    }
?>