<?php 
	$page_title = "Dashboard";
	include("include_user_check_and_files.php");

    $monthwise_list = array();
    $monthwise_list = $obj->MonthwiseChart();

    $location_variation_list = array();
    $location_variation_list = $obj->LocationVariationChart();

    $stock_in_out_list = array();
    $stock_in_out_list = $obj->getStockPercentage();
?>
<?php include "header.php"; ?>
<!-- Start right Content here -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row mx-0">
                <div class="col-11 mx-auto my-3 border table-responsive">
                    <div style="position: relative; height:500px; width:100%">
                        <canvas id="locationChart"></canvas>
                    </div>
                </div>
                <hr>
                <div class="col-lg-6 col-md-6 col-12 py-2 px-2 border">
                    <h5 class="mb-2 text-center">📊 Stock Inward vs Outward (Monthly)</h5>
                    <canvas id="stockChart"></canvas>
                </div>
                <div class="col-lg-6 col-md-6 col-12 py-2 px-2 border table-responsive">
                    <div style="width: 400px; margin: auto;">
                        <canvas id="gaugeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->   
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#dashboard").addClass("active");
    });
</script>  
<script>
    let data = <?php echo $monthwise_list; ?>;
    const ctx1 = document.getElementById('stockChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [
                { label: 'Inward', data: data.inward, backgroundColor: 'rgba(75, 192, 192, 0.7)' },
                { label: 'Outward', data: data.outward, backgroundColor: 'rgba(255, 99, 132, 0.7)' }
            ]
        }
    });
    document.addEventListener("DOMContentLoaded", function(){
        const res = <?php echo $location_variation_list; ?>;

        const ctx2 = document.getElementById('locationChart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: res.locations,
                datasets: res.datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: { display: true, text: 'Stock Levels by Location & Variation' },
                    tooltip: { mode: 'index', intersect: false },
                    legend: { position: 'top' }
                },
                scales: {
                    x: { stacked: false },
                    y: { beginAtZero: true }
                }
            }
        });
    });
    document.addEventListener("DOMContentLoaded", function(){
        const percentInward = <?php echo $stock_in_out_list['percentage']; ?>;
        const inward = <?php echo $stock_in_out_list['inward']; ?>;
        const outward = <?php echo $stock_in_out_list['outward']; ?>;

        const data = {
            datasets: [{
            data: [percentInward, 100 - percentInward],
            backgroundColor: ['rgba(75, 192, 192, 0.7)', 'rgba(234, 234, 234, 0.7)'],
            borderWidth: 0
            }]
        };
        const needlePlugin = {
            id: 'needlePlugin',
            afterDraw(chart) {
            const { ctx, chartArea: { width, height }, config } = chart;
            const needleValue = percentInward;
            const dataTotal = 100;
            const angle = Math.PI * (1 + (needleValue / dataTotal));
            const cx = width / 2;
            const cy = chart._metasets[0].data[0].y;

            ctx.save();
            ctx.translate(cx, cy);
            ctx.rotate(angle);
            ctx.beginPath();
            ctx.moveTo(0, -2);
            ctx.lineTo(height * 0.4, 0);
            ctx.lineTo(0, 2);
            ctx.fillStyle = '#444';
            ctx.fill();
            ctx.restore();

            ctx.beginPath();
            ctx.arc(cx, cy, 5, 0, Math.PI * 2);
            ctx.fill();
            }
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
            rotation: 270,      // start angle (degrees)
            circumference: 180, // half-circle
            cutout: '60%',
            responsive: true,
            plugins: {
                legend: { display: false },
                title: {
                display: true,
                text: `Inward: ${inward} units vs Outward: ${outward} units`
                }
            }
            },
            plugins: [needlePlugin]
        };

        new Chart(document.getElementById('gaugeChart'), config);
    });
</script>