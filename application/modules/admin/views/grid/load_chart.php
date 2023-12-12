<canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
<?php
if(!empty(@$warning)){
    // var_dump($warning);
    ?>
    <div class="container text-center mt-2">
        <h4 style="color: red;">This student is in dire need of counseling. Consider making an appointment to this student.</h4>
    </div>
    <?php
}
?>
<script>
    $(function() {
        var itemarr = <?php echo json_encode($mood_stat); ?>;
        // console.log(itemarr);
        var moodstat = [0, 0, 0, 0];
        itemarr.forEach(function(data) {
            var moodValue = parseInt(data.Mood);
            switch (moodValue) {
                case 1:
                    // console.log(1);
                    moodstat[0]++;
                    break;
                case 2:
                    // console.log(2);
                    moodstat[1]++;
                    break;
                case 3:
                    // console.log(3);
                    moodstat[2]++;
                    break;
                case 4:
                    // console.log(4);
                    moodstat[3]++;
                    break;
            }
        });
        // console.log(moodstat);

        var donutData = {
            labels: [
                'Happy',
                'Normal',
                'Sad',
                'Depressed'
            ],
            datasets: [{
                data: moodstat,
                backgroundColor: ['#00a65a', '#f39c12', '#00c0ef', '#f56954'],
            }]
        }

        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData = donutData;
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }

        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        })
    })
</script>