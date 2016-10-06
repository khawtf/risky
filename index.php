<?php 
//======================================================================
// Risk cards tool
//======================================================================


//-----------------------------------------------------
// Data declaration
//-----------------------------------------------------
$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

$thisUrl = 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];

$chosenPlayers = 4;

// Function to create the front end part for each player 


//-----------------------------------------------------
// Front end
//-----------------------------------------------------
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.8.6/jquery.fullPage.min.css" />
<link rel="stylesheet" type="text/css" href="css/home.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flat-ui/2.3.0/css/flat-ui.min.css">

<link rel="stylesheet" type="text/css" href="css/risky.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.8.6/vendors/jquery.easings.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.8.6/vendors/scrolloverflow.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.8.6/jquery.fullPage.min.js"></script>


<body>
<div id="fullpage">
	<div class="section fp-auto-height" id="section0" data-anchor="welcome">
	  <h1>Risk Cards Tool</h1>
	  <h4 color="whitesmoke">Lost your Risk Cards ? Use this handy tool</h4>
	</div>
	<div class="section" id="section2" data-anchor="players">
	    <?php if($chosenPlayers == 2 ){ ?>
			<h3> World Domination mode   
	    		<small>Third player is the static player</small>
			</h3>
		<?php } ?>
		<div class="row top-buffer" >
			<h2>How many players are there ?</h2>
			<div class="col-md-12">
				<div id="playersbtns" class="btn-group" data-toggle="buttons">
				  <label class="btn btn-primary btn-lg">
				    <input type="radio" name="options" id="option1" autocomplete="off" > 2
				  </label>
				  <label class="btn btn-primary btn-lg">
				    <input type="radio" name="options" id="option2" autocomplete="off"> 3
				  </label>
				  <label class="btn btn-primary btn-lg active">
				    <input type="radio" name="options" id="option3" autocomplete="off" checked> 4
				  </label>
				    <label class="btn btn-primary btn-lg">
				    <input type="radio" name="options" id="option3" autocomplete="off"> 5
				  </label>
				    <label class="btn btn-primary btn-lg">
				    <input type="radio" name="options" id="option3" autocomplete="off"> 6
				  </label>
				</div>
			</div>
		</div>
	</div>
	<div class="section fp-auto-height" id="section1" data-anchor="variant">
	  <h2>Choose Variant</h2>
	  	<div class="row" style="margin-bottom:20px">
			<div class="col-md-12">
				<div id="variantbtns" class="btn-group" data-toggle="buttons">
					<label class="btn btn-success btn-lg">
						<input type="radio" name="variants" value="US" autocomplete="off" >US variant<br>(12 missions)
					</label>
					<label class="btn btn-info btn-lg">
						<input type="radio" name="variants" value="EU" autocomplete="off">EU variant<br>(14 missions)
					</label>
				</div>
		  	</div>
		</div>
	</div>
	<div class="section" id="section3" data-anchor="colors">
		<div class="intro">
			<h1>Choose the color of the armies</h1>
		</div>
		<div class="row">
		<div class="col-md-4"> </div>
		<div class="col-md-2">
			<div id="colorsbtns" class="btn" data-toggle="buttons">
				<label class="btn btn-danger btn-lg btn-block">
				<input type="checkbox" value="Red" autocomplete="off"> Red
				</label>
				<label class="btn btn-info btn-lg btn-block">
				<input type="checkbox" value="Blue" autocomplete="off"> Blue
				</label>
				<label class="btn btn-default btn-lg btn-block">
				<input type="checkbox" value="White" autocomplete="off"> White
				</label>
			  </div>
		</div>
		<div class="col-md-2">
			<div id="colorsbtns" class="btn" data-toggle="buttons">
				<label class="btn btn-warning btn-lg btn-block">
				    <input type="checkbox" value="Yellow" autocomplete="off"> Yellow
				  </label>
				<label class="btn btn-inverse btn-lg btn-block">
				    <input type="checkbox" value="Black" autocomplete="off"> Black
				  </label>
				  <label class="btn btn-success btn-lg btn-block">
				    <input type="checkbox" value="Green" autocomplete="off"> Green
				  </label>
				  </div>
			</div>
			<div class="col-md-4"></div>
		</div>
			<div class="row top-buffer">
				<span><p id="cChosen">0 colors chosen</p></span>
				<button id="shuffleCards" class="btn btn-primary btn-lg" >Confirm & Deal cards</button>
			</div>
	</div>
</div>
</body>
<script src="js/risky.js"></script>

</html>





