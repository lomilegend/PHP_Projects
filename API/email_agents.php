<?php
$email_message = '<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>

    <style type="text/css">
    * { margin: 0; padding: 0; font-size: 100%; font-family: "Avenir Next", "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; line-height: 1.65; }

img { max-width: 100%; margin: 0 auto; display: block; }

body, .body-wrap { width: 100% !important; height: 100%; background: #f8f8f8; }

a { color: #71bc37; text-decoration: none; }

a:hover { text-decoration: underline; }

.text-center { text-align: center; }

.text-right { text-align: right; }

.text-left { text-align: left; }

.button { display: inline-block; color: white; background: #71bc37; border: solid #71bc37; border-width: 10px 20px 8px; font-weight: bold; border-radius: 4px; }

.button:hover { text-decoration: none; }

h1, h2, h3, h4, h5, h6 { margin-bottom: 20px; line-height: 1.25; }

h1 { font-size: 32px; }

h2 { font-size: 28px; }

h3 { font-size: 24px; }

h4 { font-size: 20px; }

h5 { font-size: 16px; }

p, ul, ol { font-size: 16px; font-weight: normal; margin-bottom: 20px; }

.container { display: block !important; clear: both !important; margin: 0 auto !important; max-width: 800px !important; }

.container table { width: 100% !important; border-collapse: collapse; }

.container .masthead { padding: 20px 0; background: #3781e2; color: white; }

.container .masthead h1 { margin: 0 auto !important; max-width: 90%; text-transform: uppercase; }

.container .content { background: white; padding: 30px 35px; }

.container .content.footer { background: none; }

.container .content.footer p { margin-bottom: 0; color: #888; text-align: center; font-size: 14px; }

.container .content.footer a { color: #888; text-decoration: none; font-weight: bold; }

.container .content.footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<table class="body-wrap">
    <tr>
        <td class="container">
            <!-- Message start -->
            <table>
                <tr>
                    <td align="center" class="masthead">
                        <h4>[Ticket#'.$issue_id.'] '.$subject.'</h4>

                    </td>
                </tr>
                <tr>
                    <td class="content">
                        <p>Dear '.$approver_name.',</p>
						 <p>This is to inform you that a request with the above Ticket ID has been logged on '.$application_name.'  with the following details for your resolution</b>:</p>
                        <p>Logged By <b>'.$username1.'</b></p>
                        <p>Issue Description <b>'.$description.'</b></p>
						
						<p>Issue Type <b>'.$issue_type.'</b></p>
						<p>Status <b>'.$status.'</b></p>
						<p>Date Logged <b>'.$issue_log_date.'</b></p>
						
						<p>MFB Name <b>'.$logged_for_name.'</b></p>
						
					<p>URL: <b><a href="https://nambuitsupport.inlaks.com/projecthelpdesk/viewassetdetails.php?cust_id=ISS,'.$issue_id.'"> <button>Click to View </button> </a></b></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="container">
            <table>
                <tr>
                    <td class="content footer" align="center">
                        <p>Sent by <a href="#">'.$application_name.'  </a></p>
                        <p>Powered by: Inlaks</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>';


//echo $email_message;



?>