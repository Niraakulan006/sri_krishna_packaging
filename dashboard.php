<?php 
	$page_title = "Dashboard";
	include("include_user_check_and_files.php");

    $monthwise_list = array();
    $monthwise_list = $obj->MonthwiseChart();

    $location_variation_list = array();
    $location_variation_list = $obj->LocationVariationChart();
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
                <div class="col-lg-6 col-md-6 col-12 py-2 px-2 border">
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
    const ctx = document.getElementById('stockChart').getContext('2d');
    new Chart(ctx, {
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

        const ctx = document.getElementById('locationChart').getContext('2d');
        new Chart(ctx, {
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
</script>