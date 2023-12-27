<?php
session_start();

include('../../Controller/Config/Connection.php');
if (!isset($_SESSION['id'])) {
    header("Location: ../../View/Admin/login.php");
    exit();
}
$user_admin = $_SESSION['id'];

// Pengecekan disini
if (!isset($_SESSION['id'])) {
    echo "<p>Anda harus login untuk mengakses halaman ini.</p>";
    exit();
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

    <title>Home</title>

    <!-- Custom fonts for this template -->
    <link href="../../Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../Assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../../Assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nama']; ?></span>
                            </a>
                        </li>

                    </ul>

                </nav>
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <h2 class="mb-4" style="text-align: center; color: #4e73df;">Kelola Berita</h2>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Berita</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No Artikel</th>
                                            <th>Judul</th>
                                            <th>Tanggal</th>
                                            <th>Oleh</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include('../../Controller/Config/Connection.php');
                                        $sql = "SELECT  * FROM articles";
                                        $result = $conn->query($sql);
                                        if ($result -> num_rows > 0 ) {
                                            while ($row = $result-> fetch_assoc()){
                                                echo "<tr>
                                                <td>" . $row["nomer_artikel"] . "</td>
                                                <td>" . $row["title"] . "</td>
                                                <td>" . (!empty($row['timestamp']) ? htmlspecialchars(date('d-m-Y H:i:s', strtotime($row['timestamp']))) : '') . "</td>;
                                                <td>" . $row["oleh"] . "</td>
                                                <td>" . $row["status_publikasi"] . "</td>
                                                <td>
                                                <a href='DetailBerita?no=" . $row["nomer_artikel"] . "' class='btn btn-primary btn-user'>Detail</a>
                                                <a href='DetailBerita?no=" . $row["nomer_artikel"] . "&edit=1' class='btn btn-primary btn-user'>Edit</a>
                                                <button type='button' data-nomer_artikel='" . $row["nomer_artikel"] . "' class='btn btn-danger delete-btn'>Hapus</button>
                                                            </td>
                                                    </tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include '../../Assets/Components/footer.html'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="../../Assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../Assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../Assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../Assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../Assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../Assets/js/demo/datatables-demo.js"></script>
    <script>
        $(document).ready(function () {
            // Tangani klik tombol Hapus
            $('.delete-btn').click(function () {
                var nomer_artikel = $(this).data('nomer_artikel');

                // Kirim permintaan penghapusan ke server melalui Ajax
                $.ajax({
                    url: '../../Controller/Admin/Auth/deleteData.php', // Gantilah dengan nama file PHP yang menangani penghapusan data
                    type: 'POST',
                    data: { nomer_artikel: nomer_artikel },
                    success: function (response) {
                        // Perbarui tabel atau lakukan aksi lain yang diperlukan setelah penghapusan berhasil
                        // Contoh: reload halaman
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        // Tangani kesalahan jika diperlukan
                    }
                });
            });
        });
    </script>
</body>

</html>