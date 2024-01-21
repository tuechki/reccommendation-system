<?php require APPROOT . '/views/inc/header.php'; ?>

<?php
$fields = [
    "specialtiesAndCourses" => "Специалност ",
    "oks" => "ОКС         ",
    "year" => "Курс     ",
    "fn" => "Фак. номер     ",
    "interests" => "Интереси   "
];
?>

<div class="disciplinesAllContainerProfile">
    <div class="topContainerProfile">
        <div class="title">
            <h1>Профил</h1>
        </div>

        <div id="searchDiv">
            <form id="profileUpdateForm" action="<?php echo URLROOT; ?>/users/profile" method="post">
                <?php foreach ($fields as $field => $label): ?>
                    <div class="field-container-profile">
                        <label for="<?php echo $field; ?>"><?php echo $label; ?>:</label>
                        <?php if ($field === "oks"): ?>
                            <select name="<?php echo $field; ?>" id="<?php echo $field; ?>">
                                <option value="">-- Изберете ОКС --</option>
                                <option value="Бакалавър" <?php echo ($data['userProfile']->$field === 'Бакалавър') ? 'selected' : ''; ?>>Бакалавър</option>
                                <option value="Магистър" <?php echo ($data['userProfile']->$field === 'Магистър') ? 'selected' : ''; ?>>Магистър</option>
                            </select>
                        <?php elseif ($field === "year"): ?>
                            <select name="<?php echo $field; ?>" id="<?php echo $field; ?>">
                                <option value="">-- Изберете курс --</option>
                                <?php for ($i = 1; $i <= 4; $i++): ?>
                                    <option value="<?php echo $i; ?>" <?php echo ($data['userProfile']->$field == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        <?php elseif ($field === "specialtiesAndCourses"): ?>
                            <select name="<?php echo $field; ?>" id="<?php echo $field; ?>">
                                <option value="">-- Изберете специалност --</option>
                                <option value="Компютърни науки" <?php echo ($data['userProfile']->$field === 'Компютърни науки') ? 'selected' : ''; ?>>Компютърни науки</option>
                                <option value="Софтуерно инженерство" <?php echo ($data['userProfile']->$field === 'Софтуерно инженерство') ? 'selected' : ''; ?>>Софтуерно инженерство</option>
                                <option value="Математика" <?php echo ($data['userProfile']->$field === 'Математика') ? 'selected' : ''; ?>>Математика</option>
                            </select>
                        <?php elseif ($field === "interests"): ?>
                            <textarea name="<?php echo $field; ?>" id="<?php echo $field; ?>" rows="6" cols="50"><?php echo htmlspecialchars($data['userProfile']->$field); ?></textarea>
                        <?php else: ?>
                            <input type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>" value="<?php echo htmlspecialchars($data['userProfile']->$field); ?>">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <div id="updateProfile">
                    <input type="submit" value="Обнови профил">
                </div>

                <input type="hidden" name="jsonFields" id="jsonFields">
            </form>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    document.querySelector('#profileUpdateForm').addEventListener('submit', function (event) {
                        event.preventDefault();
                        var formData = {};
                        var formElements = this.elements;

                        for (var i = 0; i < formElements.length; i++) {
                            var field = formElements[i];

                            if (field.type !== 'submit' && field.name !== "jsonFields") {
                                formData[field.name] = field.value;
                            }
                        }

                        <?php if(isset($_SESSION['user_id'])) : ?>
                        formData['id'] = <?php echo $_SESSION['user_id'] ?>
                        <?php endif; ?>

                            document.getElementById('jsonFields').value = encodeURIComponent(JSON.stringify(formData));
                        this.submit();
                    });
                });
            </script>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
