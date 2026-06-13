<style>
*, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
body { font-family:'Inter',sans-serif; background:#f5f4f0; color:#111110; min-height:100vh; }

.sidebar { position:fixed; left:0; top:0; bottom:0; width:220px; background:#111110; display:flex; flex-direction:column; z-index:100; }
.sidebar-logo { padding:28px 24px 20px; border-bottom:1px solid rgba(255,255,255,.08); }
.sidebar-logo .name { font-size:.95rem; font-weight:800; color:#fff; }
.sidebar-logo .name span { color:#b8922a; }
.sidebar-logo .sub { font-size:.65rem; color:#9a9a94; text-transform:uppercase; letter-spacing:.1em; margin-top:2px; }
nav a { display:flex; align-items:center; gap:10px; padding:11px 24px; font-size:.8rem; font-weight:500; color:#9a9a94; text-decoration:none; transition:all .2s; border-left:2px solid transparent; }
nav a:hover, nav a.active { color:#fff; background:rgba(255,255,255,.05); border-left-color:#b8922a; }
.sidebar-bottom { margin-top:auto; padding:20px 24px; border-top:1px solid rgba(255,255,255,.08); }
.sidebar-bottom a { font-size:.75rem; color:#9a9a94; text-decoration:none; }
.sidebar-bottom a:hover { color:#b8922a; }

.main { margin-left:220px; padding:32px; min-height:100vh; }
.page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; }
.page-title { font-size:1.5rem; font-weight:800; }
.btn-back { font-size:.78rem; color:#5a5a55; text-decoration:none; font-weight:600; }
.btn-back:hover { color:#b8922a; }

.alert { padding:12px 16px; border-radius:4px; font-size:.8rem; margin-bottom:20px; }
.alert-success { background:#f0fdf4; border:1px solid #86efac; color:#166534; }
.alert-error   { background:#fef2f2; border:1px solid #fca5a5; color:#b91c1c; }

/* Form */
.form-card { background:#fff; border:1px solid #e0dfd9; border-radius:6px; padding:32px; max-width:860px; }
.form-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
.field { display:flex; flex-direction:column; gap:6px; }
.field.full { grid-column:1/-1; }
label { font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:#5a5a55; }
input[type=text], input[type=number], select, textarea {
  padding:10px 13px; border:1px solid #e0dfd9; border-radius:4px;
  font-size:.85rem; font-family:inherit; color:#111110; outline:none; transition:border-color .2s;
  background:#fff;
}
input:focus, select:focus, textarea:focus { border-color:#b8922a; }
input[type=file] { padding:8px; background:#fafaf8; font-size:.8rem; }
textarea { resize:vertical; }
.checkbox-label { display:flex; align-items:center; gap:10px; cursor:pointer; font-size:.82rem; font-weight:500; text-transform:none; letter-spacing:0; color:#111110; }
.checkbox-label input { width:16px; height:16px; accent-color:#b8922a; }

.current-image { margin-bottom:24px; padding:16px; background:#fafaf8; border:1px solid #e0dfd9; border-radius:4px; display:flex; align-items:center; gap:16px; }
.ci-label { font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:#9a9a94; }
.ci-thumb { width:80px; height:60px; object-fit:cover; border-radius:3px; }
.ci-remove { font-size:.78rem; color:#b91c1c; display:flex; align-items:center; gap:6px; cursor:pointer; }

.form-actions { display:flex; align-items:center; gap:12px; margin-top:28px; padding-top:24px; border-top:1px solid #e0dfd9; }
.btn-save   { background:#b8922a; color:#fff; padding:12px 28px; border:none; border-radius:4px; font-size:.78rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; cursor:pointer; }
.btn-save:hover { background:#8a6b1e; }
.btn-cancel { color:#9a9a94; text-decoration:none; font-size:.78rem; font-weight:600; }
.btn-cancel:hover { color:#b91c1c; }
</style>
