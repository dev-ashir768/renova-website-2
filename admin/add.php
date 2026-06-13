<?php
require_once 'auth.php';
require_once '../db.php';

$errors = [];
$data = ['title'=>'','category'=>'website','description'=>'','client'=>'','year'=>date('Y'),'tags'=>'','sort_order'=>0,'status'=>1];

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
    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $ext  = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp','gif'];
        if (!in_array($ext, $allowed)) {
            $errors[] = 'Image must be jpg, png, webp, or gif.';
        } elseif ($_FILES['image']['size'] > 5 * 1024 * 1024) {
            $errors[] = 'Image must be under 5MB.';
        } else {
            $image = uniqid('port_') . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
        }
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO portfolio_items (title,category,description,image,client,year,tags,sort_order,status) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$data['title'],$data['category'],$data['description'],$image,$data['client'],$data['year'],$data['tags'],$data['sort_order'],$data['status']]);
        header('Location: index.php?msg=saved');
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Project — Renova Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <?php include 'admin_styles.php'; ?>
</head>
<body>
<?php include 'sidebar.php'; ?>

<div class="main">
  <div class="page-header">
    <div class="page-title">Add New Project</div>
    <a href="index.php" class="btn-back">← Back to List</a>
  </div>

  <?php if ($errors): ?>
    <div class="alert alert-error"><?= implode('<br>', array_map('htmlspecialchars', $errors)) ?></div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data" class="form-card">
    <?php include 'form_fields.php'; ?>
    <div class="form-actions">
      <button type="submit" class="btn-save">Save Project</button>
      <a href="index.php" class="btn-cancel">Cancel</a>
    </div>
  </form>
</div>
</body>
</html>
