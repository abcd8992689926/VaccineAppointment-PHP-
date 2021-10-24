<?php
    session_start();
    $id = $_SESSION["id"];
    $name = $_SESSION["name"];
?>
<html>
<head>
<title>疫苗預約平台</title>
<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="jquery.twzipcode.js"></script>
<style>
    .addr-county{
        font-size:30pt;
        border-radius:12px;
        width:120pt;
    }
    .addr-district{
        font-size:30pt;
        border-radius:12px;
        width:120pt;
        margin-left:10pt;
    }
    .addr-zip{
        font-size:30pt;
        border-radius:12px;
        display:none;
    }
    #twzipcode{
        float: left;
        width:600pt;
        position: relative;
        top:14pt;
    }
    #left_content{
        width:300pt;
        float: left;
    }
    #right_content{
        width:600pt;
        float: left;
    }
    #id_input{
        left:-100pt;
        top:5pt;
    }
    .vaccine_checkbox{
        width: 35px;
        height: 35px;
    }
    #vaccine_box{
        position: relative;
        top:50pt;
        left:0pt;
    }
    #log_background{
        height: 600pt;
        top:10%;
    }
    #btn_box{
        top:50pt;
        left:-150pt;
        color: black;
    }
</style>
</head>
<body>
<div id="log_background">
            <div id="content">
                    <h2 style="text-align: center;">意願登記</h2>
                    <hr width=80% size=3 color=#5151A2>
                <div id="left_content">
                    <p><b>身分證字號</b></p>
                    <p><b>姓名</b></p>
                    <p><b>手機號碼</b></p>
                    <p><b>接種區域</b></p>
                    <p><b>疫苗種類</b></p>
                </div>
                <div id="right_content">
                    <form id="form_register" name="form_register">
                        <?php echo "<p><input type='text' id='id_input' name='id_input' size='28' value=$id readonly='true'></p>";?>
                        <?php echo "<p><input type='text' id='id_input' class='name' name='name' size='28' value=$name readonly='true'></p>";?>
                        <p><input type="text" class="phone_num" id="id_input" name="phone_num" size="28" maxlength="10"></p>
                        <div id="twzipcode"></div>
                        <div id="vaccine_box">
                            <input type="checkbox" class="vaccine_checkbox" id="Modena" name="Modena" value="1"><label for="Modena"><b> 莫德納</b></label>
                            <input type="checkbox" class="vaccine_checkbox" id="BNT" name="BNT" value="1"><label for="BNT"><b> BNT</b></label>
                            <input type="checkbox" class="vaccine_checkbox" id="AZ" name="AZ" value="1"><label for="AZ"><b> AZ</b></label>
                            <input type="checkbox" class="vaccine_checkbox" id="MVC" name="MVC" value="1"><label for="MVC"><b> 高端</b></label>
                        </div>
                    </form>
                    <div id="btn_box"><a href="javascript:void(0)" onclick="send_register()"><b>登記</b></a></div>
                </div>
                
            </div>
</div>
    
<script>
$("#twzipcode").twzipcode({
    'countySel': '台北市',
    //'districtSel': '那瑪夏區',
    'css': [
        'addr-county', //縣市
        'addr-district',  // 鄉鎮市區
        'addr-zip' // 郵遞區號
    ]
});
//傳送register表單
function send_register() {
    change_checkbox_value();
    var url = "insert_register.php";
        $.post( url, $( "#form_register" ).serialize(), function ( data ) {
            if(data=="have_null"){
                clear_checkbox();
                alert("有欄位尚未輸入，請重新檢查");
            }
            else{
                alert("登記成功");
                window.location.href='choice.php';
            }
    });
}
//更改checkbox value
function change_checkbox_value() {
    var checkboxs = document.getElementsByClassName("vaccine_checkbox");
    for (var i = 0; i < checkboxs.length; i++ ) {
        if(checkboxs[i].checked == false){
            checkboxs[i].checked = true;
            checkboxs[i].value = 0;
        }
        else{
            checkboxs[i].value = 1;
        }
    }
}
//取消選取所有checkbox
function clear_checkbox() {
    var checkboxs = document.getElementsByClassName("vaccine_checkbox");
    for (var i = 0; i < checkboxs.length; i++ ) {
        checkboxs[i].checked = false;
    }
}
//手機號碼限制輸入數字
$(".phone_num").on("keypress keyup blur",function (event) {    
    $(this).val($(this).val().replace(/[^\d]/g,""));
    if ((event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});
//姓名限制輸入中文
/*$(".name").on("keypress keyup blur",function (event) {    
    $(this).val($(this).val().replace(/[^\u4E00-\u9FA5]/g,""));
    if ((event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});*/
</script>
</body>
</html>