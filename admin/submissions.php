<?php
require_once 'auth.php';
require_once '../db.php';

// Mark as read
if (isset($_GET['read']) && is_numeric($_GET['read'])) {
    $pdo->prepare("UPDATE form_submissions SET is_read=1 WHERE id=?")->execute([(int)$_GET['read']]);
    header('Location: submissions.php'); exit;
}
// Delete
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $pdo->prepare("DELETE FROM form_submissions WHERE id=?")->execute([(int)$_GET['delete']]);
    header('Location: submissions.php'); exit;
}

$items   = $pdo->query("SELECT * FROM form_submissions ORDER BY created_at DESC")->fetchAll();
$unread  = $pdo->query("SELECT COUNT(*) FROM form_submissions WHERE is_read=0")->fetchColumn();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>Submissions — Renova Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <?php include 'admin_styles.php'; ?>
  <style>
    .unread-row { background:#fffbf2 !important; }
    .unread-dot { display:inline-block;width:8px;height:8px;background:#b8922a;border-radius:50%;margin-right:6px; }
    .msg-preview { max-width:280px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:#5a5a55;font-size:.8rem; }
    .badge-unread { background:#fef6e4;color:#8a6b1e;border:1px solid #e0c97a;padding:2px 8px;border-radius:3px;font-size:.65rem;font-weight:700;text-transform:uppercase; }
    .badge-read   { background:#f0ede8;color:#9a9a94;padding:2px 8px;border-radius:3px;font-size:.65rem;font-weight:600; }
  </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="main">
  <div class="page-header">
    <div class="page-title">Form Submissions <?php if($unread): ?><span style="font-size:1rem;background:#b8922a;color:#fff;border-radius:20px;padding:2px 10px;margin-left:8px;font-weight:700;"><?= $unread ?> new</span><?php endif; ?></div>
  </div>

  <div class="table-wrap">
    <?php if (empty($items)): ?>
      <div class="empty">No form submissions yet.</div>
    <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Status</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Service</th>
          <th>Message</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($items as $s): ?>
        <tr class="<?= !$s['is_read'] ? 'unread-row' : '' ?>">
          <td><?= $s['is_read'] ? '<span class="badge-read">Read</span>' : '<span class="badge-unread">● New</span>' ?></td>
          <td style="font-weight:600;color:#111110;"><?= htmlspecialchars($s['name']) ?></td>
          <td><a href="mailto:<?= htmlspecialchars($s['email']) ?>" style="color:#b8922a;text-decoration:none;"><?= htmlspecialchars($s['email']) ?></a></td>
          <td><?= htmlspecialchars($s['phone'] ?? '—') ?></td>
          <td><?= htmlspecialchars($s['project'] ?? '—') ?></td>
          <td><div class="msg-preview"><?= htmlspecialchars($s['message']) ?></div></td>
          <td style="white-space:nowrap;font-size:.75rem;"><?= date('M j, Y', strtotime($s['created_at'])) ?></td>
          <td>
            <div class="actions">
              <?php if (!$s['is_read']): ?>
                <a href="submissions.php?read=<?= $s['id'] ?>" class="btn-sm btn-edit">Mark Read</a>
              <?php endif; ?>
              <a href="submissions.php?delete=<?= $s['id'] ?>" class="btn-sm btn-del" onclick="return confirm('Delete this submission?')">Delete</a>
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
