
<html >
  <head>
    <meta charset="UTF-8">
    <title>挂失or重新开户</title> 
    <link rel="stylesheet" href="http://localhost/yyl/css/normalize.css">
   
<script type="text/javascript">
  function jump(){
    var obj=document.getElementById("typeOfAccount");
    if(obj.value==="person")
      window.open('http://localhost/SeProject/index.php/Stockaccount/Stockaccount/indexPerson');
    else
      window.open('http://localhost/SeProject/index.php/Stockaccount/Stockaccount/indexLegal');
    }

</script> 
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
  max-width: 450px;
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

  
  </head>
 
  <body>
 

  <div class="wrapper">

    <?PHP echo form_open('Stockaccount/stockaccount/reportLoss','class="login"')?> 
   <!-- <form action="showsuccess" method="post">-->
<<<<<<< HEAD
      <p class="title">挂失</p>
=======
      <p class="title">挂失 or 重新开户</p>
>>>>>>> 7b0c205d1f6059cbb66d9b3c9ae3158c94cfeb02
      
      账户类型：
      <select type="input" name="typeOfAccount" id="typeOfAccount">
      <option value="person"> 个人账户 </option>
      <option value="legalman">法人账户</option>
      </select>
      <br><br>
      
      证件号：<input type="input" name="idNumber" placeholder="身份证号/法人注册登记号" />   
      <span class="error">* </span>
     

      <button type="submit" >
        <i class="spinner"></i>
        挂失
      </button>

      <button onclick="jump()"> 
        <i class="spinner"></i>
        重新开户
      </button>  

    </form>
    </p>
  </div>
     
  </body>
</html>
