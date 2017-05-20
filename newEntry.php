<?php

include('source/pagebase.php');
if (!checkAccess(1)){
	header('Location:  _errorpages/403.html');
}
?>

<head>
<script type="text/javascript" src="source/modernizr.js">
</script>

<script type="text/javascript">
if (!Modernizr.inputtypes.date) {
	alert("Use DD/MM/YYYY for date format");
};
</script>


<script type="text/javascript">	
function setDropdown() {
		var dropdownval = document.getElementById('DescriptionDropdown').value;
		if (dropdownval == "nul"){
			document.getElementById('DescriptionTextBox').style.display='';
			document.getElementById('DescriptionTextBox').value='';
		}else {
		document.getElementById('DescriptionTextBox').style.display='none'
		var dropdownval = document.getElementById('DescriptionDropdown').value;
		document.getElementById('DescriptionTextBox').value=dropdownval;
		}
	}
</script>

<script type="text/javascript">	
	$(document).ready(function () {
		$('#owned').click(function (){
			$(document).getElementById('assocList').display = 'none';
			$(document).getElementById('assocList').value = "";
		})
		$('#leased').click(function (){
			$(document).getElementById('assocList').display = 'normal';
		})
	})
</script>
<script>


</script>


<script type="text/javascript" src="source/jquery.js">
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('#deviceName').on('keypress', function(e) {
    	if (e.which == 32){
    	$('#deviceNameAlert').style.display = 'normal';
    	return false;}
    });
    $('input').on('keypress', function(e){
    	if (e.which == 220 || e.which == 191) {
    		return false;
    	};
    })

	$('#button').click(function() {
		$.ajax({
			type: 'POST',
			url: "request/saveDevice.php",
			data: $('form').serialize(),
			dataType: "JSON",
			success: function (res) {
				console.log(res["info"]);
				if (res['info'] == "off"){
					document.getElementById('deviceForm').reset();
					document.getElementById('DescriptionTextBox').style.display="";
				};
				alert("Device Successfully Added");
			},
			error: function (res) {
				console.log(res);
				alert("An Error Occur while adding the device. Please Try Again. If this error persists please contact your system administrator");
			},
		});
	});
});
</script>
</head>


<body>
<form action="" method="POST" id="deviceForm">
	<table>
		<tr>
            <td width='250'>Owned or Leased</td>
			<td width='350'>
				<input type='radio' name='ownedleased' value='owned' required id="lease">
				 Owned &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type='radio' name='ownedleased' value='leased' id='owned'>
				 Leased
			</td>
		</tr>
			<tr>
			<td width="250"><a href='#' class="tooltip">Description<span>Please select the MAKE/BRAND of device<br />Projectors, Apple TV's and other broadcasting devices are classified as "Visual Hardware"</span></a></td>
			<td width="350"><select name="DescriptionDropdown" id="DescriptionDropdown" onChange="setDropdown()">
			
				<option value="nul" selected>Use Textbox...</option>
								<?php
								$deviceTypes = fullQuery("SELECT * FROM `devicetypes`");
									while ($deviceMake = $deviceTypes->fetchObject()) {
										$value = $deviceMake->deviceType;
										echo "<option value='$value'>$value</option>";
									}
								?>
									</select><br><input type="text" name="Description" id="DescriptionTextBox" size="40" value="" required></td>
		</tr>
		<tr>
			<td width="250"><a href="#" class="tooltip">Device Name<span>Name of device (eg. A12-XX, MATH-NB-XX)</span></a></td>
			<td width="350"><input type="text" name="deviceName" size="40" required id="deviceName"/><span id='deviceNameAlert' style="display:none"><img src="source/icons/alert.jpg" class="errorImg"><span class="imgDescription">Device name cannot contain:<br /> Blank Spaces or Special Characters other than "-"</span></span></td>
		</tr>
		<tr>
			<td width="250">Full Description</td>
			<td width="350"><textarea name="FullDescription" rows="5" cols="43"></textarea></td>
		</tr>
		<tr>
			<td width="250"><a href="#" class="tooltip">Serial Number
            <span>This can generally be found on the underside of laptops or the back of other devices<br />Phone Serial number is under About Phone/Settings</span></a></td>
			<td width="350"><input type="text" name="SerialNumber" size="40" value="" required></td>
		</tr>
		
		<tr>
			<td width="250"><span id="assocList" style="display:none">Lease Association (Tela Lease Number)</span></td>
			<td width="350"><span id="assocList" style="display:none"><input type="text" name="asscoList" size="40" value=""></span></td>
			
		</tr>
		
		<tr>
			<td width="250"><a href="#" class="tooltip">Owner/Lease Holder<span>The person currently in possession of the device or location device can be located.<br />Leased items will have emails sent to the "Lease Holder" of a device in advance of the return date.</span></a></td>
			<td width="350"><input type="text" name="Owner" size="40" value="" required></td>
		</tr>
		<tr>
			<td width="250"><a href="#" class="tooltip">Purchased Date/Lease Return Date<span>Date device was purchased or the date that device lease expires. <br />If device is on lease the Lease Holder and Technology Managers will be notified by email prior to this date for return</span></a></td>
			<td width="350"><input type="date" name="PurchasedReceived" size="10" value="" required>
			</td>
		</tr>
		<tr>
			<td width="250">Purchase/Lease Price</td>
			<td width="350">$<input type="number" name="PurchasePrice" size="20" value="0.00" min="0" step='any' required></td>
		</tr>
		<tr>
			<td><a href='#' class='tooltip'>Keep Form Information<span>Selecting this will make the form REATAIN all fields of infomation upon submittal</span></a></td>
			<td><input type="checkbox" name="keepInfo" id='keepInfo'></td>
	<tr>
		<td colspan="2"><br><input type="button" id="button" value="Save"></td>
	</tr>
	</table>
</form>
</body>

</html>