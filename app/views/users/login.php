<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="authFormContainer">
            <?php flash('register_success');?>
            <h2>Вход в системата</h2>
            <form action="<?php echo URLROOT; ?>/users/login" method="post">

                <div class="form-group">
                <div class="row">
                    <label for="email">Имейл:</label>
                    <div class="inputAndSpan">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        <input type="text" name="email" class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $data['email']; ?>">
                    </div>
                </div>
                </div>

                <div class="form-group">
                <div class="row">
                    <label for="password">Парола:</label>
                    <div class="inputAndSpan">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        <input type="password" name="password" class="<?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"
                         value="<?php echo $data['password']; ?>">
                    </div>
                </div>
                </div>

                <div class="buttonRow">
                    <a class="commonLink" href="<?php echo URLROOT ;?>/users/register">Регистрация</a>
                    <input type="submit" value="Вход">
                    </div>
                </div>
            </form>
    </div>
