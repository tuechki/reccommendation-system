<div id="statisticsCharts">
    <div class="chart-container">
        <h3>Брой записани дисциплни от потребител</h3>
        <canvas id="usersByDisciplinesChart" width="300" height="300"></canvas>
    </div>
    <div class="chart-container">
        <h3>Записани потребители за дисциплина</h3>
        <canvas id="disciplinesByUsersChart" width="300" height="300"></canvas>
    </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    // Users by Disciplines Chart
    var usersByDisciplinesData = <?php echo json_encode($data['usersByDisciplinesData']); ?>;
    var usersByDisciplinesChartCanvas = document.getElementById('usersByDisciplinesChart').getContext('2d');

    new Chart(usersByDisciplinesChartCanvas, {
        type: 'pie',
        data: {
            labels: usersByDisciplinesData.map(entry => entry.name),
            datasets: [{
                data: usersByDisciplinesData.map(entry => entry.count),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(50, 205, 50, 0.7)',
                    'rgba(255, 140, 0, 0.7)',
                    'rgba(70, 130, 180, 0.7)',
                    'rgba(210, 105, 30, 0.7)',
                    'rgba(0, 128, 128, 0.7)',
                    'rgba(128, 0, 0, 0.7)',
                    'rgba(0, 0, 128, 0.7)',
                    'rgba(128, 128, 0, 0.7)',
                    'rgba(128, 0, 128, 0.7)'
                ],
            }],
        },
        options: {
            title: {
                display: false,
                text: 'Брой записани дисциплини',
            },
        },
    });

    // Disciplines by Users Chart
    var disciplinesByUsersData = <?php echo json_encode($data['disciplinesByUsersData']); ?>;
    var disciplinesByUsersChartCanvas = document.getElementById('disciplinesByUsersChart').getContext('2d');

    new Chart(disciplinesByUsersChartCanvas, {
        type: 'pie',
        data: {
            labels: disciplinesByUsersData.map(entry => entry.disciplineNameBg),
            datasets: [{
                data: disciplinesByUsersData.map(entry => entry.count),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(50, 205, 50, 0.7)',
                    'rgba(255, 140, 0, 0.7)',
                    'rgba(70, 130, 180, 0.7)',
                    'rgba(210, 105, 30, 0.7)',
                    'rgba(0, 128, 128, 0.7)',
                    'rgba(128, 0, 0, 0.7)',
                    'rgba(0, 0, 128, 0.7)',
                    'rgba(128, 128, 0, 0.7)',
                    'rgba(128, 0, 128, 0.7)'
                ],
            }],
        },
        options: {
            title: {
                display: false,
                text: 'Записани потребители за дисциплината',
            },
        },
    });
</script>
</body>
</html>