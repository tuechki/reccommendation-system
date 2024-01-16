<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="authFormContainer">
            <h2>Регистрация в системата</h2>
            <form action="<?php echo URLROOT; ?>/users/register" method="post">
                <div class="form-group">
                    <div class="row">
                        <label for="name">Потребителско име:</label>
                        <div class="inputAndSpan">
                            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                            <input type="text" name="name" class="<?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $data['name']; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="email">Имейл:</label>
                        <div class="inputAndSpan">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                            <input type="email" name="email" class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
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

                <div class="form-group">
                <div class="row">
                    <label for="password">Потвърди паролата:</label>
                     <div class="inputAndSpan">
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                         <input type="password" name="confirm_password" class="" value="12345">
                    </div>
                </div>
                </div>

                <div class="buttonRow">
                    <a class="commonLink" href="<?php echo URLROOT ;?>/users/login">Вход</a>
                    <input type="submit" value="Регистрирай ме">
                    </div>
                </div>
            </form>
    </div>
