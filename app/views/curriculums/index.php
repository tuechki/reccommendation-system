<?php require APPROOT . '/views/inc/header.php'; ?>


    <div class="curriculumsPageContainer">
        <h1>Учебни планове</h1>

        <div class="curriculumList">
            <h3>Бакалавърски програми</h3>
            <?php foreach($data['curriculums'] as $curriculum) : ?>
                <?php if ($curriculum->oks == "Бакалавър") {?>
                        <a class="commonLink" href="<?php echo URLROOT . "/curriculums/details/" . $curriculum->id;?>"> <div class="curriculumRow" id="bachelor"><?php echo $curriculum->specialty ;?><label> <?php echo $curriculum->academicYear; ?></label></div></a>
                <?php } ?>
            <?php endforeach; ?>
            
            <h3>Магистърски програми</h3>
            <?php foreach($data['curriculums'] as $curriculum) : ?>
                <?php if ($curriculum->oks == "Магистър") {?>
                    <a class="commonLink" href="<?php echo URLROOT . "/curriculums/details/" . $curriculum->id;?>"> <div class="curriculumRow" id="bachelor"><?php echo $curriculum->specialty ;?><label> <?php echo $curriculum->academicYear; ?></label></div></a>
                <?php } ?>
            <?php endforeach; ?>
        </div>
    </div>


