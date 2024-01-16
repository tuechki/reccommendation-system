<div class="nav">
    <a id="home-link" href="<?php echo URLROOT; ?>/"><img id="fmi-logo" src="<?php echo URLROOT; ?>/public/img/fmi-logo.svg" alt="Home"></a>
    <?php if(isset($_SESSION['user_id'])) : ?>
        
            <a class="nav-link" href="<?php echo URLROOT; ?>/curriculums/index">Учебни планове</a>
            <a class="nav-link" href="<?php echo URLROOT; ?>/disciplines/index">Дисциплини</a>
            <?php if($_SESSION['user_role'] == 'admin') : ?>
                <a class="nav-link" href="<?php echo URLROOT; ?>/disciplines/import" class="btn">Добави дисциплина</a>
            <?php endif; ?> 
        
        <div class="right">
            <p>Здравей, <?php echo $_SESSION['user_name']; ?>!</p>
            <a class="nav-link" id="logout" href="<?php echo URLROOT; ?>/users/logout">Изход</a>
        </div> 
       
        <?php else : ?>
            <a class="nav-link" href="<?php echo URLROOT; ?>/curriculums/index">Учебни планове</a>
            <a class="nav-link" href="<?php echo URLROOT; ?>/disciplines/index">Дисциплини</a>
        <div class="right">
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Регистрация</a>
            <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Вход</a>
        </div>        
        <?php endif; ?>
      
</div>