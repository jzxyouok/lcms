<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset="utf-8" />
    <title>登录</title>
  </head>
  <body>
    <div id="login_bg" class="login_box">
      <div class="login_iptbox">
        <form action="/backend/signin" method="post" name="myform">
          <label>用户名：</label><input name="username" type="text" class="ipt" value="" />
          <label>密码：</label><input name="password" type="password" class="ipt" value="" />
          <input name="dosubmit" value="登录" type="submit" class="login_tj_btn" />
        </form>
      </div>
    </div>
  </body>
</html>
