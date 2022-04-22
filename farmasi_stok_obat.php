<!-- STRAT of PHP -->
<?php

    session_start();

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

    // jika tombol save diklik
    if(isset($_POST['bsimpan'])){
        // pengujian apakah data akan diedit atau disimpan baru
        if($_GET['hal']=="edit"){
            // data akan diedit
            $edit = mysqli_query($koneksi, "UPDATE stokobat set
                                                obatNama = '$_POST[tnama]',
                                                obatStok = '$_POST[tstok]',
                                                obatHarga = '$_POST[tharga]'
                                            WHERE obatKode = '$_GET[id]'
                                    ");    
            if($edit){
                // jika edit sukses
                echo "<script>
                     alert('Edit data sukses!');
                     document.location='farmasi_stok_obat.php'
                     </script>";
            }
            else{
                // jika edit gagal
                echo "<script>
                     alert('Edit data GAGAL!');
                     document.location='farmasi_stok_obat.php'
                     </script>";
            }
        }
        else{
            // data akan disimpan baru
            $simpan = mysqli_query($koneksi, "INSERT INTO stokobat (obatNama, obatStok, obatHarga)
                                              VALUES ('$_POST[tnama]', 
                                                      '$_POST[tstok]',
                                                      '$_POST[tharga]')
                                    ");    
            if($simpan){
                // jika simpan sukses
                echo "<script>
                     alert('Simpan data sukses!');
                     document.location='farmasi_stok_obat.php'
                     </script>";
            }
            else{
                // jika simpan gagal
                echo "<script>
                     alert('Simpan data GAGAL!');
                     document.location='farmasi_stok_obat.php'
                     </script>";
            }
        }


    }

    // pengujian jika tombol edit/hapus di klik
    if(isset($_GET['hal'])){
        // pengujian jika edit data
        if($_GET['hal']=="edit"){
            // tampilkan data yg akan diedit
            $tampil = mysqli_query($koneksi, "SELECT * FROM stokobat WHERE obatKode = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data){
                // jika data ditemukan, maka data ditampung ke dalam variabel
                $vnama = $data['obatNama'];
                $vstok = $data['obatStok'];
                $vharga = $data['obatHarga'];
            }
        }
        else if($_GET['hal']=="hapus"){
            // persiapan hapus data
            $hapus = mysqli_query($koneksi, "DELETE FROM stokobat WHERE obatKode = '$_GET[id]' ");
            if($hapus){
                echo "<script>
                     alert('Hapus data sukses!');
                     document.location='farmasi_stok_obat.php'
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
                    <h2 class="display-5 lh-1 mb-1 text-center mt-5">Data Stok Obat</h2>
                    <!-- <p class="lead fw-normal text-muted mb-2 mb-lg-0">Silakan login untuk urus obat</p> -->
                <!-- </div> -->
            </div>
        </div>

        <!-- Card form 'INPUT Stok Obat'-->
        <div class="container px-5">
            <div class="card mt-5"> <!-- mt = margin top-->
            <div class="card-header bg-gradient-primary-to-secondary text-white">
                Input Data Obat
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <!-- Input Nama Obat -->
                    <div classs="form-group">
                        <label>Nama Obat</label>
                        <input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="Nama Obat" required>
                    </div>   
                    <!-- Input Stok Obat -->
                    <div classs="form-group">
                        <label>Stok Obat</label>
                        <input type="text" name="tstok" value="<?=@$vstok?>" class="form-control" placeholder="Stok Obat" required>
                    </div>   
                    <!-- Input Harga Satuan Obat -->
                    <div classs="form-group">
                        <label>Harga Satuan Obat</label>
                        <input type="text" name="tharga" value="<?=@$vharga?>" class="form-control" placeholder="Harga Satuan Obat" required>
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
                        Daftar Stok Obat
                    </div>

                    <div class="card-body">
                        <!-- start tabel -->
                        <table class="table table-bordered table-striped">
                            <!-- header tabel -->
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Stok Obat</th>
                                <th>Harga Satuan Obat (Rp)</th>
                                <th>Aksi</th>
                            </tr>

                            <?php
                                $no = 1;
                                $tampil = mysqli_query($koneksi, "SELECT * from stokobat order by obatKode desc");
                                while($data = mysqli_fetch_array($tampil)):
                            ?>

                            <tr>
                                <td><?=$no++;?></td>
                                <td><?=$data['obatNama']?></td>
                                <td><?=$data['obatStok']?></td>
                                <td><?=$data['obatHarga']?></td>
                                <td>
                                    <a href="farmasi_stok_obat.php?hal=edit&id=<?=$data['obatKode']?>" class="btn btn-warning">Edit</a>
                                    <a href="farmasi_stok_obat.php?hal=hapus&id=<?=$data['obatKode']?>" onclick="return confirm('Apakah data ingin dihapus?')" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile;?>

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
                        <a class="btn btn-secondary rounded-pill btn-lg" href="farmasi_menu.php">Menu Farmasi</a>
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
