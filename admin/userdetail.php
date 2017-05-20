<html>
<?php 
session_start();
include('pagebaseAdmin.php');
if (!checkAccess(1)){
    header('Location: ../_errorpages/403.html');
}
if (!isset($_GET['user'])){
    header('Location: manageUsers.php');
}
$user = $_GET['user'];

$userDet = "SELECT * FROM `users` WHERE user='" . $user . "'";
//$userdet = $db->prepare($userDet);
$userdet = $db->query($userDet);
$userdet = $userdet->fetchObject();
?>

<head>
<script type="text/javascript">
$(document).ready(function(e){
    var switchToInput = function () {
        var $input = $("<input>", {
            val: $(this).text(),
            type: "text"
        });
        $input.attr("ID", $(this).attr('id'));
        $(this).replaceWith($input);
        $input.on("blur", switchToSpan);
        $input.select();
    };
    var switchToSpan = function () {
        var $span = $("<span>", {
            text: $(this).val()
        });
        $span.attr("ID", $(this).attr('id'));
        $(this).replaceWith($span);
        $span.on("click", switchToInput);
    }


    $("#name").on("click", switchToInput);
    $("#usercode").on("click", switchToInput);
    $("#email").on("click", switchToInput);

  
    var fields = ['name'];

    var save = function () {
        var datastring = "";
        for (var index in fields) {
            datastring += fields[index] + '=' + document.getElementById(fields[index]).innerHTML + '&';
        }
        datastring = datastring.slice(0, -1);
        $.ajax({
            type: 'POST',
            url: "request/updateDevice.php",
            data: datastring,
            dataType: "JSON",
            success: function (res) {
                console.log(res);
                alert("Device Updated");
            },
            error: function (res) {
                console.log(res);
                alert("An Error Occur while updating the device. Please Try Again. If this error persists please contact your system administrator");
            },
        });
    }
    $("#save").on("click", save);


})

</script>

</head>




<body>
		<table>
			<?php  
				echo "<tr><td>User:</td><td><span id='name'>" . $userdet->name . "</span></td></tr>";
 				echo "<tr><td>User Code:</td><td><span id='usercode'>" . $userdet->user . "</span></td></tr>";
                echo "<tr><td>E-mail:</td><td><span id='email'>" . $userdet->email . "</span></td></tr>";
			?>
			<tr>
                <td>
                <input type="button" value="Save" id="save">
                </td>
            </tr>
		</table>
</body>
</html>