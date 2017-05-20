<?php
$user = $_POST['newUser'];
$message = "<html>
<head>
</head>
<body style=\"width:850px\">

	<table style=\"width:98%; text\">
    	<table id=\"header\">
        	<img src=\"http://leasemanage.info.tm/source/icons/logo.png\" height=\"200\">
    	</table>
        <table id=\"body\">
        <tr>
        <p>Your account is ready to be activated.</p></tr>
        <tr>
        <p>To confirm your account click the button or paste the link below in you web browser.</p></tr>
        <tr><td>
        <a style=\"text-decoration:none; padding:5px; background-color:#999;color:#000; text-align:center;\" href=\"http://leasemanage.info.tm/admin/confirmUser.php?user=". $user . "\" target=\"_blank\" >Get Managing</a></td></tr>
        <tr style=\"padding:5px;\"><td>
        <a href=\"http://leasemanage.info.tm/admin/confirmUser.php?user=". $user . "\" target=\"_blank\" >leasemanage.info.tm/admin/confirmUser.php?user=". $user . " </a></td></tr>
        </table>
        <table id=\"footer\">
        
        </table>
    </table>

</body>
</html>";
?>