<!-- PHP -->
<?php  
    session_start();

    // if (isset($_SESSION["login_dokter"])){
    //     heaeder("Location: dokter_menu.php");
    // }

    // Koneksi database
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "dbpuskesmas";

    $koneksi = mysqli_connect($server, $user, $pass, $database)or die('Unable to connect');

    if (isset($_POST['login'])){
        $dokterID = $_POST['dokterID'];
        $dokterPassword = $_POST['dokterPassword'];
        // $stafFarmasiNama = $_POST['stafFarmasiNama'];

        $select = mysqli_query($koneksi, "SELECT * FROM dokter WHERE 
                                dokterID = '$dokterID' AND
                                dokterPassword = '$dokterPassword' ");
        
        $row = mysqli_fetch_array($select);

        if(is_array($row)){
            $_SESSION["dokterID"] = $row['dokterID'];
            $_SESSION["dokterPassword"] = $row['dokterPassword'];
            $_SESSION["dokterNama"] = $row['dokterNama'];
            $_SESSION["login_dokter"] = true;
            header("Location: dokter_menu.php");
        } else{
            echo '<script type = "text/javascript"> ';
            echo 'alert("Invalid ID or Password!"); ';
            echo 'window.location.href = "dokter_login.php" ';
            echo '</script>';
        }
    } 

?>

<!-- HTML -->
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
                <a class="navbar-brand fw-bold" href="index.html#page-top">SI Puskesmas</a>
            </div>
        </nav>
        <!-- end of Navigation -->
        
        <section class="bg-light">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                    <!-- Pesan selamat datang -->
                    <div class="col-15 col-lg-10">
                        <br/><br/>
                        <h2 class="display-4 lh-1 mb-1">Selamat datang, dokter!</h2>
                        <p class="lead fw-normal text-muted mb-2 mb-lg-0">Silakan login untuk melihat jadwal pemeriksaan pasien, pengisian rekam medis, dan pemberian resep obat</p>
                    </div>

                    <!-- FORM utk LOGIN -->
                    <div class="modal-body border-0 p-4">
                        <form action = "dokter_login.php" method = "post">
                            <!-- Input ID -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="dokterID" name="dokterID" type="text" placeholder="Enter your ID" required/>
                                <label for="dokterID">ID Dokter</label>
                                <div class="invalid-feedback" data-sb-feedback="dokterID:required">ID is required.</div>
                            </div>
                            <!-- Input password -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="dokterPassword" name="dokterPassword" type="password" placeholder="Enter your password" required/>
                                <label for="dokterPassword">Password</label>
                                <div class="invalid-feedback" data-sb-feedback="dokterPassword:required">Password is required.</div>
                            </div>

                            <!-- Submit Button-->
                            <div class="d-grid">
                                <input type="submit" class="btn btn-primary rounded-pill btn-lg" name="login" value="Login">
                            </div>
                            <!-- <div class="d-grid"><button class="btn btn-primary rounded-pill btn-lg" id="submitButton" type="submit" name="login">Login</button></div> -->
                        </form>
                        
                    </div>
                    <!-- end of FORM utk LOGIN -->
                </div>  
            </div>
        </section>


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
                </div>
            </div>
        </footer>
        <!-- end of Footer -->

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    
        <!-- PHP -->

    </body>
</html>
