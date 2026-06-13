<div class="form-grid">
  <div class="field full">
    <label>Project Title *</label>
    <input type="text" name="title" value="<?= htmlspecialchars($data['title'] ?? '') ?>" placeholder="e.g. Corporate Website Redesign" required />
  </div>

  <div class="field">
    <label>Category *</label>
    <select name="category">
      <?php
      $cats = ['website'=>'Website Design','branding'=>'Branding','mobile'=>'Mobile App','webapp'=>'Web Application','ecommerce'=>'E-Commerce','marketing'=>'SEO & Marketing'];
      foreach ($cats as $val => $lbl): ?>
        <option value="<?= $val ?>" <?= ($data['category']??'')===$val ? 'selected':'' ?>><?= $lbl ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="field">
    <label>Client Name</label>
    <input type="text" name="client" value="<?= htmlspecialchars($data['client'] ?? '') ?>" placeholder="e.g. Tech Corp USA" />
  </div>

  <div class="field">
    <label>Year</label>
    <input type="number" name="year" value="<?= htmlspecialchars($data['year'] ?? date('Y')) ?>" min="2000" max="2099" />
  </div>

  <div class="field">
    <label>Display Order <small style="color:#9a9a94;text-transform:none;">(lower = first)</small></label>
    <input type="number" name="sort_order" value="<?= (int)($data['sort_order'] ?? 0) ?>" min="0" />
  </div>

  <div class="field full">
    <label>Description</label>
    <textarea name="description" rows="3" placeholder="Brief description of the project..."><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
  </div>

  <div class="field full">
    <label>Tags <small style="color:#9a9a94;text-transform:none;">(comma-separated)</small></label>
    <input type="text" name="tags" value="<?= htmlspecialchars($data['tags'] ?? '') ?>" placeholder="e.g. PHP, MySQL, WordPress" />
  </div>

  <div class="field full">
    <label>Project Image <small style="color:#9a9a94;text-transform:none;">(jpg/png/webp, max 5MB — leave empty to use default illustration)</small></label>
    <input type="file" name="image" accept="image/*" />
  </div>

  <div class="field full">
    <label class="checkbox-label">
      <input type="checkbox" name="status" <?= ($data['status'] ?? 1) ? 'checked' : '' ?> />
      <span>Active (visible on portfolio page)</span>
    </label>
  </div>
</div>
