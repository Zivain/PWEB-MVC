<?php
$error = $_GET['err'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
html, body { height:100%; font-family:'Poppins',sans-serif; }
body {
    display:flex;
    justify-content:center;
    align-items:center;
    background: linear-gradient(180deg, #0a0f1a, #1c273a);
    color:white;
}
.login-box {
    width:320px;
    padding:40px 35px;
    background: rgba(15,20,35,0.95);
    border-radius:12px;
    box-shadow: 0 0 25px rgba(0,255,255,0.15);
    text-align:center;
}
.login-box h2 { font-size:22px; font-weight:600; margin-bottom:25px; }
.error { color:#ff6666; font-size:14px; margin-bottom:15px; }
.input-group { margin-bottom:20px; text-align:left; }
.input-group label { display:block; font-size:14px; margin-bottom:6px; color:#aaa; }
.input-group input {
    width:100%;
    padding:10px;
    background:transparent;
    border:none;
    border-bottom:1px solid #555;
    color:white;
    font-size:14px;
    outline:none;
    transition:0.3s;
}
.input-group input:focus { border-bottom:1px solid #00e6e6; }
.login-box button {
    margin-top:15px;
    width:100%;
    padding:10px;
    border:none;
    border-radius:6px;
    background:#00e6e6;
    color:#0a0f1a;
    font-weight:bold;
    font-size:15px;
    cursor:pointer;
    letter-spacing:1px;
    box-shadow:0 0 15px #00e6e6;
    transition:0.3s;
}
.login-box button:hover { box-shadow:0 0 25px #00ffff,0 0 50px #00ffff; }
</style>
</head>
<body>

<div class="login-box">
<h2>Login</h2>

<?php if($error): ?>
<p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form action="index.php?controller=login&action=loginProcess" method="POST">
    <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" required>
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Log in</button>
</form>
</div>

</body>
</html>
