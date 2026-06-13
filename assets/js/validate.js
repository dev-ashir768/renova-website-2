/* ═══════════════════════════════════════════
   Renova — Shared Form Validation Utilities
═══════════════════════════════════════════ */

const Validate = (() => {

  const EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
  const PHONE_RE = /^[\+]?[(]?[0-9]{1,4}[)]?[-\s\.]?[(]?[0-9]{1,3}[)]?[-\s\.]?[0-9]{3,4}[-\s\.]?[0-9]{3,4}$/;

  function getField(el) {
    return typeof el === 'string' ? document.querySelector(el) : el;
  }

  /* Show error below a field */
  function showError(field, msg) {
    field = getField(field);
    if (!field) return;
    field.classList.add('input-error');
    let err = field.parentElement.querySelector('.field-error');
    if (!err) {
      err = document.createElement('p');
      err.className = 'field-error text-xs text-red-500 mt-1.5 flex items-center gap-1';
      err.innerHTML = `<svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg><span></span>`;
      field.parentElement.appendChild(err);
    }
    err.querySelector('span').textContent = msg;
    err.style.display = 'flex';
    gsap.fromTo(err, { opacity: 0, y: -4 }, { opacity: 1, y: 0, duration: 0.25, ease: 'power2.out' });
  }

  /* Clear error on a field */
  function clearError(field) {
    field = getField(field);
    if (!field) return;
    field.classList.remove('input-error');
    const err = field.parentElement.querySelector('.field-error');
    if (err) err.style.display = 'none';
  }

  /* Attach live clear-on-input listeners */
  function attachLiveValidation(fields) {
    fields.forEach(f => {
      const el = getField(f);
      if (!el) return;
      el.addEventListener('input', () => clearError(el));
      el.addEventListener('change', () => clearError(el));
    });
  }

  /* Shake a button on error */
  function shakeBtn(btn) {
    btn = getField(btn);
    if (!btn) return;
    gsap.fromTo(btn, { x: 0 }, { x: [-6, 6, -5, 5, -3, 3, 0], duration: 0.5, ease: 'power2.inOut' });
  }

  /* ─── Validators ─── */
  function isRequired(val) { return val.trim().length > 0; }
  function isEmail(val)    { return EMAIL_RE.test(val.trim()); }
  function isPhone(val)    { return val.trim() === '' || PHONE_RE.test(val.trim().replace(/\s/g,'')); }
  function minLen(val, n)  { return val.trim().length >= n; }

  /* ─── Validate a single field, return true if valid ─── */
  function field(el, rules) {
    el = getField(el);
    if (!el) return true;
    const val = el.value;
    for (const [rule, arg] of Object.entries(rules)) {
      if (rule === 'required' && arg && !isRequired(val)) { showError(el, 'This field is required.'); return false; }
      if (rule === 'email'    && arg && !isEmail(val))    { showError(el, 'Please enter a valid email address.'); return false; }
      if (rule === 'phone'    && arg && !isPhone(val))    { showError(el, 'Please enter a valid phone number.'); return false; }
      if (rule === 'minLen'   && !minLen(val, arg))       { showError(el, `Minimum ${arg} characters required.`); return false; }
      if (rule === 'select'   && arg && val === '')        { showError(el, 'Please select an option.'); return false; }
    }
    clearError(el);
    return true;
  }

  /* ─── Validate a set of {selector: rules} pairs, returns true if ALL pass ─── */
  function all(schema) {
    let valid = true;
    for (const [sel, rules] of Object.entries(schema)) {
      if (!field(sel, rules)) valid = false;
    }
    return valid;
  }

  return { field, all, showError, clearError, shakeBtn, attachLiveValidation };
})();
