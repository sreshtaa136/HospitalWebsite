<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Sai Sreshtaa Turaga">
        <title><?php echo $pageTitle ; ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <?php 
            $allStyles = "<link rel='stylesheet' type='text/css' href='css/all-styles.css'>";
            $script = "";
            switch($pageTitle) {
                case 'Russel Street Medical':
                    $allStyles .= "\n<link rel='stylesheet' type='text/css' href='css/home-style.css'>";
                    $script = "<script src='js/script-all.js'></script>".
                            "\n<script src='js/script-home.js'></script>";
                    break;
                case 'Booking':
                    $allStyles .= "\n<link rel='stylesheet' type='text/css' href='css/booking-style.css'>";
                    $script = "<script src='js/script-all.js'></script>".
                            "\n<script src='js/script-booking.js'></script>";
                    break;
                case 'Administration':
                    $allStyles .= "\n<link rel='stylesheet' type='text/css' href='css/admin-style.css'>";
                    $script = "<script src='js/script-all.js'></script>";
                    break;
            }
            echo $allStyles;
            echo $script;
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
