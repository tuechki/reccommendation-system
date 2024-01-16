<?php
    class Curriculum{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function getCurriculums(){
            $this->db->query("SELECT * FROM curriculums ORDER BY specialty ASC, academicYear DESC");

            $results = $this->db->resultSet();

            return $results;
        }

        public function addCurriculum($data){
                $this->db->query("INSERT IGNORE INTO `curriculums` (oks, specialty, academicYear)
                VALUES (:oks, :specialty, :academicYear)");

                $this->db->bind(':oks', $data['oks']);
                $this->db->bind(':specialty', $data['specialty']);
                $this->db->bind(':academicYear', $data['academicYear']);
                
    
                // Execute
                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }
        }

        public function getCurriculumByNameAndYearAndOKS($data){
            $this->db->query("SELECT id FROM `curriculums` WHERE specialty = :specialty AND academicYear= :academicYear AND oks= :oks");

            $this->db->bind(':oks', $data['oks']);
            $this->db->bind(':specialty', $data['specialty']);
            $this->db->bind(':academicYear', $data['academicYear']);
            
            $result = $this->db->single();
            return $result;
    }

    public function getDisciplinesForCurriculum($id){
            $this->db->query("SELECT  DISTINCT * from `disciplines`
            JOIN `curriculum_disciplines` ON `disciplineId` = `disciplines`.`id`
            WHERE `curriculum_disciplines`.`curriculumId` = :id");

            $this->db->bind(':id', $id);
            
            $results = $this->db->resultSet();

            return $results;
    }

    public function getCurriculumById($id){
        $this->db->query("SELECT * from `curriculums`
        WHERE id = :id");

        $this->db->bind(':id', $id);
        
        $result = $this->db->single();
        return $result;
}

        public function getLastInserted(){
            $id = $this->db->getLastInsertedId();
            return $id;
          }
    }
?>