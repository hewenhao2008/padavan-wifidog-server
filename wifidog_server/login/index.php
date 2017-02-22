<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
		<title>Padavan - 网络登录</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />			
        <?php
             @$gw_address = $_REQUEST['gw_address'];
             @$gw_port = $_REQUEST['gw_port'];
             if(empty($gw_address) || empty($gw_port)){
                die("错误的请求");
             }
             include("../conn.php");
             session_start(10800);
             if (!empty(@$_SESSION['loginname'])) {
				 header("Location:../portal/index.php");
				 }
        ?>		
        <link href="../css/amazeui.min.css" rel="stylesheet" type="text/css">
		<link href="../css/main.css" rel="stylesheet" type="text/css">			
    </head>
	
    <body>
	
		<div class="header am-topbar-inverse">
		  <div class="am-g">
			<h1>Padavan - 认证系统</h1>		  
			<p><img class="am-radius" alt="150*71" src="../images/pdcn.png" width="150" height="71" /></p>
		  </div>
		  <hr />
		</div>
		
        <div class="am-g">
            <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
                <h2>登录网络</h2>
                <form method="post" class="am-form">
                    <?php
                        if (isset($_POST['sub'])) {
                            if (!empty($_POST['us_name']) && !empty($_POST['us_pass'])) {
                                $username=mysqli_real_escape_string($conn,$_POST['us_name']);
                                $password=mysqli_real_escape_string($conn,$_POST['us_pass']);
                                $sql="select * from users where userid='{$username}'";
                                $res=mysqli_query($conn,$sql);
                                if (mysqli_num_rows($res)>0) {
                                    $row=mysqli_fetch_array($res);
                                    if ($password==$row['userpass']) {
                                        echo "<span style='color:#666;'>登录成功</span><br>";
                                        $token = md5(uniqid());                                       
                                        $_SESSION['loginname']=$username;
                                        $_SESSION['loginurl']=@$_GET['url'];
                                        $sql="update users set usertoken='{$token}' where userid='{$username}'";
                                        mysqli_query($conn,$sql);
                                        $gw_address = $_REQUEST['gw_address'];
                                        $gw_port = $_REQUEST['gw_port'];
                                        $url="http://".$gw_address.":".$gw_port."/wifidog/auth?token=".$token;
                                        $_SESSION['loginurl1']=$url;
                                        echo "<meta http-equiv='refresh' content='0.1;../'>";
                                    }
                                    else
                                    {
                                        echo "<span style='color:#666;'>密码错误</span><br>";
                                    }
                                }
                                else
                                {
                                    echo "<span style='color:#666;'>帐号错误</span><br>";
                                }
                            }
                            else
                            {
                                echo "<span style='color:#666;'>请输入帐号或密码</span><br>";
                            }
                        }
                    ?>
						  <label for="text">帐号:</label> 
						  <input type="text" name="us_name" placeholder="输入你的帐号">
						  <br>
						  <label for="password">密码:</label>
						  <input input type="password" name="us_pass" placeholder="输入你的密码">
						  <br>
						  <div class="am-cf">
						  <button type="submit" name="sub" class="am-btn am-btn-primary am-btn-sm am-fr">登录</button>
						  </div>
						  
						<hr>
						<p>© 2016 Padavan Licensed under MIT license.</p>						
					</div>
                </form>
            </div>
			
    </body>
</html>


