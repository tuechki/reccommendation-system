<?php
    class Disciplines extends Controller{
        public function __construct(){
            /*Remove this is we want guest users to access the disciplines content */
            /*if(!isLoggedIn()){
                redirect('users/login');
            }*/
            
            $this->disciplineModel = $this->model('Discipline');
            $this->curriculumModel = $this->model('Curriculum');
        }

        
        public function index(){

            /* Searching functionality for discipline is included in index view and method. */
            /* If a search query was sent, show only query results in index. */

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
              $field=($_POST['field']);
              $searchInput=($_POST['searchInput']);
  
              $disciplines = $this->disciplineModel->search($field, $searchInput);

              $displaySearchedField;
              switch($field) {
                case "disciplineNameBg":
                  $displaySearchedField = "Име";
                break;
                case "disciplineNameEng":
                  $displaySearchedField = "English Name";
                break;
                case "credits":
                  $displaySearchedField = "Кредити";
                break;
                case "category":
                  $displaySearchedField = "Категория";
                break;
                case "semester":
                  $displaySearchedField = "Семестър";
                break;
                case "professor":
                  $displaySearchedField = "Преподавател";
                break;
                case "elective":
                  $displaySearchedField = "Статут";
                break;
              }

              if(sizeof($disciplines) == 0){
                $data = [
                  'searchedField' => $displaySearchedField,
                  'searchedValue' => $searchInput,
                  'no_results_message' => 'Няма намерени резултати за това търсене.',
                  'disciplines' => '',
                ];
              } else{
                $data = [
                  'searchedField' => $displaySearchedField,
                  'searchedValue' => $searchInput,
                  'no_results_message' => '',
                  'disciplines' => $disciplines,
                ];
              }
             
            } else {
              /* Normal disciplines index behaviour - display all disciplines */
              $disciplines = $this->disciplineModel->getDisciplines();

              $data = [
                  'disciplines' => $disciplines,
              ];
            }
              $this->view('disciplines/index', $data);
        }


          public function import(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $json = json_decode($_POST['mainInfo'], true);

                $disciplineNameBg = $json['Дисциплина'];
                $disciplineNameEng = $json['Discipline'];
                $specialtiesAndCourses = json_encode($json['Специалности'], JSON_UNESCAPED_UNICODE);
                $category = $json['Категория'];
                $oks = json_encode($json['ОКС'], JSON_UNESCAPED_UNICODE);
                $professor = $json['Преподавател'];
                $semester = $json['Семестър'];
                $elective = $json['Статут'];
                $credits = $json['Кредити'];
                $annotation =  $json['Анотация'];
                $prerequisites = $json['Предварителни изисквания'];
                $expectations = $json['Очаквани резултати'];
                $content = json_encode($json['Съдържание'], JSON_UNESCAPED_UNICODE);
                $synopsis = json_encode($json['Конспект'], JSON_UNESCAPED_UNICODE);
                $bibliography = json_encode($json['Библиография'], JSON_UNESCAPED_UNICODE);
                $code = $json['Код'];
                $administrativeInfo = json_encode($json['Административна информация'], JSON_UNESCAPED_UNICODE);
  
                $data = [
                    'disciplineNameBg' => $disciplineNameBg,
                    'disciplineNameEng' => $disciplineNameEng,
                    'specialtiesAndCourses' => $specialtiesAndCourses,
                    'category' => $category,
                    'oks' => $oks,
                    'professor' => $professor,
                    'semester' => $semester,
                    'elective' => $elective,
                    'credits' => $credits,
                    'annotation' => $annotation,
                    'prerequisites' => $prerequisites,
                    'expectations' => $expectations,
                    'content' => $content,
                    'synopsis' => $synopsis,
                    'bibliography' => $bibliography,
                    'code' => $code,
                    'administrativeInfo' => $administrativeInfo,
                    'mainInfo_err' => ''
                ];

                $storedCurriculumIds = [];

                $specialties = [];
                foreach($json['Специалности'] as $specialtyCourse){
                  foreach($specialtyCourse as $specialty => $course){
                    $specialties[] = $specialty;
                  }
                }
                $oksArr = [];
                foreach($json['ОКС'] as $oks){
                  $oksArr[] = $oks;
                }
                $years = [];
                foreach($json['Академични години'] as $year){
                  $years[] = $year;
                }
                foreach($specialties as $specialty){
                  foreach($years as $year){
                    foreach($oksArr as $oks){
                      $curriculumdata = [
                        'oks' => $oks,
                        'specialty' => $specialty,
                        'academicYear' => $year,
                      
                    ];
                      $this->curriculumModel->addCurriculum($curriculumdata);
                      $returnedCurriculumIdsObjects[] =  $this->curriculumModel->getCurriculumByNameAndYearAndOKS($curriculumdata);
                    }
                  }
                }
                $storedCurriculumIds = [];
                foreach($returnedCurriculumIdsObjects as $cid => $value){
                  $storedCurriculumIds[] = $value->id;
                }

                  // Validate data
                  if(empty($data['mainInfo'])){
                    $data['mainInfo_err'] = 'Please enter main info';
                  }
     
                    if($this->disciplineModel->addDiscipline($data)){
                      
                      $id = $this->disciplineModel->getLastInserted();

                      foreach($storedCurriculumIds as $cid){
                        $dcdata = [
                          'disciplineId' => $id,
                          'curriculumId' => $cid,
                        ];
                        $this->disciplineModel->addDisciplineForCurriculum($dcdata);
                      }

                  
                      foreach($json['Зависи от'] as $code){
                        $data = [
                          'disciplineId' => $id,
                          'code' => $code,
                        ];
                        $this->disciplineModel->addDisciplineDependsOn($data);
                      }

                      foreach($json['Зависят от нея'] as $code){
                        $data = [
                          'disciplineId' => $id,
                          'code' => $code,
                        ];
                        $this->disciplineModel->addDisciplinesDependBy($data);
                      }
                      
                      $fp = fopen('../public/JSONS/file' . $id . '.json', 'w');
                      fwrite($fp, json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                      fclose($fp);

                      flash('discipline_success', "Успешно добавихте дисциплина!");
                      redirect('disciplines/index');
                     } else {
                      die('Something went wrong');
                     }

            } else {
                $data = [
                    'mainInfo' => '',
                  ];
            
                  $this->view('disciplines/import', $data);
            }
          }

          public function edit($id){
            if($_SESSION['user_role'] != 'admin'){
              redirect('disciplines');
            }
  
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
                $json = json_decode($_POST['mainInfo'], true);
  
  
                $disciplineNameBg = $json['Дисциплина'];
                $disciplineNameEng = $json['Discipline'];
                $category = $json['Категория'];
                $specialtiesAndCourses = json_encode($json['Специалности'], JSON_UNESCAPED_UNICODE);
                $oks = json_encode($json['ОКС'], JSON_UNESCAPED_UNICODE);
                $professor = $json['Преподавател'];
                $semester = $json['Семестър'];
                $elective = $json['Статут'];
                $credits = $json['Кредити'];
                $annotation =  $json['Анотация'];
                $prerequisites = $json['Предварителни изисквания'];
                $expectations = $json['Очаквани резултати'];
                $content = json_encode($json['Съдържание'], JSON_UNESCAPED_UNICODE);
                $synopsis = json_encode($json['Конспект'], JSON_UNESCAPED_UNICODE);
                $bibliography = json_encode($json['Библиография'], JSON_UNESCAPED_UNICODE);
                $code = $json['Код'];
                $adminInfo = json_encode($json['Административна информация'], JSON_UNESCAPED_UNICODE);
  
                
                $data = [
                    'disciplineNameBg' => $disciplineNameBg,
                    'disciplineNameEng' => $disciplineNameEng,
                    'category' => $category,
                    'specialtiesAndCourses' => $specialtiesAndCourses,
                    'oks' => $oks,
                    'professor' => $professor,
                    'semester' => $semester,
                    'elective' => $elective,
                    'credits' => $credits,
                    'annotation' => $annotation,
                    'prerequisites' => $prerequisites,
                    'expectations' => $expectations,
                    'content' => $content,
                    'synopsis' => $synopsis,
                    'bibliography' => $bibliography,
                    'code' => $code,
                    'adminInfo' => $adminInfo,
                    'id' => $id,
                    'mainInfo_err' => ''
                ];
  
                $storedCurriculumIds = [];
  
                $specialties = [];
                foreach($json['Специалности'] as $specialtyCourse){
                  foreach($specialtyCourse as $specialty => $course){
                    $specialties[] = $specialty;
                  }
                }

                $oksArr = [];
                foreach($json['ОКС'] as $oks){
                  $oksArr[] = $oks;
                }
                $years = [];
                foreach($json['Академични години'] as $year){
                  $years[] = $year;
                }
                foreach($specialties as $specialty){
                  foreach($years as $year){
                    foreach($oksArr as $oks){
                      $curriculumdata = [
                        'oks' => $oks,
                        'specialty' => $specialty,
                        'academicYear' => $year,
                      
                    ];
                      $this->curriculumModel->addCurriculum($curriculumdata);
                      $returnedCurriculumIdsObjects[] =  $this->curriculumModel->getCurriculumByNameAndYearAndOKS($curriculumdata);
                    }
                  }
                }
                $storedCurriculumIds = [];
                foreach($returnedCurriculumIdsObjects as $cid => $value){
                  $storedCurriculumIds[] = $value->id;
                }

                  if(empty($data['mainInfo'])){
                    $data['mainInfo_err'] = 'Please enter main info';
                  }

                if($this->disciplineModel->updateDiscipline($data)){
                  
                  foreach($storedCurriculumIds as $cid){
                    $dcdata = [
                      'disciplineId' => $id,
                      'curriculumId' => $cid,
                    ];
                    $this->disciplineModel->addDisciplineForCurriculum($dcdata);
                  }

                  foreach($json['Зависи от'] as $code){
                    $data = [
                      'disciplineId' => $id,
                      'code' => $code,
                    ];
                    $this->disciplineModel->addDisciplineDependsOn($data);
                  }

                  foreach($json['Зависят от нея'] as $code){
                    $data = [
                      'disciplineId' => $id,
                      'code' => $code,
                    ];
                    $this->disciplineModel->addDisciplinesDependBy($data);
                  }

                  $fp = fopen('../public/JSONS/file' . $id . '.json', 'w');
                  fwrite($fp, json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                  fclose($fp);
                  flash('discipline_updated', "Успешно редактирахте дисциплината!");
                  redirect('disciplines/index');
                 } else {
                  die('Something went wrong');
                 }
  
            } else {
                $fp = fopen('../public/JSONS/file' . $id . '.json', 'r'); 
                $data = [
                    'id' => $id,
                  ];
            
                  $this->view('disciplines/edit', $data);
            }
          }
          
          private function getFile($id){
            $json_data = file_get_contents(URLROOT . "/public/JSONS/file" . $id . ".json");
            $json = json_decode($json_data, true);
            return $json;
          }
          
          private function createShortDisplay($id){
            $discipline = $this->disciplineModel->getDisciplineById($id);
            $json = $this->getFile($id);
            
            $display = "
            <div class=\"title\">" .
            "<h1>" . $discipline->disciplineNameBg . "</h1>" . 
            "<h3>" . $discipline->disciplineNameEng . "</h3>" . 
            "</div>" . 
            "<div id=\"credits\">" .
            "<h3>" . $discipline->credits . " кредита</h3>" .
            "</div>" .
            "<div class=\"mainInfoContainer\">" .
            "<div id=\"specialties\">" .
            "<h4>Изучава се от специалности:</h4>" .
            "<ul>";

            foreach($json['Специалности'] as $specialtyCourse){
              foreach($specialtyCourse as $specialty => $courses){
                $display = $display . 
                  "<li>" . $specialty . " - Курс: ";
                foreach($courses as $course){
                  $display = $display . $course ."; ";
                }
                $display = $display . "</br></li>";
              }
            }
            
              $display = $display . "</ul>" .
              "</div>" . 
              "<div id=\"elective\">" .
              "<h4>Статут:</h4>" .
              "<h3>" . $discipline->elective . "</h3>" .
              "</div>" .
              "<div id=\"category\">" .
              "<h4>Категория: </h4>" .
                "<p>" . $discipline->category ."</p>" .
              "</div>" .
              "</div>" .
              "<div id=\"lecturer\">" .
              "<h4>Преподавател</h4>" .
                "<p>" . $discipline->professor ."</p>" .
              "</div>" .
              "<div id=\"grayContainer\">" .
              "<div id=\"annotation\">" .
              "<h4>Анотация</h4>" .
                  "<p>" . str_replace("\\\\n","</br>",$discipline->annotation) . "</p>" .
                  "</div>" .
                  "</div>"
                  ;
                  
                  return $display;
          }
          
          private function createDetailedDisplay($id){
            $discipline = $this->disciplineModel->getDisciplineById($id);
            $json = $this->getFile($id);
            
            $display = $this->createShortDisplay($id) .
            "<div id=\"prerequisites\">" .
            "<h4>Предварителни изисквания</h4>" .
            "<p>" . str_replace("\\\\n","</br>",$discipline->prerequisites) . "</p>" .
            "</div>" .
            "<div id=\"expectations\">" .
            "<h4>Очаквани резултати</h4>" .
            "<p>" . str_replace("\\\\n","</br>",$discipline->expectations) . "</p>" .
            "<p>" . /*echo str_replace('.', ". " . "</br>", $json["Очаквани резултати"]); */"</p>" .
            "</div>" . 
            "<div id=\"content\">" .
            "<div class=\"tableTitle\">" .
            "<h4>Съдържание</h4>" .
            "</div>" .
            "<table>" .
                "<tr>" .
                "<th>№</th>" .
                "<th>Тема</th>" .
                  "</tr>";
                  $count = 0;
                  //foreach($json["Съдържание"] as $topic){ 
                  foreach(json_decode($discipline->content) as $topic){ 
                          $display = $display . 
                          "<tr>" .
                          "<td>" . ++$count . "</td>" .
                          "<td>" . str_replace("\\n","</br>",$topic) . "</br></td>" .
                            "</tr>";
                          } 
                          $count = 0;
            $display = $display . "</table>" .
            "</div>" . 
            "<div id=\"synopsis\">" .
            "<div class=\"tableTitle\">" .
                "<h4>Конспект</h4>" .
                "</div>" .
                "<table>" .
                "<tr>" .
                "<th>№</th>" .
                "<th>Тема</th>" .
                "</tr>";
                $count = 0;
                foreach(json_decode($discipline->synopsis) as $topic){ 
                  $display = $display . 
                  "<tr>" .
                  "<td>" . ++$count . "</td>" .
                  "<td>" . str_replace("\\n","</br>",$topic) . "</br></td>" .
                  "</tr>";
                      } 
                      $count = 0;
                      $display = $display . "</table>" .
            "</div>" . 
            "<div id=\"bibliography\">" .
            "<div class=\"tableTitle\">" .
                "<h4>Библиография</h4>" .
                "</div>" .
              "<table>" .
                "<tr>" .
                "<th>№</th>" .
                  "<th>Източник</th>" .
                  "</tr>";
                  $count = 0;
                      foreach(json_decode($discipline->bibliography) as $topic){ 
                        $display = $display . 
                        "<tr>" .
                              "<td>" . ++$count . "</td>" .
                              "<td>" . str_replace("\\n","</br>",$topic) . "</br></td>" .
                              "</tr>";
                            } 
                            $count = 0;
            $display = $display . "</table>" .
            "</div>";
            
            return $display;
          }
          
          private function createAdminDisplay($id){
            $discipline = $this->disciplineModel->getDisciplineById($id);
            $json = $this->getFile($id);
            
            $display = $this->createDetailedDisplay($id) . 
            "<div id=\"administrative\">" .
            "<h2>Административна информация</h2>"
            . "<div class=\"adminInfoContent\">";
            $display = $display . "<strong>Код: </strong> " . $discipline->code . "</br>";
            foreach($json["Административна информация"] as $adminInfoTitle => $value){
              $display = $display . "<strong>" . $adminInfoTitle . ": </strong> " . $value . "</br>";
            }
            $display = $display . "</div></div>";
            
            return $display;
          }

          private function dependenciesDisplay($id){
            $dependsOn = (array)$this->disciplineModel->getDisciplineDependsOn($id);
            $dependBy = (array)$this->disciplineModel->getDisciplineDependBy($id);

            $dependsOnDisciplines = [];
            foreach($dependsOn as $disciplineCode){
              $disc = $this->disciplineModel->getDisciplineInfoByCode($disciplineCode->code);
              if($disc != NULL)
                $dependsOnDisciplines[] = $disc;
            }

            $dependByThisDiscipline = [];
            foreach($dependBy as $disciplineCode){
              $disc = $this->disciplineModel->getDisciplineInfoByCode($disciplineCode->code);
              
              if($disc != NULL){
                $dependByThisDiscipline[] = $disc;
              }
            }

            $display = $this->createShortDisplay($id);

            if(empty($dependsOnDisciplines) && empty($dependByThisDiscipline)){
              $display = $display . "<br>" . "<p style=\"padding-left: 2em;\"><em>Няма зададени зависимости за тази дисциплина.</em></p>";
              return $display;
            }

            if(!empty($dependsOnDisciplines)){
              $display = $display . "<div class=\"dependancyTable\">" .
              "<div class=\"tableTitle\">" .
                "<h4>Дисциплината зависи от:</h4>" .
                "</div>" .
              "<table>" .
                "<tr>" .
                "<th>№</th>" .
                  "<th>Дисциплина</th>" .
                  "</tr>";
                  $count = 0;
                  foreach($dependsOnDisciplines as $disc){
                        $display = $display . 
                        "<tr>" .
                              "<td>" . ++$count . "</td>" .
                              "<td> <a class=\"commonLink\" href=" . URLROOT . "/disciplines/visualise/" . $disc->id . "> <div class=\"curriculumRow\" >" . $disc->disciplineNameBg . "</div></a></td>" .
                              "</tr>";
                    } 
              $display = $display . "</table>" .
              "</div>";
            }

            if(!empty($dependByThisDiscipline)){
              $display = $display . "<div class=\"dependancyTable\">" .
              "<div class=\"tableTitle\">" .
                "<h4>От тази дисциплина зависят:</h4>" .
                "</div>" .
              "<table>" .
                "<tr>" .
                "<th>№</th>" .
                  "<th>Дисциплина</th>" .
                  "</tr>";
                  $count = 0;
                  foreach($dependByThisDiscipline as $disc){
                        $display = $display . 
                        "<tr>" .
                              "<td>" . ++$count . "</td>" .
                              "<td> <a class=\"commonLink\" href=" . URLROOT . "/disciplines/visualise/" . $disc->id . "> <div class=\"curriculumRow\" >" . $disc->disciplineNameBg . "</div></a></td>" .
                              "</tr>";
                    } 
              $display = $display . "</table>" .
              "</div>";
           }

            return $display;
          }
          
          public function short($id){
            ob_clean();
            flush();
            
            $display = $this->createShortDisplay($id);

            echo $display;
          }
          
          public function detailed($id){
            ob_clean();
            flush();
            
            $display = $this->createDetailedDisplay($id);
            
            if(isLoggedIn()){
              echo $display;
            } else{
              echo "Нямате достъп до този режим на преглед! Влезте в системата или се регистрирайте, за да видите повече за тази дисциплина.";
            }
          }

          public function detailedWithDependencies($id){
            ob_clean();
            flush();
            
            $display = $this->dependenciesDisplay($id);
            
            if(isLoggedIn()){
              echo $display;
            } else{
              echo "Нямате достъп до този режим на преглед! Влезте в системата или се регистрирайте, за да видите повече за тази дисциплина.";
            }
          }
          
          public function admin($id){
            ob_clean();
            flush();
            
            $display = $this->createAdminDisplay($id);
            
            if($_SESSION['user_role'] == 'admin'){
              echo $display;
            } else{
              echo "Нямате достъп до този режим на преглед!";
            }
          }
          
          public function visualise($id){
            $discipline = $this->disciplineModel->getDisciplineById($id);
            $defaultDisplay = $this->createShortDisplay($id);
           
            $data = [
                'discipline' => $discipline,
                'defaultDisplay' => $defaultDisplay,
            ];

            $this->view('disciplines/visualise', $data);
          }
          
        public function download($id){
              $file ="../public/JSONS/file" . $id . ".json";
              if(file_exists($file)) { 
              }else{
                  die($file);
              }
            
              $type = filetype(json_decode($file));

              if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Transfer-Encoding: binary');
                header('Content-Type: application/json; charset=utf-8'); 
                header('Content-Disposition: attachment; filename="'.basename($file).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));

                /*Without those two PRECIOUS lines the file is an html page for some ILLOGICAL reason */
                ob_clean();
                flush();

                readfile($file);
          }
        }

        public function downloadHTML($id){

          $css = file_get_contents("../public/css/visualise.css");
          $embeddedStyle = "<style>" . 
          $css .
          "</style>";

          $initialHtml = "<!DOCTYPE html>" .
          "<head>" .
          "<title>Document</title>" .
          /* Linking the google font in this file too, since the font is served from google and not locally. */
          "<link href=\"https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,200;0,400;0,500;0,600;1,300;1,600&display=swap\" rel=\"stylesheet\">" . 
          $embeddedStyle .
          "</head>" .
          "<body>" .
          "<div class=\"mainContainer\">"; 

            
          $content = $this->createAdminDisplay($id);

          $finalHtml = "</div>" .
          "</body>" .
          "</html>";
          
          header('Content-Description: File Transfer');
          header('Content-Transfer-Encoding: binary');
          header('Content-Type: text/html; charset=utf-8'); 
          header('Content-Disposition: attachment; filename="disciplineHtml-'.$id.'"');
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');

          ob_clean();
          flush();
          
          echo $initialHtml . $content . $finalHtml;
        }
    

        public function delete($id){
          if($_SESSION['user_role'] == 'admin'){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
              if($this->disciplineModel->deleteDiscipline($id)){
                flash('discipline_message', 'Discipline removed');
                redirect('disciplines');
              } else {
                die('Something went wrong');
              }
            } else{
              redirect('disciplines');
            }
          }
        } 

    }
?>          