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
            <?php foreach($data['disciplines'] as $discipline) : ?>
                    <a class="commonLink" href="<?php echo URLROOT . "/disciplines/visualise/" . $discipline->id;?>"> <div class="curriculumRow" ><?php echo $discipline->disciplineNameBg;?></div></a>
            <?php endforeach; ?>
        </div>
    <?php } ?>
</div>
</body>
<script src="<?php echo URLROOT; ?>/js/search.js"></script>
