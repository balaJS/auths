<!DOCTYPE html>
<html>
<head>
    <title>Session based authentication</title>
</head>
<body>

<h2>Login</h2>

<form method="post" action="../web-interface.php" id="login-form">
  <label for="user_email">Email:</label><br>
  <input type="text" id="user_email" name="user_email"><br>
  <label for="user_pass">Password:</label><br>
  <input type="password" id="user_pass" name="user_pass"><br><br>
  <input type="submit" value="Submit">
</form>

<script src="2.5.3-crypto-md5.js"></script>
<script>
    document.getElementById('login-form').addEventListener('submit', function() {
        var $password = document.getElementById('user_pass');
        var passhash = Crypto.MD5($password.value).toString();
        $password.value = passhash;
    });
</script>
</body>
</html>
