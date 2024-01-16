<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="title">
        <h2>Дисциплини, изучавани от специалност <?php echo $data['curriculum']->specialty;?></h2>
        <h2>Випуск, приет през академичната <?php echo $data['curriculum']->academicYear;?></h2>
    </div>


<div class="curriculumsPageContainer">
        <table>
            <tr>
                <th>№</th>
                <th>Име</th>
                <th>Преподавател</th>
                <th>ОКС</th>
                <th>Кредити</th>
            </tr>
        <?php $count = 1; ?>
        <?php foreach($data['disciplines'] as $discipline) : ?>
                <tr>
                    <td><?php echo $count;?></td>
                    <td>
                        <a class="tableLink" href="<?php echo URLROOT . "/disciplines/visualise/" . $discipline->id;?>"> <div class="curriculumRow"><?php echo $discipline->disciplineNameBg;?></div></a>
                    </td>
                    <td><?php echo $discipline->professor;?></td>
                    <td><?php echo $discipline->category;?></td>
                    <td><?php echo $discipline->credits;?></td>
                </tr>
                <?php $count++; ?>
        <?php endforeach; ?>
        </table>
</div>