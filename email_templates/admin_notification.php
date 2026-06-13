<?php
// Returns HTML email body for admin notification
function adminEmailTemplate($data) {
    $name    = htmlspecialchars($data['name']);
    $email   = htmlspecialchars($data['email']);
    $phone   = htmlspecialchars($data['phone'] ?? 'Not provided');
    $project = htmlspecialchars($data['project'] ?? 'Not specified');
    $message = nl2br(htmlspecialchars($data['message']));
    $date    = date('F j, Y — g:i A');

    return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>New Project Enquiry</title>
</head>
<body style="margin:0;padding:0;background:#f5f4f0;font-family:'Helvetica Neue',Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f4f0;padding:40px 20px;">
  <tr><td align="center">
    <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;">

      <!-- Header -->
      <tr><td style="background:#111110;border-radius:6px 6px 0 0;padding:32px 40px;text-align:center;">
        <img src="https://skyblue-mink-972387.hostingersite.com/assets/images/logo/logo.png" alt="Renova" height="48" style="height:48px;width:auto;"/>
        <p style="margin:12px 0 0;color:#b8922a;font-size:11px;letter-spacing:3px;text-transform:uppercase;font-weight:600;">New Project Enquiry</p>
      </td></tr>

      <!-- Alert bar -->
      <tr><td style="background:#b8922a;padding:12px 40px;text-align:center;">
        <p style="margin:0;color:#fff;font-size:13px;font-weight:700;letter-spacing:1px;">YOU HAVE A NEW CONTACT FORM SUBMISSION</p>
      </td></tr>

      <!-- Body -->
      <tr><td style="background:#ffffff;padding:40px;">
        <p style="margin:0 0 24px;color:#111110;font-size:15px;font-weight:600;">Hi Admin,</p>
        <p style="margin:0 0 28px;color:#5a5a55;font-size:14px;line-height:1.7;">Someone just filled out the contact form on <strong>renovamarketingsolutions.com</strong>. Here are their details:</p>

        <!-- Details table -->
        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f4f0;border-radius:4px;overflow:hidden;margin-bottom:28px;">
          <tr>
            <td style="padding:14px 20px;border-bottom:1px solid #e0dfd9;">
              <span style="font-size:11px;color:#9a9a94;text-transform:uppercase;letter-spacing:1px;font-weight:700;">Name</span><br/>
              <span style="font-size:14px;color:#111110;font-weight:600;margin-top:4px;display:block;">$name</span>
            </td>
          </tr>
          <tr>
            <td style="padding:14px 20px;border-bottom:1px solid #e0dfd9;">
              <span style="font-size:11px;color:#9a9a94;text-transform:uppercase;letter-spacing:1px;font-weight:700;">Email</span><br/>
              <a href="mailto:$email" style="font-size:14px;color:#b8922a;font-weight:600;text-decoration:none;margin-top:4px;display:block;">$email</a>
            </td>
          </tr>
          <tr>
            <td style="padding:14px 20px;border-bottom:1px solid #e0dfd9;">
              <span style="font-size:11px;color:#9a9a94;text-transform:uppercase;letter-spacing:1px;font-weight:700;">Phone</span><br/>
              <span style="font-size:14px;color:#111110;font-weight:600;margin-top:4px;display:block;">$phone</span>
            </td>
          </tr>
          <tr>
            <td style="padding:14px 20px;border-bottom:1px solid #e0dfd9;">
              <span style="font-size:11px;color:#9a9a94;text-transform:uppercase;letter-spacing:1px;font-weight:700;">Service Interested In</span><br/>
              <span style="font-size:14px;color:#111110;font-weight:600;margin-top:4px;display:block;">$project</span>
            </td>
          </tr>
          <tr>
            <td style="padding:14px 20px;">
              <span style="font-size:11px;color:#9a9a94;text-transform:uppercase;letter-spacing:1px;font-weight:700;">Message</span><br/>
              <span style="font-size:14px;color:#5a5a55;line-height:1.7;margin-top:6px;display:block;">$message</span>
            </td>
          </tr>
        </table>

        <!-- CTA -->
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr><td align="center">
            <a href="mailto:$email" style="display:inline-block;background:#b8922a;color:#fff;text-decoration:none;padding:14px 32px;border-radius:3px;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;">Reply to $name</a>
          </td></tr>
        </table>
      </td></tr>

      <!-- Footer -->
      <tr><td style="background:#f5f4f0;border-radius:0 0 6px 6px;padding:24px 40px;text-align:center;border-top:1px solid #e0dfd9;">
        <p style="margin:0;font-size:11px;color:#9a9a94;">Received on $date</p>
        <p style="margin:6px 0 0;font-size:11px;color:#9a9a94;">© {$GLOBALS['year']} Renova Marketing Solutions — USA &amp; Canada</p>
      </td></tr>

    </table>
  </td></tr>
</table>
</body>
</html>
HTML;
}
$GLOBALS['year'] = date('Y');
