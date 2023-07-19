<?php
session_start();
require_once '../vendor/autoload.php';
require_once 'conn.php';
require_once 'header.php';
require_once 'decodeToken.php';
require_once 'checkHeader.php';

if (!isset($_POST['email']) || !isset($_POST['name']) || !isset($_POST['surname'])) {
  echo json_encode("False");
  $eid->close();
  exit;
}
$email = $_POST['email'];
$name = $_POST['name'];
$surname = $_POST['surname'];
// Check if username
$ch_user = $eid->prepare("SELECT email FROM user WHERE email = ?");
$ch_user->bind_param('s', $email);
$ch_user->execute();
$ch_user->get_result();
if ($ch_user->num_rows > 0) {
  echo json_encode("Email already in use.");
  $eid->close();
  exit;
}
$exp = time() + 60*60*24;
$acc = $eid->prepare("INSERT INTO pending_accounts (email, name, surname, expires) VALUES (?,?,?,?)");
$acc->bind_param("ssss", $email, $name, $surname, $exp);
$acc->execute();

$subject = 'Potrditev računa za aplikacijo E-dentiteta';
$htmlContent = '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <title>MOSAICO Responsive Email Designer</title>
  
  <style type="text/css">
    body{ margin: 0; padding: 0; }
    img{ border: 0px; display: block; }

    .socialLinks{ font-size: 6px; }
    .socialLinks a{
      display: inline-block;
    }

    .long-text p{ margin: 1em 0px; }
    .long-text p:last-child{ margin-bottom: 0px; }
    .long-text p:first-child{ margin-top: 0px; }
  </style>
  <style type="text/css">
    /* yahoo, hotmail */
    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{ line-height: 100%; }
    .yshortcuts a{ border-bottom: none !important; }
    .vb-outer{ min-width: 0 !important; }
    .RMsgBdy, .ExternalClass{
      width: 100%;
      background-color: #3f3f3f;
      background-color: #548dd4}

    /* outlook/office365 add buttons outside not-linked images and safari have 2px margin */
    [o365] button{ margin: 0 !important; }

    /* outlook */
    table{ mso-table-rspace: 0pt; mso-table-lspace: 0pt; }
    #outlook a{ padding: 0; }
    img{ outline: none; text-decoration: none; border: none; -ms-interpolation-mode: bicubic; }
    a img{ border: none; }

    @media screen and (max-width: 600px) {
      table.vb-container, table.vb-row{
        width: 95% !important;
      }

      .mobile-hide{ display: none !important; }
      .mobile-textcenter{ text-align: center !important; }

      .mobile-full{ 
        width: 100% !important;
        max-width: none !important;
      }
    }
    /* previously used also screen and (max-device-width: 600px) but Yahoo Mail doesnt support multiple queries */
  </style>
  <style type="text/css">
    
    #ko_textBlock_1 .links-color a, #ko_textBlock_1 .links-color a:link, #ko_textBlock_1 .links-color a:visited, #ko_textBlock_1 .links-color a:hover{
      color: #3f3f3f;
      color: #3f3f3f;
      text-decoration: underline
    }
    
    # .links-color a, # .links-color a:link, # .links-color a:visited, # .links-color a:hover{
      color: #cccccc;
      color: #002060;
      text-decoration: underline
    }
    </style>
  
</head>
<!--[if !(gte mso 16)]-->
<body bgcolor="#548dd4" text="#000000" alink="#002060" vlink="#002060" style="margin: 0; padding: 0; background-color: #548dd4; color: #000000;"><!--<![endif]--><center>

  

  <table role="presentation" class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#548dd4" id="ko_titleBlock_1" style="background-color: #548dd4">
      <tbody><tr><td class="vb-outer" align="center" valign="top" style="padding-left: 9px; padding-right: 9px; font-size: 0">
      <!--[if (gte mso 9)|(lte ie 8)]><table role="presentation" align="center" border="0" cellspacing="0" cellpadding="0" width="570"><tr><td align="center" valign="top"><![endif]--><!--
      --><div style="margin: 0 auto; max-width: 570px; -mru-width: 0px"><table role="presentation" border="0" cellpadding="0" cellspacing="0" bgcolor="#b8cce4" width="570" class="vb-row" style="border-collapse: separate; width: 100%; background-color: #b8cce4; mso-cellspacing: 0px; border-spacing: 0px; max-width: 570px; -mru-width: 0px">
        
        <tbody><tr>
      <td align="center" valign="top" style="font-size: 0; padding: 0 9px"><div style="vertical-align: top; width: 100%; max-width: 552px; -mru-width: 0px"><!--
        --><table role="presentation" class="vb-content" border="0" cellspacing="9" cellpadding="0" style="border-collapse: separate; width: 100%; mso-cellspacing: 9px; border-spacing: 9px" width="552">
          
          <tbody><tr>
      <td width="100%" valign="top" align="center" style="font-weight: normal; color: #3f3f3f; font-size: 22px; font-family: Arial, Helvetica, sans-serif; text-align: center"><span style="font-weight: normal"><strong>POTRDITEV RAČUNA ZA APLIKACIJO <br>E-DENTITETA</strong><br data-mce-bogus="1"></span></td>
    </tr>
        
        </tbody></table></div></td>
    </tr>
      
      </tbody></table></div><!--
    --><!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
    </td></tr>
    </tbody></table><table role="presentation" class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#548dd4" id="ko_textBlock_1" style="background-color: #548dd4">
      <tbody><tr><td class="vb-outer" align="center" valign="top" style="padding-left: 9px; padding-right: 9px; font-size: 0">
      <!--[if (gte mso 9)|(lte ie 8)]><table role="presentation" align="center" border="0" cellspacing="0" cellpadding="0" width="570"><tr><td align="center" valign="top"><![endif]--><!--
      --><div style="margin: 0 auto; max-width: 570px; -mru-width: 0px"><table role="presentation" border="0" cellpadding="0" cellspacing="18" bgcolor="#b8cce4" width="570" class="vb-container" style="border-collapse: separate; width: 100%; background-color: #b8cce4; mso-cellspacing: 18px; border-spacing: 18px; max-width: 570px; -mru-width: 0px">
        
        <tbody><tr><td class="long-text links-color" width="100%" valign="top" align="left" style="font-weight: normal; color: #3f3f3f; font-size: 13px; font-family: Arial, Helvetica, sans-serif; text-align: left; line-height: normal"><p style="margin: 1em 0px; margin-top: 0px;">&nbsp;</p>
<p style="margin: 1em 0px;">Pozdravljeni!</p>
<p style="margin: 1em 0px;">Sistemski administrator vaše organizacije je za Vas ustvaril račun za aplikacijo E-dentitteta.</p>
<p style="margin: 1em 0px;">Če želite do aplikacije dostopati, vaš račun prosimo potrdite na spodnji povezavi.</p>
<p style="margin: 1em 0px;">&nbsp;</p>
<p style="margin: 1em 0px; margin-bottom: 0px;">&nbsp;</p></td></tr>
      
      </tbody></table></div><!--
    --><!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
    </td></tr>
    </tbody></table><table role="presentation" class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#548dd4" id="ko_buttonBlock_1" style="background-color: #548dd4">
      <tbody><tr><td class="vb-outer" align="center" valign="top" style="padding-left: 9px; padding-right: 9px; font-size: 0">
      <!--[if (gte mso 9)|(lte ie 8)]><table role="presentation" align="center" border="0" cellspacing="0" cellpadding="0" width="570"><tr><td align="center" valign="top"><![endif]--><!--
      --><div style="margin: 0 auto; max-width: 570px; -mru-width: 0px"><table role="presentation" border="0" cellpadding="0" cellspacing="18" bgcolor="#b8cce4" width="570" class="vb-container" style="border-collapse: separate; width: 100%; background-color: #b8cce4; mso-cellspacing: 18px; border-spacing: 18px; max-width: 570px; -mru-width: 0px">
        
        <tbody><tr>
      <td valign="top" align="center"><table role="presentation" cellpadding="12" border="0" align="center" cellspacing="0" style="border-spacing: 0; mso-padding-alt: 12px 12px 12px 12px"><tbody><tr>
        <td width="auto" valign="middle" align="center" bgcolor="#8db3e2" style="text-align: center; font-weight: normal; padding: 12px; padding-left: 14px; padding-right: 14px; background-color: #8db3e2; color: #000000; font-size: 20px; font-family: Times New Roman, Times, serif; border-radius: 7px"><a style="text-decoration: none; font-weight: normal; color: #000000; font-size: 20px; font-family: Times New Roman, Times, serif" target="_new" href="https://e-dentiteta.usdd.company/add_acc?uem='.$email.'"><em><strong>POTRDITEV RAČUNA</strong></em><br data-mce-bogus="1"></a></td>
      </tr></tbody></table></td>
    </tr>
      
      </tbody></table></div><!--
    --><!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
    </td></tr>
    </tbody></table>
    
</center><!--[if !(gte mso 16)]--></body><!--<![endif]--></html>';
$headers = array(
  'From' => 'accounts@usdd.company',
  'Reply-To' => 'accounts@usdd.company',
  'X-Mailer' => 'PHP/' . phpversion(),
  'MIME-Version' => '1.0',
  'Content-type' => 'text/html;charset=UTF-8'
  
);
mail($email, $subject, $htmlContent, $headers);

//If everything is ok return "true"
echo json_encode("true");
$eid->close();
$conn->close();
exit;
?>