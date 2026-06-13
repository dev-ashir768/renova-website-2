<?php
session_start();
if (isset($_SESSION['admin_id'])) { header('Location: index.php'); exit; }

require_once '../db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_user'] = $user['username'];
        header('Location: index.php');
        exit;
    }
    $error = 'Invalid username or password.';
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login — Renova</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
    body { font-family:'Inter',sans-serif; background:#f5f4f0; min-height:100vh; display:flex; align-items:center; justify-content:center; }
    .card { background:#fff; border:1px solid #e0dfd9; border-radius:6px; padding:48px 40px; width:100%; max-width:400px; box-shadow:0 8px 32px rgba(0,0,0,.06); }
    .logo { text-align:center; margin-bottom:32px; }
    .logo-text { font-size:1.5rem; font-weight:900; color:#111110; }
    .logo-text span { color:#b8922a; }
    .subtitle { font-size:.75rem; color:#9a9a94; text-transform:uppercase; letter-spacing:.1em; margin-top:4px; }
    label { display:block; font-size:.75rem; font-weight:600; text-transform:uppercase; letter-spacing:.08em; color:#5a5a55; margin-bottom:6px; }
    input { width:100%; padding:12px 14px; border:1px solid #e0dfd9; border-radius:4px; font-size:.875rem; font-family:inherit; color:#111110; outline:none; transition:border-color .2s; }
    input:focus { border-color:#b8922a; }
    .field { margin-bottom:20px; }
    .btn { width:100%; padding:14px; background:#b8922a; color:#fff; border:none; border-radius:4px; font-size:.8rem; font-weight:700; text-transform:uppercase; letter-spacing:.1em; cursor:pointer; transition:background .2s; margin-top:8px; }
    .btn:hover { background:#8a6b1e; }
    .error { background:#fef2f2; border:1px solid #fca5a5; color:#b91c1c; border-radius:4px; padding:10px 14px; font-size:.8rem; margin-bottom:20px; }
    .back { text-align:center; margin-top:20px; font-size:.75rem; color:#9a9a94; }
    .back a { color:#b8922a; text-decoration:none; }
  </style>
</head>
<body>
  <div class="card">
    <div class="logo">
      <div class="logo-text">RENOVA <span>ADMIN</span></div>
      <div class="subtitle">Portfolio Manager</div>
    </div>
    <?php if ($error): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST">
      <div class="field">
        <label>Username</label>
        <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required autofocus />
      </div>
      <div class="field">
        <label>Password</label>
        <input type="password" name="password" required />
      </div>
      <button type="submit" class="btn">Sign In</button>
    </form>
    <div class="back"><a href="../portfolio.php">← Back to Website</a></div>
  </div>
</body>
</html>
