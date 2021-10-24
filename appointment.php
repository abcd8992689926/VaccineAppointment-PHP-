<?php
    session_start();
?>
<html>
<head>
<title>疫苗預約平台</title>
<link rel="stylesheet" href="style.css">

</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<body>
        <?php
            if (isset($_SESSION["login"]) && $_SESSION["login"] == true):
                
            
        ?>
        <div id="log_background">
            <div id="content">
                <h2 style="text-align: center;">預約登記</h2>
                <hr width=80% size=3 color=#5151A2>
            </div>
        </div>
        <?php
            else:
                header('Location:index.php');
            endif;
        ?>
</body>
</html>