<html>
<head>
<link rel="stylesheet" type="text/css" href="source/styles.css">
<link rel="stylesheet" type="text/css" href="source/print.css">	
<script type="text/javascript" src="source/jquery.js"></script>
</head>
<body>
<?php

$qrDevs = $_POST;
$columns = 3;
?>
<div class="noPrint">
	<a href="#" onclick="window.print(); return false;"><img src="source\pictures\printButton.gif"></a>

</div>

<div>
	<?php 
		$currCol = 1;
		foreach ($qrDevs as $key => $value) {
		//echo $currCol;
		echo "<div style='display:inline-block'> 
			<img src='QRS/". $key . ".png'> <br> 
			<span style='text-align:center'>". $key . " </span><br>

			</div>";
		
		if ($currCol % $columns == 0){
			echo '<br>';
		}
		$currCol++;
		}
		
	?>
</div>
</body>
</html>