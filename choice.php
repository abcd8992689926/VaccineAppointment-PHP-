<?php
    session_start();
    $register = $_SESSION["register"];
?>
<html>
<head>
<title>疫苗預約平台</title>
<link rel="stylesheet" href="style.css">
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php
        if (isset($_SESSION["login"]) && $_SESSION["login"] == true):
?>
<body>
        <div class="btn" id=left_btn onclick = appointment()><b>預約</b></div>
        <div class="btn" id=right_btn><b>查詢</b></div>
        <div><a href="javascript:void(0)" onclick = logout()><b>登出</b></div>
</body>
<script type="text/javascript">
        //登出系統
        function logout() {
                var url = "logout.php";
                $.post( url, function ( data ) {
                        window.location.href = "index.php";
                });
        }
        //轉址至register
        function register() {
                window.location.href = "register.php";
        }
        //轉址至appointment
        function appointment() {
                window.location.href = "appointment.php";
        }
</script>
<?php
        if (!$register):
?>
<script type="text/javascript">
        //判定為意願登記或預約
                var left_btn = document.getElementById("left_btn");
                left_btn.innerHTML="<b>意願登記</b>";
                left_btn.onclick = register;
</script>
<?php
        endif;
?>
<?php
        else:
                header('Location:index.php');
        endif;
?>
</html>