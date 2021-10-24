<?php
    session_start();
    $id = $_SESSION["id"];
?>
<html>
<head>
<title>疫苗預約平台</title>
<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="jquery.twzipcode.js"></script>
<style>
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
    #btn_box{
        top:50pt;
        left:-150pt;
        color: black;
    }
    .choice-month{
        font-size:30pt;
        border-radius:12px;
        width:90pt;
    }
    .choice-day{
        font-size:30pt;
        border-radius:12px;
        width:90pt;
    }
    .choice-time{
        font-size:30pt;
        border-radius:12px;
        width:90pt;
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
                    <p><b>日期</b></p>
                    <p><b>施打地點</b></p>
                </div>
                <div id="right_content">
                    <form id="form_register" name="form_register">
                        <?php echo "<p><input type='text' id='id_input' name='id_input' size='28' value=$id readonly='true'></p>";?>
                        <select name="month" id="month" class="choice-month">
                            <option value>月份</option>
                            <option value="11">11</option>
                        </select>
                        <select name="day" class="choice-day">
                            <option value>日期</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>     
                        <select name="time" class="choice-time">
                            <option value>時間</option>
                            <option value="11">11</option>
                        </select> 
                    </form>
                    <div id="btn_box"><a href="javascript:void(0)" onclick="send_register()"><b>預約</b></a></div>
                </div>
                
            </div>
</div>
<script>
$("#month").append("<option value=' value '> 1333 </option>");
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
</script>
</body>
</html>