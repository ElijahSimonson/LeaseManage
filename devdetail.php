<?php
if (!isset($_GET['serial'])){
	header("Location: devices.php");
	die();
}

?>


<html>
<?php 
    include('source/pagebase.php');
    if (!checkAccess(1)){
    header('Location: _errorpages/403.html');
}
$serial = $_GET['serial'];
$olcheck = "SELECT * FROM `ownedleased` WHERE serialNumber = '$serial'";
$ol = $db->query($olcheck);
$ol = $ol->fetchObject();
$ol = $ol->ownedleased;

if ($ol == 'leased'){
    $query = "SELECT * FROM `leased` WHERE serialNumber = '$serial'";
    $device = $db->query($query);
    $device = $device->fetchObject();
}else{
    $query = "SELECT * FROM `owned` WHERE serialNumber = '$serial'";
    $device = $db->query($query);
    $device = $device->fetchObject();
}

foreach ($device as $key => $value) {
    if($value == '' OR $value == null){
        $device->$key = 'Not Defined';
    }
}


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
    $("#owner").on("click", switchToInput);
    $("#description").on("click", switchToInput);
    $("#fullDesc").on("click", switchToInput);
    $("#date").on("click", switchToInput);
    $("#ol").on("click", switchToInput);
    $("#assocList").on("click", switchToInput); 
    $("#serialNumber").on("click", switchToInput);  
    <?php
        if ($ol == 'leased'){
            echo "var fields = ['name', 'owner', 'description', 'fullDesc', 'date', 'ownedleased', 'assocList',];";
        }else{
            echo "var fields = ['name', 'owner', 'description', 'fullDesc', 'date', 'ownedleased'];";
        }
    ?>
    var defaultValues = [];
    
        for (var index in fields) {
        defaultValues[fields[index]] = document.getElementById(fields[index]).innerHTML;
        }

        var reset = function () {
        for (var ind in defaultValues) {
            document.getElementById(ind).innerHTML = defaultValues[ind];
        };
    };

    $("#reset").on("click", reset);

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
				echo "<tr><td>Device Name:</td><td><span id='name'>" . $device->name . "</span></td></tr>";
 				echo "<tr><td>Owner:</td><td><span id='owner'>" . $device->owner . "</span></td></tr>";
 				echo "<tr><td>Owned/Leased:</td><td><span id='ownedleased'>" . $ol . "</span></td></tr>";
 				if ($ol == 'leased'){
 					echo "<tr><td>Lease List</td><td><span id='assocList'>" . $device->assocList . "</span></td></tr>";
 				}
 				echo "<tr><td>Date of Purchased/Return:</td><td><span id='date'>" . $device->date . "</span></td></tr>";
 				echo "<tr><td>Description:</td><td><span id='description'>" . $device->description . "</span></td></tr>";
 				echo "<tr><td>Full Description:</td><td><span id='fullDesc'>" . $device->fullDesc . "</span></td></tr>";
 				echo "<tr><td>Serial Number:</td><td><span id='serialNumber'>" . $device->serialNumber . "</span></td></tr>";
			?>
			<tr>
                <td>
                    <input type="button" value="Reset" id="reset">         
                </td>
                <td>
                <input type="button" value="Save" id="save">
                </td>
            </tr>
		</table>
</body>
</html>