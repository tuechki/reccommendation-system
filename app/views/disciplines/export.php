<div class="container">
    <h1>Експортиране на дисциплини</h1>
    <p>Изберете опцията по-долу, за да експортирате дисциплини за всеки потребител.</p>

    <form method="POST" action=<?php echo URLROOT . "/disciplines/export/"?>>
        <input type="hidden" name="export_type" value="disciplinesByUsers">
        <button type="submit" id="exportButton" class="export-button">Експортиране</button>
    </form>
</div>

</body>
</html>
