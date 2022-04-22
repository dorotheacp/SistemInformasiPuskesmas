<?php
session_start();
$dokterNama = $_SESSION["dokterNama"];

if (!isset($_SESSION["login_dokter"])){
    header("Location: dokter_login.php");
    exit;
}

// Koneksi database
$server = "localhost";
$user = "root";
$pass = "";
$database = "dbpuskesmas";

$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SI Puskesmas</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>

    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
            <div class="container px-5">
                <a class="navbar-brand fw-bold" href="#page-top">SI Puskesmas</a>
                <!-- LOGOUT BUTTON -->
                <a class="btn btn-outline-primary rounded-pill" href="logout.php"> <!--py-3 px-4 rounded-pill mb-2 mb-lg-0-->
                    Logout
                </a>
            </div>
        </nav>
        <!-- end of Navigation -->

        <!-- ISI DI SINI -->
        <section class="bg-light">
            <div class="container px-5">
                <div>
                </br>
                    <h1 class="text-center">Menu Dokter</h1>
                    <h2 class="text-center mb-5">Selamat datang, <?php echo $_SESSION['dokterNama']; ?>!</h2>
                </div>
                <div class="row gx-5 align items-center">
                    <!-- Menu Jadwal Praktek Dokter -->
                    <div class="col-lg-6">
                        <div class="text-center items-center">
                            <i class="bi-patch-check icon-feature text-gradient d-block mb-3"></i>
                            <h3 class="font-alt">Jadwal Praktek Dokter</h3>
                            <p class="text-muted mt-3 mb-3">Tambahkan, perbarui, hapus, atau lihat jadwal praktek dokter</p>
                            <a class="btn btn-primary py-3 px-4 rounded-pill mb-2 mb-lg-0" href="dokter_jadwal_praktek.php">Praktek Dokter</a>
                            <!-- <div class="px-5 px-sm-0"><img class="img-fluid rounded-circle" src="assets/img/hospital_square.png" alt="..." /></div> -->
                        </div>
                    </div>
                    <!-- Menu Jadwal Pemeriksaan Pasien -->
                    <div class="col-lg-6">
                        <div class="text-center items-center">
                            <i class="bi-patch-check icon-feature text-gradient d-block mb-3"></i>
                            <h3 class="font-alt">Jadwal Pemeriksaan Pasien</h3>
                            <p class="text-muted mb-3">Lihat jadwal pemeriksaan pasien</p>
                            <a class="btn btn-primary py-3 px-4 rounded-pill mb-2 mb-lg-0" href="dokter_jadwal_periksa.php">Pemeriksaan Pasien</a>
                            <!-- <div class="px-5 px-sm-0"><img class="img-fluid rounded-circle" src="assets/img/hospital_square.png" alt="..." /></div> -->
                        </div>
                    </div>
                    <!-- Menu Rekam Medis -->
                    <!-- <div class="col-lg-3">
                        <div class="text-center items-center">
                            <i class="bi-patch-check icon-feature text-gradient d-block mb-3"></i>
                            <h3 class="font-alt">Rekam Medis</h3>
                            <p class="text-muted mb-3">Tambahkan, perbarui, atau lihat rekam medis pasien</p>
                            <a class="btn btn-primary py-3 px-4 rounded-pill mb-2 mb-lg-0" href="dokter_rekmed.php">Rekam Medis</a>
                            <div class="px-5 px-sm-0"><img class="img-fluid rounded-circle" src="assets/img/hospital_square.png" alt="..." /></div>
                        </div>
                    </div> -->
                    <!-- Menu Resep Obat -->
                    <!-- <div class="col-lg-3">
                        <div class="text-center items-center">
                            <i class="bi-patch-check icon-feature text-gradient d-block mb-3"></i>
                            <h3 class="font-alt">Resep Obat</h3>
                            <p class="text-muted mb-3">Tambahkan, perbarui, hapus, atau lihat resep obat untuk pasien</p>
                            <a class="btn btn-primary py-3 px-4 rounded-pill mb-2 mb-lg-0" href="dokter_resep_obat.php">Resep Obat</a>
                            <div class="px-5 px-sm-0"><img class="img-fluid rounded-circle" src="assets/img/hospital_square.png" alt="..." /></div>
                        </div>
                    </div> -->

                </div>

            </div>
         
        </section>
        <!-- end -->


        <!-- Nama Kelompok -->
        <section class="bg-gradient-primary-to-secondary" id="credit">
            <div class="container px-5">
                <h3 class="text-center text-white font-alt mb-4">Kelompok 4</h3>
                <div class="text-center">
                    <p class="text-white mb-0">18318007 Dorothea Claresta Putripakarti</p>
                    <p class="text-white mb-0">18318018 Tasya Monika Saphira</p>
                    <p class="text-white mb-0">18318041 Hesqiva Nadhiyaa Attauriq</p>
                </div>
            </div>
        </section>
        <!-- end of Nama Kelompok -->

        <!-- Footer-->
        <footer class="bg-black text-center py-5">
            <div class="container px-5">
                <div class="text-white-50 small">
                    <div class="mb-2">&copy; SI Puskesmas 2021. All Rights Reserved.</div>
                </div>
            </div>
        </footer>
        <!-- end of Footer -->
    </body>
</html>
