<!DOCTYPE html>
<html>
    <head>
        <title>Hitung biaya SKS</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

        <style>
            table{
                width: 100%;
            }
            th, td, tr{
                padding: 15px;
            }
        </style>
    </head>
    <script>
        var total=0;
        function checker(i){

            var sks=document.getElementById('check'+i).value;
            
            total=total+sks;           
            console.log(total)
        }
    </script>

    <body>
        <!-- navbar -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="#">FTIS UNPAR</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Hitung Biaya SKS per Semester</a>
                </li>   
                </ul>
            </div>  
        </nav>
        <br>

        <!-- form angkatan dan semester -->
        <form method="POST">
            <div class="dropdown">
                <!-- dropdown angkatan -->
                <label for="angkatan">Pilih Angkatan:</label>
                <select type="button" name="dropAngkatan" id="dropAngkatan" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="color:white;">
                    <div class="dropdown-menu">
                        <?php
                            $csv = fopen("biaya.csv", "r"); // baca file csv
                            $k = 0; // counter untuk loop
                            $arr = array();
                            while (($row = fgetcsv($csv)) !== FALSE) {
                                $arr[] = $row;
                            }
                            fclose($csv);

                            while($k < sizeof($arr)){
                                // ambil dari baris ke 1
                                if ($k > 0) {
                                    echo  '<option value = "',$arr[$k][0],'"class="dropdown-item" style="color:black; background-color:white; border; 1px black">',  $arr[$k][0], '</option>';
                                }
                                $k++;
                            }
                        ?>
                    </div>    
                </select>
                
                <!-- dropdown semester -->
                <label for="semester">Pilih Semester:</label>
                <select type="button" name="dropSemester" id="dropSemester" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="color:white;">
                    <div class="dropdown-menu">
                        <?php
                            $i = 1; // counter untuk loop
                            while($i <= 8) {
                                echo  '<option value = "',$i,'"class="dropdown-item" style="color:black; background-color:white; border; 1px black">', $i,'</option>';
                                $i++;
                            }
                        ?>
                    </div>    
                </select>
            <div>
            
            <!-- button filter -->
            <input type="submit" value="Filter">
            <br>
        </form>
        <?php
            // check apakah form sudah tersubmit
            if (isset($_POST['dropAngkatan']) && isset($_POST['dropSemester'])) {
                $selectedArrAngkatan = $_POST['dropAngkatan']; // nyimpen index ke dari tahun angkatan yg dipilih
                $selectedArrSemester = $_POST['dropSemester']; // menyimpan index dari semester yang dipilih

                // baca file csv
                 // menyimpan biaya sks sesuai angkatan yang dipilih
                // echo "Angkatan yang dipilih: ". $arr[$selectedArrAngkatan][0]. "<br>"; // display angkatan yang dipilih
                // echo "Biaya per SKS: ". $biayaSKS. "<br>"; // display biaya sks berdasarkan angkatan yang dipilih
                // echo "Semester: ". $selectedArrSemester. "<br>"; // display semester yang dipilih
            }else{
                $selectedArrSemester = "Silahkan Pilih Semester dan Angkatan Anda";
            }
        ?>

        <!-- form mata kuliah -->
        <form method="POST">
            <div class="container">
                <?php
                    // check apakah file prasayat.json tersedia
                    if(file_exists('prasyarat.json')) {
                        $filename = 'prasyarat.json';
                        $data = file_get_contents($filename); // baca data dari json file
                        $users = json_decode($data);  // decode data json file
                        $message = "<h3 class='text-success'>Daftar Mata Kuliah</h3>";
                    }
                    else {
                        $message = "<h3 class='text-danger'>JSON file Not found</h3>";
                    }
                ?>

                <h2> Semester <?php echo $selectedArrSemester?> </h2>
                <table id="tbstyle" >
                    <thead>
                        <tr>
                            <th> Kode </th>
                            <th> Nama Mata Kuliah </th>
                            <th> Bobot SKS </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalSKS = 0;
                        $i=0;
                        foreach ($users as $user) { ?>
                            <tr>
                                <?php if($user->semester == $selectedArrSemester){?>
                                <td><?php echo $user->kode; ?> </td>
                                <td> <?php echo $user->nama; ?> </td>
                                <td> <?php echo $user->sks; ?> </td>
                                <td> <input type="checkbox" id="check<?php echo $i;?>" onclick="checker(<?php echo $i;?>)" name="cek.<?php echo $user->kode;?>" value= " <?php echo $user->sks;?> "> </td>
                            </tr>
                                <!-- <?php 
                                $i++;
                                    //$totalSKS += $user->sks;
                                ?> -->
                                <?php }}?>
                    </tbody>
                </table>
                <br>
                
                <!-- tombol submit checkbox -->
                <input type="submit" name="submitMatkul" value="submit"> <br>

                <!-- nanti dipindah di isset check kalo udh jalan checkboxnya-->
                <?php
                $biayaSKS = 0;
                if(isset($_POST['dropAngkatan'])){
                    $selectedArrAngkatan = $_POST['dropAngkatan'];
                    $csv = fopen("biaya.csv", "r");
                    $arr = array();
                    while (($row = fgetcsv($csv)) !== FALSE) {
                        $arr[] = $row;
                        
                    }
                    fclose($csv);
                    
                    for($a = 0; $a < count($arr);$a++){
                        if($arr[$a][0] == $selectedArrAngkatan){
                            $biayaSKS = $arr[$a][1];
                        }
                    }
                }
                

                

                $totalBiayaSKS = 0;
                //$totalSKS = 0;
                $selectMatkul = array();
                    // check jika tombol Submit ditekan
                    if (isset($_POST['submitMatkul'])) {
                        if(isset($_POST["cek.$user->kode"])){
                            $selectMatkul[] = $_POST["cek.$user->kode"];

                        }
                            print_r($selectMatkul);
                            $totalBiayaSKS = $totalBiayaSKS + $biayaSKS * 20;
                            echo $totalSKS;
                           
                            echo "mata kuliah yang dipilih: ". $user->nama . "<br>";
                            echo "Total sks yang diambil adalah: <div id=sksdiv></div> <br>";
                            echo "<script>function inject(){
                                document.getElementById(`sksdiv`).innerHTML=total;
                            }inject()</script>";
                            echo "Total pembayaran SKS semseter ini adalah: Rp ". $totalBiayaSKS. "<br>";
                    }
                ?>
            </div>
        </form>

    </body>




</html>