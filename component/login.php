
<?php
  if(isset($_POST['btnLogin'])) loginActionClass::login();
?>

<div class="text-center mt-5">
  <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
      <label for="uname4">Username</label>
      <input type="text" placeholder="Enter Username" name="username" required="required" />
      <br>
      <br>
      <label for="psw4">Password</label>
      <input type="password" placeholder="Enter Password" name="password" required="required" />
      <br>
      <br>
      <button class="btn btn-sm btn-info" name="btnLogin" type="submit">เข้าสู่ระบบ</button>

  </form>
</div>