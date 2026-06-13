<?php
require_once 'auth.php';
require_once '../db.php';

// Handle delete
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $stmt = $pdo->prepare("SELECT image FROM portfolio_items WHERE id=?");
    $stmt->execute([(int)$_GET['delete']]);
    $row = $stmt->fetch();
    if ($row && $row['image'] && file_exists('uploads/' . $row['image'])) {
        unlink('uploads/' . $row['image']);
    }
    $pdo->prepare("DELETE FROM portfolio_items WHERE id=?")->execute([(int)$_GET['delete']]);
    header('Location: index.php?msg=deleted');
    exit;
}

// Handle toggle status
if (isset($_GET['toggle']) && is_numeric($_GET['toggle'])) {
    $pdo->prepare("UPDATE portfolio_items SET status = 1-status WHERE id=?")->execute([(int)$_GET['toggle']]);
    header('Location: index.php?msg=updated');
    exit;
}

$items = $pdo->query("SELECT * FROM portfolio_items ORDER BY sort_order ASC, id ASC")->fetchAll();
$total   = count($items);
$active  = count(array_filter($items, fn($i) => $i['status'] == 1));
$inactive = $total - $active;

$cat_labels = [
    'website'=>'Website','branding'=>'Branding','mobile'=>'Mobile App',
    'webapp'=>'Web App','ecommerce'=>'E-Commerce','marketing'=>'Marketing',
];

$msg = $_GET['msg'] ?? '';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin — Renova Portfolio</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
    body { font-family:'Inter',sans-serif; background:#f5f4f0; color:#111110; min-height:100vh; }

    /* Sidebar */
    .sidebar { position:fixed; left:0; top:0; bottom:0; width:220px; background:#111110; display:flex; flex-direction:column; z-index:100; }
    .sidebar-logo { padding:28px 24px 20px; border-bottom:1px solid rgba(255,255,255,.08); }
    .sidebar-logo .name { font-size:.95rem; font-weight:800; color:#fff; }
    .sidebar-logo .name span { color:#b8922a; }
    .sidebar-logo .sub { font-size:.65rem; color:#9a9a94; text-transform:uppercase; letter-spacing:.1em; margin-top:2px; }
    nav a { display:flex; align-items:center; gap:10px; padding:11px 24px; font-size:.8rem; font-weight:500; color:#9a9a94; text-decoration:none; transition:all .2s; }
    nav a:hover, nav a.active { color:#fff; background:rgba(255,255,255,.05); border-left:2px solid #b8922a; }
    .sidebar-bottom { margin-top:auto; padding:20px 24px; border-top:1px solid rgba(255,255,255,.08); }
    .sidebar-bottom a { font-size:.75rem; color:#9a9a94; text-decoration:none; display:block; margin-bottom:8px; }
    .sidebar-bottom a:hover { color:#b8922a; }

    /* Main */
    .main { margin-left:220px; padding:32px; min-height:100vh; }
    .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; }
    .page-title { font-size:1.5rem; font-weight:800; }
    .btn-add { background:#b8922a; color:#fff; padding:10px 20px; border-radius:4px; text-decoration:none; font-size:.78rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; }
    .btn-add:hover { background:#8a6b1e; }

    /* Stats */
    .stats { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:28px; }
    .stat-card { background:#fff; border:1px solid #e0dfd9; border-radius:6px; padding:20px 24px; }
    .stat-card .num { font-size:2rem; font-weight:900; color:#b8922a; line-height:1; }
    .stat-card .lbl { font-size:.7rem; color:#9a9a94; text-transform:uppercase; letter-spacing:.08em; margin-top:4px; }

    /* Alert */
    .alert { padding:12px 16px; border-radius:4px; font-size:.8rem; margin-bottom:20px; }
    .alert-success { background:#f0fdf4; border:1px solid #86efac; color:#166534; }
    .alert-error   { background:#fef2f2; border:1px solid #fca5a5; color:#b91c1c; }

    /* Table */
    .table-wrap { background:#fff; border:1px solid #e0dfd9; border-radius:6px; overflow:hidden; }
    table { width:100%; border-collapse:collapse; }
    thead th { background:#f5f4f0; padding:11px 16px; text-align:left; font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:#5a5a55; border-bottom:1px solid #e0dfd9; }
    tbody tr { border-bottom:1px solid #f0ede8; }
    tbody tr:last-child { border-bottom:none; }
    tbody tr:hover { background:#fafaf8; }
    td { padding:12px 16px; font-size:.8rem; color:#5a5a55; vertical-align:middle; }
    td.title { font-weight:600; color:#111110; }
    .thumb-sm { width:56px; height:42px; object-fit:cover; border-radius:3px; background:#f0ede8; }
    .thumb-placeholder { width:56px; height:42px; border-radius:3px; background:#f0ede8; display:inline-flex; align-items:center; justify-content:center; font-size:.55rem; color:#9a9a94; text-align:center; }

    .badge { display:inline-flex; align-items:center; padding:3px 10px; border-radius:20px; font-size:.65rem; font-weight:700; text-transform:uppercase; letter-spacing:.06em; }
    .badge-active   { background:#f0fdf4; color:#166534; border:1px solid #86efac; }
    .badge-inactive { background:#fef2f2; color:#b91c1c; border:1px solid #fca5a5; }

    .cat-badge { background:#faf6ee; color:#8a6b1e; border:1px solid #e0c97a; padding:3px 8px; border-radius:3px; font-size:.65rem; font-weight:600; text-transform:uppercase; letter-spacing:.05em; }

    .actions { display:flex; align-items:center; gap:8px; }
    .btn-sm { padding:5px 12px; border-radius:3px; font-size:.7rem; font-weight:600; text-decoration:none; cursor:pointer; border:none; }
    .btn-edit    { background:#f0ede8; color:#5a5a55; }
    .btn-edit:hover { background:#e0dfd9; }
    .btn-toggle  { cursor:pointer; }
    .btn-del     { background:#fef2f2; color:#b91c1c; }
    .btn-del:hover { background:#fee2e2; }

    .toggle-switch { position:relative; display:inline-block; width:40px; height:22px; }
    .toggle-switch input { opacity:0; width:0; height:0; }
    .slider { position:absolute; inset:0; background:#e0dfd9; border-radius:22px; cursor:pointer; transition:.3s; }
    .slider:before { content:''; position:absolute; height:16px; width:16px; left:3px; bottom:3px; background:#fff; border-radius:50%; transition:.3s; }
    input:checked + .slider { background:#b8922a; }
    input:checked + .slider:before { transform:translateX(18px); }

    .empty { text-align:center; padding:48px; color:#9a9a94; font-size:.85rem; }
  </style>
</head>
<body>

<div class="sidebar">
  <div class="sidebar-logo">
    <div class="name">RENOVA <span>ADMIN</span></div>
    <div class="sub">Portfolio Manager</div>
  </div>
  <nav>
    <a href="index.php" class="active">📁 Portfolio Items</a>
    <a href="add.php">➕ Add New</a>
    <a href="../portfolio.php" target="_blank">🌐 View Site</a>
  </nav>
  <div class="sidebar-bottom">
    <span style="font-size:.72rem;color:#5a5a55;">Signed in as <strong style="color:#fff;"><?= htmlspecialchars($_SESSION['admin_user']) ?></strong></span><br><br>
    <a href="logout.php">Sign Out →</a>
  </div>
</div>

<div class="main">
  <div class="page-header">
    <div class="page-title">Portfolio Items</div>
    <a href="add.php" class="btn-add">+ Add New Project</a>
  </div>

  <?php if ($msg === 'saved'): ?><div class="alert alert-success">Project saved successfully.</div>
  <?php elseif ($msg === 'deleted'): ?><div class="alert alert-success">Project deleted.</div>
  <?php elseif ($msg === 'updated'): ?><div class="alert alert-success">Status updated.</div>
  <?php endif; ?>

  <div class="stats">
    <div class="stat-card"><div class="num"><?= $total ?></div><div class="lbl">Total Projects</div></div>
    <div class="stat-card"><div class="num" style="color:#166534;"><?= $active ?></div><div class="lbl">Active (Visible)</div></div>
    <div class="stat-card"><div class="num" style="color:#b91c1c;"><?= $inactive ?></div><div class="lbl">Hidden</div></div>
  </div>

  <div class="table-wrap">
    <?php if (empty($items)): ?>
      <div class="empty">No portfolio items yet. <a href="add.php" style="color:#b8922a;">Add your first project →</a></div>
    <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Thumb</th>
          <th>Title</th>
          <th>Category</th>
          <th>Client</th>
          <th>Year</th>
          <th>Order</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($items as $item): ?>
        <tr>
          <td>
            <?php if ($item['image']): ?>
              <img class="thumb-sm" src="uploads/<?= htmlspecialchars($item['image']) ?>" alt="">
            <?php else: ?>
              <div class="thumb-placeholder">No<br>Image</div>
            <?php endif; ?>
          </td>
          <td class="title"><?= htmlspecialchars($item['title']) ?></td>
          <td><span class="cat-badge"><?= htmlspecialchars($cat_labels[$item['category']] ?? $item['category']) ?></span></td>
          <td><?= htmlspecialchars($item['client'] ?? '—') ?></td>
          <td><?= htmlspecialchars($item['year'] ?? '—') ?></td>
          <td><?= (int)$item['sort_order'] ?></td>
          <td>
            <label class="toggle-switch" title="Click to toggle active/inactive" onclick="window.location='index.php?toggle=<?= $item['id'] ?>'">
              <input type="checkbox" <?= $item['status'] ? 'checked' : '' ?> onclick="event.preventDefault()">
              <span class="slider"></span>
            </label>
          </td>
          <td>
            <div class="actions">
              <a href="edit.php?id=<?= $item['id'] ?>" class="btn-sm btn-edit">Edit</a>
              <a href="index.php?delete=<?= $item['id'] ?>" class="btn-sm btn-del" onclick="return confirm('Delete this project?')">Delete</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
