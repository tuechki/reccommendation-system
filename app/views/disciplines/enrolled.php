<div class="disciplinesAllContainer">

    <div class="topContainer">

        <div class="title">
            <h1>Дисциплини</h1>
        </div>
        <div id="searchDiv">
            <div class="search">
                <form action="<?php echo URLROOT; ?>/disciplines/index" method="post">
                    <label for="field">Търсене по критерий:</label>
                    <select name="field" id="selectField">
                        <option value="disciplineNameBg">Име</option>
                        <option value="disciplineNameEng">English name</option>
                        <option value="category">Категория</option>
                        <option value="credits">Кредити</option>
                        <option value="semester">Семестър</option>
                        <option value="professor">Преподавател</option>
                        <option value="elective">Задължителна/Избираема</option>
                    </select>
                    <input type="text" name="searchInput" id="searchInput">
                    <div id="buttonDiv">
                        <input type="submit" value="Намери дисциплина">
                    </div>
                </form>
            </div>
            <?php if($data['searchedField']){?>
                <div id="displayLastQuery">
                    <p>Търсене за дисциплина -  <?php echo $data['searchedField']; ?> : <?php echo $data['searchedValue'];?></p>
                </div>
            <?php } ?>

        </div>
    </div>


    <?php if($data['no_results_message']){?>
        <div id="noResults">
            <p><?php echo $data['no_results_message']; ?></p>
        </div>
    <?php } else {?>
        <div class="curriculumList">
            <?php
            foreach($data['disciplines'] as $discipline) :
                ?>
                <div class="discipline-container curriculumRow">
                    <a class="commonLink" href="<?php echo URLROOT . "/disciplines/visualise/" . $discipline->id;?>"><?php echo $discipline->disciplineNameBg;?></a>
                    <?php if(isset($_SESSION['user_id'])) : ?>
                        <form action="<?php echo URLROOT . "/disciplines/unenroll/" ?>" method="POST">
                            <input type="hidden" name="disciplineId" value="<?php echo $discipline->id; ?>">
                            <input type="hidden" name="userId" value="<?php echo $_SESSION['user_id']; ?>">
                            <div class="unenroll-button-container">
                                <button name="unenroll_button" class="unenroll-button">
                                    Отпиши
                                </button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        $enrollmentMessage = $data['enrollmentMessage'];
        $unenrollmentMessage = $data['unenrollmentMessage'];
        ?>
        <input type="hidden" id="enrollmentMessageHidden" value="<?php echo htmlspecialchars($enrollmentMessage, ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" id="unenrollmentMessageHidden" value="<?php echo htmlspecialchars($unenrollmentMessage, ENT_QUOTES, 'UTF-8'); ?>">
    <?php } ?>
</div>

<div id="enrollmentModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeЕnrollmentModal()">&times;</span>
        <p id="enrollmentMessage"></p>
    </div>
</div>

<div id="unenrollmentModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeUnenrollmentModal()">&times;</span>
        <p id="unenrollmentMessage"></p>
    </div>
</div>
</body>
<script type="text/javascript">
    // Retrieve and display the enrollment status message
    var enrollmentMessage = document.getElementById("enrollmentMessageHidden").value;
    if (enrollmentMessage != "") {
        openЕnrollmentModal(enrollmentMessage);
    }

    function openЕnrollmentModal(message) {
        var modal = document.getElementById("enrollmentModal");
        var messageElement = document.getElementById("enrollmentMessage");

        messageElement.innerHTML = message;
        modal.style.display = "block";
    }

    function closeЕnrollmentModal() {
        var modal = document.getElementById("enrollmentModal");
        modal.style.display = "none";
    }

    // Retrieve and display the enrollment status message
    var unenrollmentMessage = document.getElementById("unenrollmentMessageHidden").value;
    if (unenrollmentMessage != "") {
        openUnenrollmentModal(unenrollmentMessage);
    }

    function openUnenrollmentModal(message) {
        var modal = document.getElementById("unenrollmentModal");
        var messageElement = document.getElementById("unenrollmentMessage");

        messageElement.innerHTML = message;
        modal.style.display = "block";
    }

    function closeUnenrollmentModal() {
        var modal = document.getElementById("unenrollmentModal");
        modal.style.display = "none";
    }
</script>
<script src="<?php echo URLROOT; ?>/js/search.js"></script>
