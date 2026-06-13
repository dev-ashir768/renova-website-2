<?php
require_once 'auth.php';
require_once '../db.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) { header('Location: index.php'); exit; }

$item = $pdo->prepare("SELECT * FROM portfolio_items WHERE id=?");
$item->execute([$id]);
$data = $item->fetch();
if (!$data) { header('Location: index.php'); exit; }

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['title']       = trim($_POST['title'] ?? '');
    $data['category']    = $_POST['category'] ?? 'website';
    $data['description'] = trim($_POST['description'] ?? '');
    $data['client']      = trim($_POST['client'] ?? '');
    $data['year']        = (int)($_POST['year'] ?? date('Y'));
    $data['tags']        = trim($_POST['tags'] ?? '');
    $data['sort_order']  = (int)($_POST['sort_order'] ?? 0);
    $data['status']      = isset($_POST['status']) ? 1 : 0;

    if (!$data['title']) $errors[] = 'Title is required.';

    // Image upload
    $image = $data['image'];
    if (!empty($_FILES['image']['name'])) {
        $ext  = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp','gif'];
        if (!in_array($ext, $allowed)) {
            $errors[] = 'Image must be jpg, png, webp, or gif.';
        } elseif ($_FILES['image']['size'] > 5 * 1024 * 1024) {
            $errors[] = 'Image must be under 5MB.';
        } else {
            if ($image && file_exists('uploads/' . $image)) unlink('uploads/' . $image);
            $image = uniqid('port_') . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
        }
    }

    // Remove image
    if (isset($_POST['remove_image']) && $data['image']) {
        if (file_exists('uploads/' . $data['image'])) unlink('uploads/' . $data['image']);
        $image = null;
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE portfolio_items SET title=?,category=?,description=?,image=?,client=?,year=?,tags=?,sort_order=?,status=? WHERE id=?");
        $stmt->execute([$data['title'],$data['category'],$data['description'],$image,$data['client'],$data['year'],$data['tags'],$data['sort_order'],$data['status'],$id]);
        $data['image'] = $image;
        header("Location: index.php?msg=saved");
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Project — Renova Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <?php include 'admin_styles.php'; ?>
</head>
<body>
<?php include 'sidebar.php'; ?>

<div class="main">
  <div class="page-header">
    <div class="page-title">Edit Project</div>
    <a href="index.php" class="btn-back">← Back to List</a>
  </div>

  <?php if ($errors): ?>
    <div class="alert alert-error"><?= implode('<br>', array_map('htmlspecialchars', $errors)) ?></div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data" class="form-card">
    <?php if ($data['image']): ?>
    <div class="current-image">
      <div class="ci-label">Current Image</div>
      <img src="uploads/<?= htmlspecialchars($data['image']) ?>" class="ci-thumb" />
      <label class="ci-remove"><input type="checkbox" name="remove_image"> Remove image</label>
    </div>
    <?php endif; ?>
    <?php include 'form_fields.php'; ?>
    <div class="form-actions">
      <button type="submit" class="btn-save">Update Project</button>
      <a href="index.php" class="btn-cancel">Cancel</a>
    </div>
  </form>
</div>
</body>
</html>
