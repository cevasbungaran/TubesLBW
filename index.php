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
            
        </div>
    </body>
</html>