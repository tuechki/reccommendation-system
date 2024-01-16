
        <div class="importPageContainer">

<div class="info">
    <h1>Редактирай дисциплината</h1>
    <p>
        Дисциплината се редактира подобно на добавянето - като JSON текст в текстовото поле.  </br>
        Можете да валидирате JSON текста си в  <a href="https://jsonlint.com/">JSONLint</a> , преди да го качите.
    </p>
</div>
<div class="importContainer">

<?php $path = URLROOT . "/public/JSONS/file" . $data['id'] . ".json"; ?>

<form id="importJson" method="POST" action="<?php echo URLROOT . "/disciplines/edit/" .  $data['id'];?>">
    <div id="formBody">
        <label for="mainInfo"> JSON файл: </label> 
        <textarea name="mainInfo" class="<?php echo (!empty($data['mainInfo_err'])) ? 'is_invalid' : '';?>" value="<?php echo $data['mainInfo'];?>">
            <?php echo file_get_contents($path); ?>
        </textarea>
        <span class="invalid-feedback"><?php echo $data['mainInfo_err'];?></span>
        <input type="submit" value="Импорт">
    </div>
</form>
</div>
</div>



