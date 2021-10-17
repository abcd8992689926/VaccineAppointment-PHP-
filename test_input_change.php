<html>
<head><thtle></title></head>
<body>
<input type="text" placeholder="請輸入身分證號/統一證號最長10位" id="id_input" size="30" maxlength="10" onkeyup="value=value.toUpperCase().replace(/[^\w]/g,'')" >
<div id="btn_box" onclick=check()><a href="#">執行身分認證</a></div>
    <?php

    ?>
    <script>
        function check() {
            var id_input = document.getElementById("id_input").value;
            var ret = caltal(id_input);
            if (ret == 0 && input_checknum(id_input) == 0){
                alert("身分證驗證成功");
            }
            else if ((10-ret)!=input_checknum(id_input)){
                alert("身分證驗證錯誤，請重新輸入");
            }
            else{
                alert("身分證驗證成功");
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
                    alert("error");
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
</body>
</html>