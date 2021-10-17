<?php
    session_start();
    $register = $_SESSION["register"];
?>
<html>
<head>
<title>
Test
</title>
<link rel="stylesheet" href="style.css">
</head>
<script src="http://apps.bdimg.com/libs/jquery/1.8.3/jquery.min.js"></script>

<?php
        if (isset($_SESSION["login"]) && $_SESSION["login"] == true):
?>
<body>
        <div class="btn" id=left_btn><b>預約</b></div>
        <div class="btn" id=right_btn><b>查詢</b></div>
        <div><a href="javascript:void(0)" onclick = logout()><b>登出</b></div>
</body>
<?php
        if (!$register):
?>
<script type="text/javascript">
                document.getElementById("left_btn").innerHTML="<b>意願登記</b>";
</script>
<?php
        endif;
?>
<script type="text/javascript">
        function logout() {
                var url = "logout.php";
                $.post( url, function ( data ) {
                        window.location.href = "index.php";
                });
        }
</script>
<?php
        else:
                header('Location:index.php');
        endif;
?>
</html>