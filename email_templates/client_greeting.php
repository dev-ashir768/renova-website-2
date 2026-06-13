<?php
function clientEmailTemplate($data) {
    $name    = htmlspecialchars($data['name']);
    $project = htmlspecialchars($data['project'] ?? 'your project');
    $year    = date('Y');

    return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>Thank You — Renova Marketing Solutions</title>
</head>
<body style="margin:0;padding:0;background:#f5f4f0;font-family:'Helvetica Neue',Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f4f0;padding:40px 20px;">
  <tr><td align="center">
    <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;">

      <!-- Header -->
      <tr><td style="background:#111110;border-radius:6px 6px 0 0;padding:40px;text-align:center;">
        <img src="https://skyblue-mink-972387.hostingersite.com/assets/images/logo/logo.png" alt="Renova Marketing Solutions" height="52" style="height:52px;width:auto;"/>
      </td></tr>

      <!-- Gold bar -->
      <tr><td style="background:linear-gradient(135deg,#b8922a,#d4a93a);padding:3px 0;"></td></tr>

      <!-- Hero -->
      <tr><td style="background:#ffffff;padding:48px 40px 32px;text-align:center;">
        <div style="width:60px;height:60px;background:#faf6ee;border-radius:50%;border:2px solid #b8922a;margin:0 auto 20px;display:flex;align-items:center;justify-content:center;line-height:60px;">
          <span style="font-size:24px;line-height:60px;display:block;">✓</span>
        </div>
        <h1 style="margin:0 0 12px;font-size:26px;font-weight:800;color:#111110;letter-spacing:-0.5px;">Thank You, $name!</h1>
        <p style="margin:0;font-size:13px;color:#b8922a;text-transform:uppercase;letter-spacing:2px;font-weight:600;">We've received your message</p>
      </td></tr>

      <!-- Body -->
      <tr><td style="background:#ffffff;padding:0 40px 40px;">
        <p style="margin:0 0 16px;color:#5a5a55;font-size:15px;line-height:1.8;">We're excited to learn about <strong style="color:#111110;">$project</strong> and how we can help your business grow.</p>
        <p style="margin:0 0 28px;color:#5a5a55;font-size:15px;line-height:1.8;">One of our specialists will review your enquiry and reach out to you <strong style="color:#111110;">within 24 hours</strong> with a tailored proposal.</p>

        <!-- What's next box -->
        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f4f0;border-left:3px solid #b8922a;border-radius:0 4px 4px 0;margin-bottom:32px;">
          <tr><td style="padding:20px 24px;">
            <p style="margin:0 0 12px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#9a9a94;">What happens next</p>
            <table cellpadding="0" cellspacing="0">
              <tr>
                <td style="padding:6px 0;vertical-align:top;">
                  <span style="display:inline-block;width:20px;height:20px;background:#b8922a;border-radius:50%;text-align:center;line-height:20px;font-size:10px;font-weight:700;color:#fff;margin-right:10px;">1</span>
                </td>
                <td style="padding:6px 0;font-size:13px;color:#5a5a55;line-height:1.5;">Our team reviews your project details</td>
              </tr>
              <tr>
                <td style="padding:6px 0;vertical-align:top;">
                  <span style="display:inline-block;width:20px;height:20px;background:#b8922a;border-radius:50%;text-align:center;line-height:20px;font-size:10px;font-weight:700;color:#fff;margin-right:10px;">2</span>
                </td>
                <td style="padding:6px 0;font-size:13px;color:#5a5a55;line-height:1.5;">We prepare a tailored proposal for your business</td>
              </tr>
              <tr>
                <td style="padding:6px 0;vertical-align:top;">
                  <span style="display:inline-block;width:20px;height:20px;background:#b8922a;border-radius:50%;text-align:center;line-height:20px;font-size:10px;font-weight:700;color:#fff;margin-right:10px;">3</span>
                </td>
                <td style="padding:6px 0;font-size:13px;color:#5a5a55;line-height:1.5;">We reach out within 24 hours to discuss next steps</td>
              </tr>
            </table>
          </td></tr>
        </table>

        <!-- CTA -->
        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:32px;">
          <tr><td align="center">
            <a href="https://skyblue-mink-972387.hostingersite.com/services" style="display:inline-block;background:#b8922a;color:#fff;text-decoration:none;padding:14px 32px;border-radius:3px;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-right:8px;">Explore Services</a>
            <a href="https://skyblue-mink-972387.hostingersite.com/portfolio" style="display:inline-block;background:transparent;color:#b8922a;text-decoration:none;padding:13px 32px;border-radius:3px;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;border:1.5px solid #b8922a;">View Portfolio</a>
          </td></tr>
        </table>

        <!-- Contact info -->
        <table width="100%" cellpadding="0" cellspacing="0" style="border-top:1px solid #e0dfd9;padding-top:24px;">
          <tr>
            <td align="center" style="padding:0 10px;">
              <p style="margin:0;font-size:11px;color:#9a9a94;text-transform:uppercase;letter-spacing:1px;font-weight:600;">Email</p>
              <a href="mailto:info@renovamarketingsolutions.com" style="font-size:13px;color:#b8922a;text-decoration:none;font-weight:600;">info@renovamarketingsolutions.com</a>
            </td>
            <td align="center" style="padding:0 10px;border-left:1px solid #e0dfd9;">
              <p style="margin:0;font-size:11px;color:#9a9a94;text-transform:uppercase;letter-spacing:1px;font-weight:600;">Phone</p>
              <a href="tel:+13435128311" style="font-size:13px;color:#b8922a;text-decoration:none;font-weight:600;">+1 343-512-8311</a>
            </td>
            <td align="center" style="padding:0 10px;border-left:1px solid #e0dfd9;">
              <p style="margin:0;font-size:11px;color:#9a9a94;text-transform:uppercase;letter-spacing:1px;font-weight:600;">Coverage</p>
              <span style="font-size:13px;color:#5a5a55;font-weight:600;">USA &amp; Canada</span>
            </td>
          </tr>
        </table>
      </td></tr>

      <!-- Footer -->
      <tr><td style="background:#111110;border-radius:0 0 6px 6px;padding:28px 40px;text-align:center;">
        <p style="margin:0 0 8px;font-size:11px;color:#5a5a55;font-style:italic;">Creative Solutions. Measurable Results. Lasting Growth.</p>
        <p style="margin:0;font-size:11px;color:#5a5a55;">© $year Renova Marketing Solutions. All rights reserved.</p>
        <div style="margin-top:16px;">
          <a href="https://www.facebook.com/share/1JhHDughpX/?mibextid=wwXIfr" style="display:inline-block;margin:0 6px;color:#9a9a94;text-decoration:none;font-size:12px;">Facebook</a>
          <a href="https://www.instagram.com/renova_marketingsolutions?igsh=ajMzemdnejZ2ZnV5" style="display:inline-block;margin:0 6px;color:#9a9a94;text-decoration:none;font-size:12px;">Instagram</a>
        </div>
      </td></tr>

    </table>
  </td></tr>
</table>
</body>
</html>
HTML;
}
