<!-- STRAT of PHP -->
<?php

    session_start();
    $dokterID = $_SESSION["dokterID"];
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

    // jika tombol save diklik
    if(isset($_POST['bsimpan'])){
        // pengujian apakah data akan diedit atau disimpan baru
        if($_GET['hal']=="edit"){
            // data akan diedit
            $edit = mysqli_query($koneksi, "UPDATE jadwalpraktek set
                                                jadwalTglPraktek = '$_POST[ttglpraktek]',
                                                jadwalJamMulai = '$_POST[tjammulai]',
                                                jadwalJamSelesai= '$_POST[tjamselesai]',
                                                dokterID = $dokterID
                                            WHERE jadwalID = '$_GET[id]'
                                    ");    
            if($edit){
                // jika edit sukses
                echo "<script>
                     alert('Edit data sukses!');
                     document.location='dokter_jadwal_praktek.php'
                     </script>";
            }
            else{
                // jika edit gagal
                echo "<script>
                     alert('Edit data GAGAL!');
                     document.location='dokter_jadwal_praktek.php'
                     </script>";
            }
        }
        else{
            // data akan disimpan baru
            $simpan = mysqli_query($koneksi, "INSERT INTO jadwalpraktek (jadwalTglPraktek, jadwalJamMulai, jadwalJamSelesai, dokterID)
                                              VALUES ('$_POST[ttglpraktek]', 
                                                      '$_POST[tjammulai]',
                                                      '$_POST[tjamselesai]',
                                                      $dokterID)
                                    ");    
            if($simpan){
                // jika simpan sukses
                echo "<script>
                     alert('Simpan data sukses!');
                     document.location='dokter_jadwal_praktek.php'
                     </script>";
            }
            else{
                // jika simpan gagal
                echo "<script>
                     alert('Simpan data GAGAL!');
                     document.location='dokter_jadwal_praktek.php'
                     </script>";
            }
        }


    }

    // pengujian jika tombol edit/hapus di klik
    if(isset($_GET['hal'])){
        // pengujian jika edit data
        if($_GET['hal']=="edit"){
            // tampilkan data yg akan diedit
            $tampil = mysqli_query($koneksi, "SELECT * FROM jadwalpraktek WHERE jadwalID = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data){
                // jika data ditemukan, maka data ditampung ke dalam variabel
                $vtglpraktek = $data['jadwalTglPraktek'];
                $vjammulai = $data['jadwalJamMulai'];
                $vjamselesai = $data['jadwalJamSelesai'];
                // $dokterID = $data['dokterID'];

            }
        }
        else if($_GET['hal']=="hapus"){
            // persiapan hapus data
            $hapus = mysqli_query($koneksi, "DELETE FROM jadwalpraktek WHERE jadwalID = '$_GET[id]' ");
            if($hapus){
                echo "<script>
                     alert('Hapus data sukses!');
                     document.location='dokter_jadwal_praktek.php'
                     </script>";
            }

        }
    }

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

        <!-- judul page -->
        <section class="bg-light">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                <!-- Pesan selamat datang -->
                <!-- <div class="col-15 col-lg-10"> -->
                    <br/><br/>
                    <h2 class="display-5 lh-1 mb-1 text-center mt-5">Jadwal Praktek</h2>
                    <h3 class="text-center"><?php echo $_SESSION['dokterNama']; ?></h2>
                <!-- </div> -->
            </div>
        </div>

        <!-- Card form 'INPUT Jadwal Praktek'-->
        <div class="container px-5">
            <div class="card mt-5"> <!-- mt = margin top-->
            <div class="card-header bg-gradient-primary-to-secondary text-white">
                Input Jadwal Praktek Dokter
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <!-- Input ID Dokter
                    <div classs="form-group">
                        <label>ID Dokter</label>
                        <input type="text" name="tdokterid" value="<?=@$vdokterid?>" class="form-control" placeholder="ID Dokter" required>
                    </div>    -->
                    <!-- Input Tanggal Praktek -->
                    <div classs="form-group">
                        <label class="mt-2">Tanggal Praktek</label>
                        <input type="date" name="ttglpraktek" value="<?=@$vtglpraktek?>" class="form-control" placeholder="Tanggal Praktek" required>
                    </div>   
                    <!-- Input Harga Satuan Obat -->
                    <div classs="form-group">
                        <label class="mt-2">Jam Mulai Praktek</label>
                        <input type="time" name="tjammulai" value="<?=@$vjammulai?>" class="form-control" placeholder="Jam Mulai Praktek" required>
                    </div>      
                    <!-- Input Harga Satuan Obat -->
                    <div classs="form-group">
                        <label class="mt-2">Jam Selesai Praktek</label>
                        <input type="time" name="tjamselesai" value="<?=@$vjamselesai?>" class="form-control" placeholder="Jam Selesai Praktek" required>
                    </div>              
                    
                    <!-- Button Submit & Reset -->
                    <div class="mt-3"></div>
                    <button type="submit" class="btn btn-success" name="bsimpan">Save</button>
                    <!-- <button type="reset" class="btn btn-danger" name="breset">Clear</button> -->
                </form>
            </div>
            </div> 
        </div>
        <!-- </section> -->
        <!-- End of card form 'INPUT Stok Obat'-->

        <!-- card TABEL stok obat -->
            <div class="container px-5">
                <br/>
                <div class="card mt-5">
                <!-- <div class="card row gx-5 align-items-center justify-content-center justify-content-lg-between"> -->
                    <!-- <div class="card mt-5"> mt = margin top -->
                    <div class="card-header bg-gradient-primary-to-secondary text-white">
                        Jadwal Praktek
                    </div>

                    <div class="card-body">
                        <!-- start tabel -->
                        <table class="table table-bordered table-striped">
                            <!-- header tabel -->
                            <tr>
                                <th>Tanggal</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Nama Dokter</th>
                                <th>Poli Klinik</th>
                                <th>Spesialisasi</th>
                                <th>Aksi</th>
                            </tr>

                            <?php
                                $no = 1;

                                $sql = "SELECT jadwalpraktek.jadwalID,
                                               jadwalpraktek.jadwalTglPraktek,
                                               jadwalpraktek.jadwalJamMulai,
                                               jadwalpraktek.jadwalJamSelesai,
                                               dokter.dokterNama,
                                               dokter.dokterPoli,
                                               dokter.dokterSpesialisasi
                                        FROM jadwalpraktek
                                        INNER JOIN dokter ON jadwalpraktek.dokterID = dokter.dokterID
                                        WHERE jadwalpraktek.dokterID = $dokterID ";
                        
                                $result = mysqli_query($koneksi, $sql);
                            
                                if(mysqli_num_rows($result) > 0)  
                                {  
                                    while($data = mysqli_fetch_array($result))  
                                    {  
                            ?>

                            <tr>
                                <td><?=$data['jadwalTglPraktek']?></td>
                                <td><?=$data['jadwalJamMulai']?></td>
                                <td><?=$data['jadwalJamSelesai']?></td>
                                <td><?=$data['dokterNama']?></td>
                                <td><?=$data['dokterPoli']?></td>
                                <td><?=$data['dokterSpesialisasi']?></td>
                                <td>
                                    <a href="dokter_jadwal_praktek.php?hal=edit&id=<?=$data['jadwalID']?>" class="btn btn-warning">Edit</a>
                                    <a href="dokter_jadwal_praktek.php?hal=hapus&id=<?=$data['jadwalID']?>" onclick="return confirm('Apakah data ingin dihapus?')" class="btn btn-danger">Delete</a>
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
            
            <!-- BUTTON utk kembali ke MENU FARMASI -->
            <div class="container px-5">
                </br>
                <!-- <div class="row gx-5 align-items-center"> -->
                    <div class="col-lg-12 align-items-center">
                        <a class="btn btn-secondary rounded-pill btn-lg" href="dokter_menu.php">Menu Dokter</a>
                    </div>
                <!-- </div> -->
            </div>
            <!-- end of BUTTON kembali ke MENU FARMASI -->
        </section>
        <!-- end of TABEL stok obat -->


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
