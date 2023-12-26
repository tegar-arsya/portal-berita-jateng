<?php
session_start();

include('../../Controller/Config/Connection.php');
if (!isset($_SESSION['id'])) {
    header("Location: ../../View/Admin/login.php");
    exit();
}
$user_admin = $_SESSION['id'];

$sqldata = "SELECT COUNT(*) as total_data, MONTH(timestamp) as month FROM articles GROUP BY MONTH(timestamp)";
$resultdata = $conn->query($sqldata);

$datasql = array_fill(0, 12, 0); // Inisialisasi array dengan 12 bulan, diisi dengan 0
while ($rowdata = $resultdata->fetch_assoc()) {
    $datasql[$rowdata['month'] - 1] = $rowdata['total_data'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Dashboard</title>

    <!-- Custom fonts for this template-->

    <link href="../../Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/vendor/chart.js/Chart.min.js">
    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="../../Assets/vendor/jquery/jquery.min.js"></script>
<script src="../../Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../Assets/js/sb-admin-2.min.js"></script>
<script>
    // Your custom scripts here
</script>


    <!-- Custom styles for this template-->
    <link href="../../Assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include '../../Assets/Components/NavbarAdmin.html'; ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nama']; ?></span>
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <div class="card shadow mb-4">
                        <div class="card-body">
                            <h2 class="mb-4" style="text-align: center; color: #4e73df;">Selamat Datang Admin Portal Berita Jawa Tengah</h2>
                            <p style="text-align: center; font-size: 18px;">Nikmati berita terkini dan informatif seputar Jawa Tengah.</p>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Monthly)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div id="graphData" class="graph-container" >
                                <canvas id="lineChartData" ></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../../Assets/Components/footer.html'; ?>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../../Assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        // Ambil data berdasarkan ID grafik
        var data = <?php echo json_encode(array_values($datasql)); ?>;

        // Contoh inisialisasi grafik dengan Chart.js
        var ctxLine = document.getElementById('graphData').getElementsByTagName('canvas')[0].getContext('2d');
        var lineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: 'Jumlah',
                    data: data,
                    borderColor: 'rgba(0, 255, 0, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(0, 0, 255, 1)',
                    fill: true,
                    backgroundColor: 'rgba(255, 225, 0, 1)'
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        enabled: true,
                        intersect: false,
                        mode: 'index',
                    },
                    legend: {
                        display: false,
                    },
                },
            }
        });
    </script>
    <!-- Core plugin JavaScript-->
    <script src="../../Assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../Assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../Assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../Assets/js/demo/chart-area-demo.js"></script>
    <script src="../../Assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>