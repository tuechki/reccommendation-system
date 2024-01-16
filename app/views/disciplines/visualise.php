<?php 
$json_data = file_get_contents(URLROOT . "/public/JSONS/file" . $data['discipline']->id . ".json");

$json = json_decode($json_data, true);
$path = URLROOT . "/public/JSONS/file" . $data['discipline']->id . ".json";
?>
<!-- Both link and form work for export -->
<!-- <form action="" method="post"> -->
<!-- <input type="submit" name="submit" value="Свали JSON файл за тази дисциплина"/> -->
<!-- </form> -->
<span id="disciplineId" style="display:none"><?php echo $data['discipline']->id; ?></span>

<div id="reviewNav">
    <p class="adminLink" disabled href="#"?>Преглед:</p>
    <a class="adminLink activeNavLink" id="short" href="">Кратък</a>
    <a class="adminLink" id="detailed" href="">Подробен</a>
    <a class="adminLink"  id="dependencies" href="">Зависимости</a>
    <a class="adminLink" id="admin" href="">Служебен</a>
    <?php if($_SESSION['user_role'] == 'admin') { ?>
        <a class="adminLink" href="<?php echo URLROOT . "/disciplines/download/" . $data['discipline']->id ?>">JSON файл</a>
        <a class="adminLink" href="<?php echo URLROOT . "/disciplines/downloadHTML/" . $data['discipline']->id ?>">HTML файл</a>
        <a class="adminLink" href="<?php echo  URLROOT . "/disciplines/edit/" . $data['discipline']->id ?>">Редактиране</a>
        <form class="adminLink" style="background-color:#ee594e;" action="<?php echo  URLROOT . "/disciplines/delete/" . $data['discipline']->id ?>" method="post">
        <input type="submit" value="Изтриване">
        </form>

    <?php } ?>
</div>

<div id="disciplineCV" class="mainContainer">
        <?php echo $data['defaultDisplay']; ?>
</div>

<script type="text/javascript" src="../../public/js/loadReviews.js"></script>
</body>
</html>