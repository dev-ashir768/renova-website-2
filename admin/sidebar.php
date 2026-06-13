<div class="sidebar">
  <div class="sidebar-logo">
    <div class="name">RENOVA <span>ADMIN</span></div>
    <div class="sub">Portfolio Manager</div>
  </div>
  <nav>
    <a href="index.php" <?= basename($_SERVER['PHP_SELF'])==='index.php' ? 'class="active"' : '' ?>>📁 Portfolio Items</a>
    <a href="add.php"   <?= basename($_SERVER['PHP_SELF'])==='add.php'   ? 'class="active"' : '' ?>>➕ Add New</a>
    <a href="submissions.php" <?= basename($_SERVER['PHP_SELF'])==='submissions.php' ? 'class="active"' : '' ?>>📩 Form Submissions</a>
    <a href="../portfolio.php" target="_blank">🌐 View Site</a>
  </nav>
  <div class="sidebar-bottom">
    <span style="font-size:.72rem;color:#5a5a55;">Signed in as <strong style="color:#fff;"><?= htmlspecialchars($_SESSION['admin_user']) ?></strong></span><br><br>
    <a href="logout.php">Sign Out →</a>
  </div>
</div>
