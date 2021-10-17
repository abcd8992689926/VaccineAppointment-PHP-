<?php
    session_start();
?>
<html>
<head>
<title>
Test
</title>
<link rel="stylesheet" href="style.css">

</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<body>
        <?php
                if (isset($_SESSION["login"]) && $_SESSION["login"] == true):
                    header('Location:choice.php');
                else:
        ?>
        <div id="log_background">
            <div id="content">
                <form id="form_id">
                    <h2 style="text-align: center;">身分認證</h2>
                    <hr width=80% size=3 color=#5151A2>
                    <br>
                    <p><b>身分證字號</b><input type="text" placeholder="請輸入身分證號/統一證號最長10位" id="id_input" name="id_input" size="30" maxlength="10" onkeyup="value=value.toUpperCase().replace(/[^\w]/g,'')" ></p>
                    <div id="NHI_input">
                        <p><b>健保卡號</b><input type="text" placeholder="1~4" class="NHI_id_input" name="NHI_1" size="4" maxlength="4"><input type="text" placeholder="5~8" class="NHI_id_input" name="NHI_2" size="4" maxlength="4"><input type="text" placeholder="9~12" class="NHI_id_input" name="NHI_3" size="4" maxlength="4"></p>
                    </div>
                    <div id="btn_box"><a href="javascript:void(0)" onclick = check()>執行身分認證</a></div>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            //健保卡輸入自動跳下一格
            var demo=document.getElementById('NHI_input');
            input=demo.getElementsByTagName('input');
            var iNow=0;
            type   = !-[1,] ? 'onpropertychange' : 'oninput',
                limit  = 4;
            for(var i=0;i<input.length-1;i++){
                input[i].index=i;
                input[i][type]=function () {
                    iNow=this.index;
                    var that=this;
                    setTimeout(function () {
                    that.value.length>limit-1&&input[iNow+1].focus();
                    },0)
                }
            }
            //健保卡限制輸入數字
            $(".NHI_id_input").on("keypress keyup blur",function (event) {    
            $(this).val($(this).val().replace(/[^\d]/g,""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
            });
            //傳送表單
            function send_form() {
                var url = "login_check.php";
                $.post( url, $( "#form_id" ).serialize(), function ( data ) {
                    if (data=="verify"){
                        window.location.href='choice.php';  
                    }
                    else{
                        alert("輸入的資料有誤，請重新輸入");
                        $('#id_input').val('');
                        $('.NHI_id_input').val('');
                    }
                });
            }
            //驗證身分證號
            function check() {
                var id_input = document.getElementById("id_input").value;
                var ret = caltal(id_input);
                if (ret == 0 && input_checknum(id_input) == 0){
                    send_form();
                }
                else if ((10-ret)!=input_checknum(id_input)){
                    alert("身分證驗證錯誤，請重新輸入");
                    $("#id_input").val("");
                    $(".NHI_id_input").val("");
                }
                else{
                    send_form();
                }
            }
            //計算城市加權和
            function calcity(id) {
                var city = id.toString().substring(0,1);
                var ret = 0;
                switch (city) {
                    case "A":
                        ret = 1;
                        break;
                    case "B":
                        ret = 10;
                        break;
                    case "C":
                        ret = 19;
                        break;
                    case "D":
                        ret = 28;
                        break;   
                    case "E":
                        ret = 37;
                        break; 
                    case "F":
                        ret = 46;
                        break; 
                    case "G":
                        ret = 55;
                        break; 
                    case "H":
                        ret = 64;
                        break; 
                    case "I":
                        ret = 39;
                        break; 
                    case "J":
                        ret = 73;
                        break; 
                    case "K":
                        ret = 82;
                        break; 
                    case "L":
                        ret = 2;
                        break; 
                    case "M":
                        ret = 11;
                        break; 
                    case "N":
                        ret = 20;
                        break; 
                    case "O":
                        ret = 48;
                        break; 
                    case "P":
                        ret = 29;
                        break; 
                    case "Q":
                        ret = 38;
                        break; 
                    case "R":
                        ret = 47;
                        break; 
                    case "S":
                        ret = 56;
                        break; 
                    case "T":
                        ret = 65;
                        break; 
                    case "U":
                        ret = 74;
                        break; 
                    case "V":
                        ret = 83;
                        break; 
                    case "W":
                        ret = 21;
                        break; 
                    case "X":
                        ret = 3;
                        break; 
                    case "Y":
                        ret = 12;
                        break; 
                    case "Z":
                        ret = 30;
                        break; 
                    default:
                        ret = 0;
                        break;
                }
                return ret;
            }
            //計算流水號加權和
            function calmid(id) {
                var weighted = 8;
                var tal = 0;
                for (i = 1 ;i < 9 ;i++){
                    tal += (id.toString().substring(i,i+1)) * weighted;
                    weighted--;
                }
                return tal;
            }
            //輸出檢查碼
            function input_checknum(id) {
                var checknum = id.toString().substring(9,10);
                return checknum;
            }
            //計算所有總和並取餘數
            function caltal(id) {
                var ret = calcity(id)+calmid(id);
                ret = ret % 10;
                return ret;
            }
        </script>
        <?php endif; ?>
</body>
</html>