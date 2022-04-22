<!-- STRAT of PHP -->
<?php
    session_start();
    $stafFarmasiID = $_SESSION["stafFarmasiID"];
    $stafFarmasiNama = $_SESSION["stafFarmasiNama"];

    if (!isset($_SESSION["login_farmasi"])){
        header("Location: farmasi_login.php");
        exit;
    }


    // Koneksi database
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "dbpuskesmas";

    $koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

?>
<!-- END of PHP -->

<!-- START of HTML -->
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

        <!-- SECTION ISI -->
        <section class="bg-light">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                    <!-- Pesan selamat datang -->
                    <!-- <div class="col-15 col-lg-10"> -->
                        <br/><br/>
                        <h2 class="display-5 lh-1 text-center mt-5">Resep Obat</h2>
                        <h3 class="text-center">Staf Farmasi: <?php echo $_SESSION['stafFarmasiNama']; ?></h3>
                        <!-- <p class="lead fw-normal text-muted mb-2 mb-lg-0">Silakan login untuk urus obat</p> -->
                    <!-- </div> -->
                </div>
            </div>

            <!-- TABEL Resep Obat -->
            <div class="container px-5">
                <div class="card mt-5">
                <!-- <div class="card row gx-5 align-items-center justify-content-center justify-content-lg-between"> -->
                    <!-- <div class="card mt-5"> mt = margin top -->
                    <div class="card-header bg-gradient-primary-to-secondary text-white">
                        Resep Obat
                    </div>

                    <div class="card-body">
                        <!-- start tabel -->
                        <table class="table table-bordered table-striped">
                            <!-- header tabel -->
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Pasien</th>
                                <th>Nama Dokter</th>
                                <th>Nama Obat</th>
                                <th>Jumlah Obat</th>
                                <th>Status</th>
                                <!-- <th>Staf Farmasi</th> -->
                            </tr>

                            <?php
                                $no = 1;
                                // $tampil = mysqli_query($koneksi, "SELECT * from resep order by resepTgl desc");
                                $sql = "SELECT resep.resepTgl, pasien.pasienNama, dokter.dokterNama, stokobat.obatNama, 
                                               resep.resepJumlahObat, staffarmasi.stafFarmasiNama, staffarmasi.stafFarmasiID
                                            --    resep.resepStatus
                                        FROM resep 
                                        INNER JOIN pasien ON pasien.pasienID = resep.pasienID
                                        INNER JOIN dokter ON dokter.dokterID = resep.dokterID
                                        INNER JOIN stokobat ON stokobat.obatKode = resep.obatKode
                                        INNER JOIN staffarmasi ON staffarmasi.stafFarmasiID = resep.stafFarmasiID
                                        WHERE resep.stafFarmasiID = $stafFarmasiID";
                                $result = mysqli_query($koneksi, $sql);
                                $dataresep = mysqli_query($koneksi, "SELECT * FROM resep");
                                
                                // while($data = mysqli_fetch_array($tampil)):

                                if(mysqli_num_rows($result) > 0)  
                                {  
                                    while($data = mysqli_fetch_array($result))  
                                    {  
                 
                            ?>

                            <tr>
                                <td><?=$no++;?></td>
                                <td><?=$data['resepTgl']?></td>
                                <td><?=$data['pasienNama']?></td>
                                <td><?=$data['dokterNama']?></td>
                                <td><?=$data['obatNama']?></td>
                                <td><?=$data['resepJumlahObat']?></td>
                                <td>
                                    <select class="form-control" name="tstatus" type="text" data-sb-validations="required" placeholder="Status">
                                        <label for="tdok">Status</label>
                                        <option></option>
                                        <option>Diracik</option>
                                        <option>Selesai</option>
                                    </select>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                        ?>

                        </table>
                        <!-- end tabel -->
                    </div>
                </div>
            </div>
            <!-- end of TABEL RESEP OBAT -->
            
            <!-- BUTTON utk kembali ke MENU FARMASI -->
            <div class="container px-5">
                </br>
                <!-- <div class="row gx-5 align-items-center"> -->
                    <div class="col-lg-12 align-items-center">
                        <a class="btn btn-secondary rounded-pill btn-lg" href="farmasi_menu.php">Menu Farmasi</a>
                    </div>
                <!-- </div> -->
            </div>
            <!-- end of BUTTON kembali ke MENU FARMASI -->
        </section>
        <!-- end of SECTION ISI -->

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

        <!-- Footer-->
        <footer class="bg-black text-center py-5">
            <div class="container px-5">
                <div class="text-white-50 small">
                    <div class="mb-2">&copy; SI Puskesmas 2021. All Rights Reserved.</div>
                    <!-- <a href="#!">Privacy</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#!">Terms</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#!">FAQ</a> -->
                </div>
            </div>
        </footer>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>

    </body>
</html>
