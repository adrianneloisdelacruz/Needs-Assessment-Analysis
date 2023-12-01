<?php
require "config/connect.php";
$query = "SELECT string_keyword, count(*) as number FROM responded_program GROUP BY string_keyword";
$result = mysqli_query($con,$query);

 ?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.load('visualization', '1.1', {packages: ['line']});
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['string_keyword','number'],
          <?php 


          while ($row = mysqli_fetch_array($result)) {
            echo "['".$row["string_keyword"]."', ".$row["number"]."],";
          }

           ?>
        ]);

        var options = {
          legend: 'none',
          title: '',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));

        chart.draw(data, options);
      }

    </script>
    

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['On-Going', <?php $no = '1'; echo countOngoing($no); ?>    ]
          
        ]);

        var options = {
          legend: 'none',
          title: '',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>







  </head>

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="main.php">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->


<section class="section dashboard">
  <div class="row">
    <!-- Left side columns -->
    <div class="col">
      <div class="row d-flex justify-content-between">
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">Total Responded = <?php echo countResponded(); ?></h5>

              <div class="d-flex align-items-center">
                <div class=" d-flex align-items-center justify-content-center">
                  <i class=""></i>
                  <div id="piechart_3d" style="width: 1000px; height: 300px; padding-right: 723px; padding-bottom: 0px;">
                </div>
                </div>
                <div class="ps-3">
                  
                  <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1"></span>
                </div>
              </div>
            </div>

          </div>
        </div>





        <!-- Revenue Card -->



        <div class="col-xxl-4 col-md-4">
          <div class="card info-card revenue-card">

            <div class="card-body">
              <h5 class="card-title">On-Going Projects = <?php $no = '1'; echo countOngoing($no); ?> </h5>
              <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center">
                  <i class=""></i>
                </div>
                <div class="ps-3">
                   <!-- 0=create,1=ongoing,2=done -->
                      <div id="donutchart" style="width: 1000px; height: 275px; padding-right: 768px; padding-bottom: 0px;"></div>
                  <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1"></span>

                </div>
              </div>
            </div>
          </div><!-- End Revenue Card -->
        </div>










        <div class="col-xxl-4 col-md-4">
          <div class="card info-card customers-card">
            <div class="card-body">
              <h5 class="card-title">Completed Projects </h5> <!-- 0=create,1=ongoing,2=done -->
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-folder"></i>
                </div>
                <div class="ps-3">
                  <h6><?php $no = '2';
                      echo countCompletedProj($no); ?></h6>
                  <span class="text-danger small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1"></span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Customers Card -->
      </div>







      <!-- Recent Sales -->
      <div class="col">
        <div class="col-12">
          <div class="card recent-sales overflow-auto">
            <div class="card-body">
              <h5 class="card-title">Recently Responded </h5>
              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">no</th>
                    <th scope="col">Name</th>
                    <th scope="col">Course</th>
                    <th scope="col">Program Title</th>
                    <th scope="col">Beneficiary</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $result = getRecentRespond();
                  $count = 0;
                  while ($row = mysqli_fetch_assoc($result)) {
                    $count++;
                  ?>
                    <tr>
                      <th scope="row"><a href="#">#<?= $count ?></a></th>
                      <td><?= $row['family_name'] ?> <?= $row['first_name'] ?></td>
                      <td><a href="#" class="text-primary"><?= $row['course_title'] ?></a></td>
                      <td><?= $row['program_title'] ?></td>
                      <td><?= $row['intend_beneficiary'] ?></td>
                    </tr>
                  <?php }
                  ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- End Recent Sales -->
    </div>
  </div>
</section>

