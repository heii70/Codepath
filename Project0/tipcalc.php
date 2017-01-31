<?php
//PHP handler code for the HTML form
$bill = $tip_percent = $tip = $total = ""; // Initalize variables
$persons = 1;
$bill_error = $custom_error = $split_error = false;
$check10 = $check15 = $check20 = $checkcustom = false; // keeps track of which radio button was selected when a new form is processed
$displaydiv1 = $displaydiv2 = false; // Displays/hides div1 & div2 outputs

function calc()
{
	// Calculates tip, total, and handles the div displays
	if(is_numeric($_POST['bill']) && $_POST['bill'] > 0)
	{
		// Bill amount must be a number that is greater than $0
		// The "global" keyword indicates that we are working with the global variable, otherwise PHP would create a local variable with the same name

		global $bill;
		global $persons;
		global $tip_percent;

		$bill = round($_POST['bill'],2); // Rounds the bill amount to two decimal places
		$persons = round($_POST['persons'],0,PHP_ROUND_HALF_UP); // Rounds number of persons up to the nearest whole number

		if($_POST['persons'] < 1) // Returns if the number of persons is less than 1
		{
			global $split_error;
			$split_error = true;
			return;
		}

		if($_POST['tip_percent'] == 'custom') 
		{
			// Handles custom tip percent
			if(!is_numeric($_POST['custom_percent']) || $_POST['custom_percent'] < 0) // Returns if the given custom_percent is invalid
			{
				global $custom_error;
				$custom_error = true;
				return;
			}
			$tip_percent = $_POST['custom_percent']*0.01;
		}
		else
		{
			// Handles normal tip percents
			$tip_percent = $_POST['tip_percent'];
		}

		global $tip;
		global $total;
		global $displaydiv1;
		global $displaydiv2;

		// Calculate values
		$tip = round($bill*$tip_percent,2);
		$total = $bill+$tip;

		if($persons > 1)
			$displaydiv2 = true; // displays div2 (Tip Each and Total Each) if the number of persons is greater than 1
		$displaydiv1 = true; // displays div1 (Bill, Tip, and Total)
	}
	elseif(isset($_POST['bill']))
	{
		// Triggers bill error if the bill is anything else that is non-numeric or less than or equal to 0
		// The isset function allows Null to be ignored, therefore the bill error isn't triggered the first time the application is launched

		global $bill_error;
		$bill_error = true;
	}
}

switch($_POST['tip_percent'])
{
	// Sets the propers bool to keep track of the current selected radio button
	case "0.10":
		$check10 = true;
		break;
	case "0.15":
		$check15 = true;
		break;
	case "0.20":
		$check20 = true;
		break;
	case "custom":
		$checkcustom = true;
		break;
	default:
		$check10 = true;
}

calc();

?>

<!DOCTYPE html>
<html>
<head> <!-- Where title of application, scripts, and styling goes -->
<title> TipCalc </title>
<style type="text/css">

	h1 {
		text-align: center;
		background-color: yellow;
		font-family: sans-serif;
	}

	body {

		position: absolute;
		border-style: solid;	
	}

	input[name="custom_percent"], input[name="persons"] {
    	
    	width: 35px;
	}

	#bill {

		<?php 
			if($bill_error == true)
			{
				echo "color: red";
			}	
		?>
	}

	#custom {

		<?php 
			if($custom_error == true)
			{
				echo "color: red";
			}	
		?>
	}

	#split {

		<?php 
			if($split_error == true)
			{
				echo "color: red";
			}	
		?>
	}

	#divmain {

		background-color: lightgreen;
	}

	#div1 {

		border-style: solid;
		border-color: lightblue;
		font-family: sans-serif;
		color: blue;
		background-color: pink;

		<?php 
			if($displaydiv1 == true) 
			{ 
				if($displaydiv2 == true)
					echo "border-bottom-style: none;"; // Removes the bottom border to merge with div2 below
				echo "display: block;"; 
			}
			else
			{ 
				echo "display: none;"; 
			} 
		?>
	}

	#div2 {

		border-style: solid;
		border-color: lightblue;
		font-family: sans-serif;
		color: blue;
		background-color: pink;

		<?php 
			if($displaydiv2 == true)
			{ 
				echo "display: block;"; 
				echo "border-top-style: none;"; // Removes the top border to merge with div1 above
			}
			else
			{ 
				echo "display: none;"; 
			} 
		?>
	}

	#calculate {

		align-content: center;
	}

</style>
</head>
<body>

<h1> Tip Calculator </h1> 

<!-- Main body of application -->
<div id="divmain">
	<form action="" method="post">
	<label id="bill"> Bill subtotal: $</label> <input type="text" name="bill" value="<?php echo $bill ?>">
	<br> <br>
	<label>Tip Percentage:</label> <br> <br>
	<?php
	// Creating radio buttons using a loop
	for($i = 0; $i < 3; $i++)
	{
		echo '<input type="radio" ';
		echo 'name="tip_percent" ';
		echo 'value="'.(0.10+0.05*$i).'" ';
		if(${'check'.(10+5*$i)} == true) { echo "checked"; }
		echo '>'.(10+5*$i).'%';
	}
	?>
	<input type="radio" name="tip_percent" id="custom%" value="custom" <?php if($checkcustom == true) { echo "checked"; } else { echo ""; } ?>> <label id="custom" for="custom%"> Custom: </label> <input type="text" name="custom_percent" value="<?php echo $_POST['custom_percent']; ?>"> %
	<!--
	<input type="radio" name="tip_percent" id="10%" value="0.10" <?php //if($check10 == true) { echo "checked"; } ?>> <label for="10%"> 10% </label>
	<input type="radio" name="tip_percent" id="15%" value="0.15" <?php //if($check15 == true) { echo "checked"; } ?>> <label for="15%"> 15% </label>
	<input type="radio" name="tip_percent" id="20%" value="0.20" <?php //if($check20 == true) { echo "checked"; } ?>> <label for="20%"> 20% </label> 
	-->
	<br> <br>
	<label id="split"> Split: </label> <input type="text" name="persons" value="<?php echo $persons ?>"> person(s)
	<br> <br>
	<div align="center">
	<input type="submit" id="calculate" value="Calculate">
	</div>
	</form>
</div>

<br>
<!-- div1 & div2 Outputs -->
<div id="div1">
<?php

	echo "Bill: $".$bill;
	echo "<br> <br>";
	echo "Tip: $".$tip;
	echo "<br> <br>";
	echo "Total: $".$total;
	echo "<br> <br>";

?>
</div>

<div id="div2">
<?php
	echo "Tip Each: $".round($tip/$persons,2);
	echo "<br> <br>";
	echo "Total Each: $".round($total/$persons,2);
	echo "<br>";
?>
</div>
<br>
</body>
</html>