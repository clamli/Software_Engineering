
<html >
  <head>
    <meta charset="UTF-8">
    <title>开立个人账户</title> 
    <link rel="stylesheet" href="http://localhost/yyl/css/normalize.css">
   
<style>      
body {
  font-family: "Open Sans", sans-serif;
  height: 100vh;
  background: url("http://i.imgur.com/HgflTDf.jpg") 50% fixed;
  background-size: cover;
}

@keyframes spinner {
  0% {
    transform: rotateZ(0deg);
  }
  100% {
    transform: rotateZ(359deg);
  }
}
* {
  box-sizing: border-box;
}

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
  background: rgba(4, 40, 68, 0.85);
}

.login {
  border-radius: 2px 2px 5px 5px;
  padding: 10px 20px 20px 20px;
  width: 90%;
  max-width: 600px;
  background: #ffffff;
  position: relative;
  padding-bottom: 40px;
  box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.3);
}

.login input {
  
  padding: 8px 5px;
  margin-bottom: 10px;
  width: 60%;
  border: 1px solid #ddd;
  margin-left: 10px;
  transition: border-width 0.2s ease;
  border-radius: 2px;
  color: #ccc;
}

.login input:focus {
  outline: none;
  color: #444;
  border-color: #2196F3;
  border-left-width: 35px;
}

.login a {
  font-size: 0.8em;
  color: #2196F3;
  text-decoration: none;
}
.login .title {
  color: #444;
  font-size: 1.2em;
  font-weight: bold;
  margin: 10px 0 30px 0;
  border-bottom: 1px solid #eee;
  padding-bottom: 20px;
}
.login button {
  width: 30%;
  height: 80%;
  padding: 8px 8px;
  background: #2196F3;
  color: #fff;
  margin-bottom: 5px;
  border: none;
  margin-top: 20px;
  margin-left: 45px;
  max-height: 50px;
  border: 0px solid rgba(0, 0, 0, 0.1);
  border-radius: 0 0 2px 2px;
  transform: rotateZ(0deg);
  transition: all 0.1s ease-out;
  border-bottom-width: 7px;
}
.login button .spinner {
  display: block;
  width: 40px;
  height: 40px;
  position: absolute;
  border: 4px solid #ffffff;
  border-top-color: rgba(255, 255, 255, 0.3);
  border-radius: 100%;
  left: 50%;
  top: 0;
  opacity: 0;
  margin-left: -20px;
  margin-top: -20px;
  animation: spinner 0.6s infinite linear;
  transition: top 0.3s 0.3s ease, opacity 0.3s 0.3s ease, border-radius 0.3s ease;
  box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.2);
}
.login.ok button {
  background-color: #8bc34a;
}
.login.ok button .spinner {
  border-radius: 0;
  border-top-color: transparent;
  border-right-color: transparent;
  height: 20px;
  animation: none;
  transform: rotateZ(-45deg);
}
.error {color: #ff0000;}
</style> 

<script type="text/javascript">
  function jump(){
    window.Open(success.php);
    alert(window.location);
    }

</script>  
  </head>
 
  <body>
 

  <div class="wrapper">

    <?PHP echo form_open('Stockaccount/Stockaccount/indexPerson','class="login"')?> 
   <!-- <form action="showsuccess" method="post">-->
      <p class="title">开立个人账户</p>
      
      <table border="0" cellpadding="0" cellspactin="0" width="650px">
      <tr>
        <td width="20%">个人股票账户号码：<td/>
        <td width="80%"><input type="input" name="accountId" placeholder="" /><br>  <td/>
      <tr/>
      <tr>
        <td>账户密码：<td/>
        <td><input type="password" name="accPassword" placeholder="" /> <br><td/>
      <tr/>
      <tr>
        <td>登记日期：<td/>
        <td><input type="date" name="rgstDate" placeholder="格式如17-05-04" /> <br><td/>
      <tr/>
      <tr>
        <td>本人姓名：<td/>
        <td><input type="input" name="userName" placeholder="" /> <br><td/>
      <tr/>
      <tr>
        <td>本人性别：<td/>
        <td><input type="input" name="userGender" placeholder="" /> <br><td/>
      <tr/>
      <tr>
        <td>本人身份证号码：<td/>
        <td><input type="input" name="idNumber" placeholder="" /> <br><td/>
      <tr/>
      <tr>
        <td>本人家庭地址：<td/>
        <td><input type="input" name="houAddress" placeholder="" /> <br><td/>
      <tr/>
      <tr>
        <td>本人职业：<td/>
        <td><input type="input" name="perOccupation" placeholder="" /> <br><td/>
      <tr/>
      <tr>
        <td>本人学历：<td/>
        <td><input type="input" name="perEducation" placeholder="" /> <br><td/>
      <tr/>
      <tr>
        <td width="30%">本人工作单位：<td/>
        <td><input type="input" name="workPlace" placeholder="" /> <br><td/>
      <tr/>
      <tr>
        <td width="30%">本人联系电话：<td/>
        <td><input type="input" name="phoneNumber" placeholder="" /> <br><td/>
      <tr/>
      <tr>
        <td width="30%">代办人身份证：<td/>
        <td><input type="input" name="subsIdNumber" placeholder="" /> <td/>
      <tr/>
      <table/>
      <div align="center"><button type="submit" >
        <i class="spinner"></i>
        开户
      </button></div>

    </form>
    </p>
  </div>
     
  </body>
</html>
