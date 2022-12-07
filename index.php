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
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="#">FTIS UNPAR</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Hitung Biaya per SKS</a>
            </li>   
            </ul>
        </div>  
        </nav>
        <br>
        <form method = "POST">
            <div class="dropdown">
                <select type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="color:white;">
                    <div class="dropdown-menu">
                        <?php
                        $csv = fopen("biaya.csv", "r");
                        $start_row = 0; //define start row
                        $i = 0; //define row count flag
                        $arr = array();
                        while (($row = fgetcsv($csv)) !== FALSE) {
                            $arr[] = $row;
                        }
                        fclose($csv);
                        while($i < sizeof($arr)){
                            echo  '<option value = "',$i,'"class="dropdown-item" style="color:black; background-color:white; border; 1px black">',  $arr[$i][0], '</option>';
                            $i++;
                        }
                        
                        ?>
                    </div>    
                </select>

                <div class="container">
                    <?php
                    if(file_exists('prasyarat.json')) {
                        $filename = 'prasyarat.json';
                        $data = file_get_contents($filename); //data read from json file
                        // print_r($data);
                        $users = json_decode($data);  //decode a data
                    
                        // print_r($users); //array format data printing
                        $message = "<h3 class='text-success'>Daftar Mata Kuliah</h3>";
                    }
                    else {
                        $message = "<h3 class='text-danger'>JSON file Not found</h3>";
                    }
                    // // Read the JSON file 
                    // $json = file_get_contents('prasyarat.json');
                        
                    // // Decode the JSON file
                    // $json_data = json_decode($json,true);
                        
                    // // Display data
                    // print_r($json);
                    ?>
                    <div class="table-container">
                        <?php
                                if(isset($message))
                                {
                                    echo $message;

                                ?>
                            <h2> Semester 1</h2>
                            <table id="tbstyle" >
                                <tbody>
                                    <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <?php if($user->semester == 1){?>
                                        <td> <?= $user->kode; ?> </td>
                                        <td> <?= $user->nama; ?> </td>
                                        <td> <?= $user->sks; ?> </td>
                                        <td> <input type="checkbox" id="check" name="<?= $user->name?>" value= "<?= $user->nama;?>"> </td>
                                    </tr>
                                    <?php }}?>
                                </tbody>
                            </table>
                            <h2> Semester 2</h2>
                            <table id="tbstyle" >
                                <tbody>
                                    <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <?php if($user->semester == 2){?>
                                        <td> <?= $user->kode; ?> </td>
                                        <td> <?= $user->nama; ?> </td>
                                        <td> <?= $user->sks; ?> </td>
                                        <td> <input type="checkbox" id="check" name="<?= $user->name?>" value= "<?= $user->nama;?>"> </td>
                                    </tr>
                                    <?php }}?>
                                </tbody>
                            </table>
                            <h2> Semester 3</h2>
                            <table id="tbstyle" >
                                <tbody>
                                    <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <?php if($user->semester == 3){?>
                                        <td> <?= $user->kode; ?> </td>
                                        <td> <?= $user->nama; ?> </td>
                                        <td> <?= $user->sks; ?> </td>
                                        <td> <input type="checkbox" id="check" name="<?= $user->name?>" value= "<?= $user->nama;?>"> </td>
                                    </tr>
                                    <?php }}?>
                                </tbody>
                            </table>
                            <h2> Semester 4</h2>
                            <table id="tbstyle" >
                                <tbody>
                                    <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <?php if($user->semester == 4){?>
                                        <td> <?= $user->kode; ?> </td>
                                        <td> <?= $user->nama; ?> </td>
                                        <td> <?= $user->sks; ?> </td>
                                        <td> <input type="checkbox" id="check" name="<?= $user->name?>" value= "<?= $user->nama;?>"> </td>
                                    </tr>
                                    <?php }}?>
                                </tbody>
                            </table>
                            <h2> Semester 5</h2>
                            <table id="tbstyle" >
                                <tbody>
                                    <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <?php if($user->semester == 5){?>
                                        <td> <?= $user->kode; ?> </td>
                                        <td> <?= $user->nama; ?> </td>
                                        <td> <?= $user->sks; ?> </td>
                                        <td> <input type="checkbox" id="check" name="<?= $user->name?>" value= "<?= $user->nama;?>"> </td>
                                    </tr>
                                    <?php }}?>
                                </tbody>
                            </table>
                            <h2> Semester 6</h2>
                            <table id="tbstyle" >
                                <tbody>
                                    <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <?php if($user->semester == 6){?>
                                        <td> <?= $user->kode; ?> </td>
                                        <td> <?= $user->nama; ?> </td>
                                        <td> <?= $user->sks; ?> </td>
                                        <td> <input type="checkbox" id="check" name="<?= $user->name?>" value= "<?= $user->nama;?>"> </td>
                                    </tr>
                                    <?php }}?>
                                </tbody>
                            </table>
                            <h2> Semester 7</h2>
                            <table id="tbstyle" >
                                <tbody>
                                    <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <?php if($user->semester == 7){?>
                                        <td> <?= $user->kode; ?> </td>
                                        <td> <?= $user->nama; ?> </td>
                                        <td> <?= $user->sks; ?> </td>
                                        <td> <input type="checkbox" id="check" name="<?= $user->name?>" value= "<?= $user->nama;?>"> </td>
                                    </tr>
                                    <?php }}?>
                                </tbody>
                            </table>
                            <h2> Semester 8</h2>
                            <table id="tbstyle" >
                                <tbody>
                                    <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <?php if($user->semester == 8){?>
                                        <td> <?= $user->kode; ?> </td>
                                        <td> <?= $user->nama; ?> </td>
                                        <td> <?= $user->sks; ?> </td>
                                        <td> <input type="checkbox" id="check" name="<?= $user->name?>" value= "<?= $user->nama;?>"> </td>
                                    </tr>
                                    <?php }}
                                }
                                else
                                    echo $message;
                                ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-info" value="Submit Button">
        </form>


        
    </body>
</html>