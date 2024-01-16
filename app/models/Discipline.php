<?php require APPROOT . '/views/inc/header.php'; ?>

<?php
    class Discipline{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function getDisciplines(){
            $this->db->query("SELECT * FROM disciplines");

            $results = $this->db->resultSet();

            return $results;
        }

        public function getDisciplineById($id){
            $this->db->query("SELECT * FROM disciplines WHERE id = :id");
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }

        public function addDiscipline($data){
                $this->db->query("INSERT INTO disciplines (
                disciplineNameBg
                ,disciplineNameEng
                ,specialtiesAndCourses
                ,category
                ,oks
                ,professor
                ,semester
                ,elective
                ,credits
                ,annotation
                ,prerequisites
                ,expectations
                ,content
                ,synopsis
                ,bibliography
                ,code
                ,administrativeInfo
                )
                VALUES (
                :disciplineNameBg,
                :disciplineNameEng,
                :specialtiesAndCourses,
                :category,
                :oks,
                :professor,
                :semester,
                :elective,
                :credits,
                :annotation,
                :prerequisites,
                :expectations,
                :content,
                :synopsis,
                :bibliography,
                :code,
                :administrativeInfo)");

                $this->db->bind(':disciplineNameBg', $data['disciplineNameBg']);
                $this->db->bind(':disciplineNameEng', $data['disciplineNameEng']);
                $this->db->bind(':specialtiesAndCourses', $data['specialtiesAndCourses']);
                $this->db->bind(':category', $data['category']);
                $this->db->bind(':oks', $data['oks']);
                $this->db->bind(':professor', $data['professor']);
                $this->db->bind(':semester', $data['semester']);
                $this->db->bind(':elective', $data['elective']);
                $this->db->bind(':credits', $data['credits']);
                $this->db->bind(':annotation', $data['annotation']);
                $this->db->bind(':prerequisites', $data['prerequisites']);
                $this->db->bind(':expectations', $data['expectations']);
                $this->db->bind(':content', $data['content']);
                $this->db->bind(':synopsis', $data['synopsis']);
                $this->db->bind(':bibliography', $data['bibliography']);
                $this->db->bind(':code', $data['code']);
                $this->db->bind(':administrativeInfo', $data['administrativeInfo']);

            
                // Execute
                if($this->db->execute()){
                    return true;
                } else {
                    echo "fail";
                    return false;
                }
        }

        public function updateDiscipline($data){
            $this->db->query("UPDATE disciplines SET 
            disciplineNameBg = :disciplineNameBg,
            disciplineNameEng = :disciplineNameEng,
            specialtiesAndCourses = :specialtiesAndCourses,
            category = :category,
            oks = :oks,
            professor = :professor,
            semester = :semester,
            elective = :elective,
            credits = :credits,
            annotation = :annotation,
            prerequisites = :prerequisites,
            expectations = :expectations,
            content = :content,
            synopsis = :synopsis,
            bibliography = :bibliography,
            code = :code,
            administrativeInfo = :administrativeInfo
            WHERE id = :id");

            $this->db->bind(':disciplineNameBg', $data['disciplineNameBg']);
            $this->db->bind(':disciplineNameEng', $data['disciplineNameEng']);
            $this->db->bind(':specialtiesAndCourses', $data['specialtiesAndCourses']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':oks', $data['oks']);
            $this->db->bind(':professor', $data['professor']);
            $this->db->bind(':semester', $data['semester']);
            $this->db->bind(':elective', $data['elective']);
            $this->db->bind(':credits', $data['credits']);
            $this->db->bind(':annotation', $data['annotation']);
            $this->db->bind(':prerequisites', $data['prerequisites']);
            $this->db->bind(':expectations', $data['expectations']);
            $this->db->bind(':content', $data['content']);
            $this->db->bind(':synopsis', $data['synopsis']);
            $this->db->bind(':bibliography', $data['bibliography']);
            $this->db->bind(':code', $data['code']);
            $this->db->bind(':administrativeInfo', $data['administrativeInfo']);
            $this->db->bind(':id', $data['id']);


            // Execute
            if($this->db->execute()){
                return true;
            } else {
                echo "fail";
                return false;
            }
    }

        public function addDisciplineForCurriculum($data){
            $this->db->query("INSERT IGNORE INTO `curriculum_disciplines` (disciplineId, curriculumId)
            VALUES (:disciplineId, :curriculumId)");

            $this->db->bind(':disciplineId', $data['disciplineId']);
            $this->db->bind(':curriculumId', $data['curriculumId']);
            
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function addDisciplineDependsOn($data){
            $this->db->query("INSERT IGNORE INTO `depends_on` (disciplineId, code)
            VALUES (:disciplineId, :code)");

            $this->db->bind(':disciplineId', $data['disciplineId']);
            $this->db->bind(':code', $data['code']);
            
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function addDisciplinesDependBy($data){
            $this->db->query("INSERT IGNORE INTO `depend_by` (disciplineId, code)
            VALUES (:disciplineId, :code)");

            $this->db->bind(':disciplineId', $data['disciplineId']);
            $this->db->bind(':code', $data['code']);
            
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getDisciplineInfoByCode($code){

            // Check if discipline with such code exists. It is possible that we upload a dependancy between
            // a discipline that has not yet been uploaded. A constraint between depends_on and depend_by and disciplines
            // is not added for simplicity's sake and due to the implementation.

            $this->db->query("SELECT COUNT(*)  FROM disciplines WHERE code='$code'");
            $count = $this->db->single();

            if($count != 0){
                $this->db->query("SELECT * FROM disciplines WHERE code=:code ");
                $this->db->bind(':code', $code);
                $row = $this->db->single();
                return $row;
            }
            return NULL;
        }

        public function getDisciplineDependsOn($id){
            $this->db->query("SELECT code FROM depends_on WHERE disciplineId=$id");
            $results = $this->db->resultSet();
            return $results;
        }

        public function getDisciplineDependBy($id){
            $this->db->query("SELECT code FROM depend_by WHERE disciplineId=$id");
            $results = $this->db->resultSet();
            return $results;
        }

        public function search($field, $searchInput){
            $this->db->query("SELECT * FROM disciplines WHERE $field LIKE '%$searchInput%'");
            
            /*Binding parameters in a query like this is buggy, so we avoid it here in the name of working search functionality */
            /*To assure some security we sanitize $_POST input in the controller search method */

            $results = $this->db->resultSet();

            return $results;
        }

        public function getLastInserted(){
            $id = $this->db->getLastInsertedId();
            return $id;
        }

        /* Before we delete a discipline from the DB we need to delete its occurences in relationships tables */
        public function deleteDisciplineCurriculumRelationship($id){
            $this->db->query('DELETE FROM `curriculum_disciplines` WHERE disciplineId = :id');
            
            $this->db->bind(':id', $id);

            if($this->db->execute()){
               return true;
            } else {
                return false;
            }
        }

        public function deleteDisciplineDependsOn($id){
            $this->db->query('DELETE FROM `depends_on` WHERE disciplineId = :id');
            
            $this->db->bind(':id', $id);

            if($this->db->execute()){
               return true;
            } else {
                return false;
            }
        }

        public function deleteDisciplineDependBy($id){
            $this->db->query('DELETE FROM `depend_by` WHERE disciplineId = :id');
            
            $this->db->bind(':id', $id);

            if($this->db->execute()){
               return true;
            } else {
                return false;
            }
        }

        public function deleteDiscipline($id){
            $this->deleteDisciplineCurriculumRelationship($id);
            $this->deleteDisciplineDependsOn($id);
            $this->deleteDisciplineDependBy($id);

            $this->db->query('DELETE FROM `disciplines` WHERE id = :id');
            
            $this->db->bind(':id', $id);

            if($this->db->execute()){
                $file ="../public/JSONS/file" . $id . ".json";
                if(file_exists($file)) { 
                    if(unlink($file)){
                        return true;
                    }
                }
            } else {
                return false;
            }
            return true;
        }
    }
?>