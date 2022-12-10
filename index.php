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
                            $i = 0; // counter untuk loop
                            $arr = array();
                            while (($row = fgetcsv($csv)) !== FALSE) {
                                $arr[] = $row;
                            }
                            fclose($csv);

                            while($i < sizeof($arr)){
                                // ambil dari baris ke 1
                                if ($i > 0) {
                                    echo  '<option value = "',$i,'"class="dropdown-item" style="color:black; background-color:white; border; 1px black">',  $arr[$i][0], '</option>';
                                }
                                $i++;
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
                $csv = fopen("biaya.csv", "r");
                $arr = array();
                while (($row = fgetcsv($csv)) !== FALSE) {
                    $arr[] = $row;
                    
                }
                fclose($csv);

                $biayaSKS = $arr[$selectedArrAngkatan][1]; // menyimpan biaya sks sesuai angkatan yang dipilih
                // echo "Angkatan yang dipilih: ". $arr[$selectedArrAngkatan][0]. "<br>"; // display angkatan yang dipilih
                // echo "Biaya per SKS: ". $biayaSKS. "<br>"; // display biaya sks berdasarkan angkatan yang dipilih
                // echo "Semester: ". $selectedArrSemester. "<br>"; // display semester yang dipilih
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

                    // check jika tombol Submit ditekan
                    if (isset($_POST['submitMatkul'])) {
                        // Iterate over the categories and check if they are selected
                        foreach ($users as $user) {
                            // check apakah checkbox telah dipilih
                            if (isset($_POST['check'])) {
                                // Print the selected category
                                echo "mata kuliah yang dipilih: ". $user->nama . "<br>";
                            }
                        }
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
                        <?php $totalSKS = 0;
                        foreach ($users as $user) { ?>
                            <tr>
                                <?php if($user->semester == $selectedArrSemester){?>
                                <td><?php echo $user->kode; ?> </td>
                                <td> <?php echo $user->nama; ?> </td>
                                <td> <?php echo $user->sks; ?> </td>
                                <td> <input type="checkbox" id="check" name="check" value= "check"> </td>
                            </tr>
                                <?php 
                                    $totalSKS += $user->sks;
                                ?>
                                <?php }}?>
                    </tbody>
                </table>
                <br>
                
                <!-- tombol submit checkbox -->
                <input type="submit" name="submitMatkul" value="submit"> <br>

                <!-- nanti dipindah di isset check kalo udh jalan checkboxnya-->
                <?php
                    echo "Total sks yang diambil adalah: ". $totalSKS. "<br>";
                    $totalBiayaSKS = $biayaSKS * $totalSKS;
                    echo "Total pembayaran SKS semester ". $selectedArrSemester. " adalah: Rp ". $totalBiayaSKS. "<br>";
                ?>
            </div>
        </form>

    </body>
</html>