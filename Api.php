<?php
//======================================================================
// Risk cards tool API
//======================================================================


//-----------------------------------------------------
// Data declaration
//-----------------------------------------------------

$deck = array(
	'Alaska',
	'Alberta',
	'Central America',
	'Eastern United States',
	'Greenland',
	'Northwest Territory',
	'Ontario',
	'Quebec',
	'Western United States',
	'Argentina',
	'Brazil',
	'Peru',
	'Venezuela',
	'Great Britain',
	'Iceland',
	'Northern Europe',
	'Scandinavia',
	'Southern Europe',
	'Ukraine',
	'Western Europe',
	'Congo',
	'East Africa',
	'Egypt',
	'Madagascar',
	'North Africa',
	'South Africa',
	'Afghanistan',
	'China',
	'India',
	'Irkutsk',
	'Japan',
	'Kamchatka',
	'Middle East',
	'Mongolia',
	'Siam',
	'Siberia',
	'Ural',
	'Yakutsk',
	'Eastern Australia',
	'Indonesia',
	'New Guinea',
	'Western Australia');


$missions_nl = array(
	"White" => "Vernietig wit, als wit door iemand anders is vernietigd of je hebt zelf wit dan moet je 24 gebieden bezet houden",
	"Black" => "Destroy all Black troops. If yours are the Black Troops, then: Occupy 24 Territories of your choice",
	"Red" => "Vernietig rood, als rood door iemand anders is vernietigd of je hebt zelf rood dan moet je 24 gebieden bezet houden",
	"Blue" => "Vernietig blauw, als blauw door iemand anders is vernietigd of je hebt zelf blauw dan moet je 24 gebieden bezet houden",
	"Yellow" => "Vernietig geel, als geel door iemand anders is vernietigd of je hebt zelf geel dan moet je 24 gebieden bezet houden",
	"Green" => "Vernietig groen, als groen door iemand anders is vernietigd of je hebt zelf groen dan moet je 24 gebieden bezet houden",
	"Default-1" => "Verover de continenten Azie en Zuid Amerika",
	"Default-2" => "Verover de continenten Azie en Afrika",
	"Default-3" => "Verover de continenten Noord Amerika en Afrika",
	"Default-4" => "Verover de continenten Noord Amerika en Australie",
	"Default-5" => "Verover de continenten Europa en Zuid Amerika en een 3de continent naar keuze",
	"Default-6" => "Verover de continenten Europa en Australie en een 3de continent naar keuze",
	"Extra-1" => "Verover 18 gebieden naar keuze.Houd elk van deze 18 gebieden met tenminste 2 legers bezet.",
	"Extra-2" => "Verover 24 gebieden naar keuze.Je hoeft niet elk gebied met tenminste 2 legers bezet te houden."
);		

$missions = array(
	"White" => "Destroy all White troops. If yours are the White Troops, then: Occupy 24 Territories of your choice",
	"Black" => "Destroy all Black troops. If yours are the Black Troops, then: Occupy 24 Territories of your choice",
	"Red" => "Destroy all Red troops. If yours are the Red Troops, then: Occupy 24 Territories of your choice",
	"Blue" => "Destroy all Blue troops. If yours are the Blue Troops, then: Occupy 24 Territories of your choice",
	"Yellow" => "Destroy all Yellow troops. If yours are the Yellow Troops, then: Occupy 24 Territories of your choice",
	"Green" => "Destroy all Green troops. If yours are the Green Troops, then: Occupy 24 Territories of your choice",
	"Default-1" => "Conquer the Continents of Asia and South America",
	"Default-2" => "Conquer the Continents of Asia and Africa",
	"Default-3" => "Conquer the Continents of North America and Africa",
	"Default-4" => "Conquer the Continents of North America and Australia",
	"Default-5" => "Conquer 18 Territories of your choice and Occupy each with at least 2 Armies",
	"Default-6" => "Occupy 24 Territories of your choice",
	"Extra-1" => "Conquer the Continents Europe and South America and a Third Continent of your choice",
	"Extra-2" => "Conquer the Continents Europe and Australia and a Third Continent of your choice"
);

$playableColors = array(
	'White',
	'Black',
	'Red',
	'Blue',
	'Yellow',
	'Green');

$chosenPlayers = $_GET['players'];
$tempMis = $missions;
$_GET['players'] = ($_GET['players'] == 2) ? 3 : $_GET['players'];


//-----------------------------------------------------
// Helper functions
//-----------------------------------------------------


// This function is used to to slice the cards into unique decks
function partition(Array $list, $p) {
    $listlen = count($list);
    $partlen = floor($listlen / $p);
    $partrem = $listlen % $p;
    $partition = array();
    $mark = 0;
    for($px = 0; $px < $p; $px ++) {
        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
        $partition[$px] = array_slice($list, $mark, $incr);
        $mark += $incr;
    }
    return $partition;
}

// This function is to get a unique mission for each player
function getNextMission()
{
  global $missions;
  global $tempMis;
  $val = array_pop( $tempMis );

  if (is_null($val))
  {
    $tempMis = $missions;
    shuffle($tempMis);
    $val = getNextMission();
  }
  return $val;
}

// This function handles unique color assignment
function getNextColor($colors)
{
  global $tempColor;
  $val = array_pop( $tempColor );

  if (is_null($val))
  {
    $tempColor = $colors;
    shuffle($tempColor);
    $val = getNextColor();
  }
  return $val;
}

function randomCharCode(){
  $charset = "0123456789abcdefghijklmnopqrstuvwxyz";
  $base = strlen($charset);
  $result = '';

  $now = explode(' ', microtime())[1];
  while ($now >= $base){
    $i = $now % $base;
    $result = $charset[$i] . $result;
    $now /= $base;
  }
  return substr($result, -3);
}

// Shuffle the deck and mission cards
function shuffleCards($count){
	global $deck,$tempMis;
	for ($x = 0; $x <= $count; $x++) {
	    shuffle($deck);
	    shuffle($tempMis);
	} 
}

function removeNonPlayingColors($playingColors){
	global $missions,$playableColors;
	$removeArr = $playableColors;

	foreach ($color as $playingColors) {
		
	}

	for ($i=0; $i < $playingColors ; $i++) { 
		if (array_key_exists($playingColors[$i], $missions)) {
			unset($removeArr[$i]);
			 continue;
		}
		echo "unset";

		unset($missions[$i]);
	}
}


function getCardsForPlayer($color,$mission,$cards,$worldDomination){
?>
	<div class="slide">
	<h1 style="color:whitesmoke"><?php echo $color; ?> is next!</h1>
	</div>
    <div class="slide">
		<div class="jumbotron col-md-8">
	    	<h1>Player <?php echo $color; ?> - Cards: <?php echo count($cards); ?></h1>
		    <div class='row'>
	            <div class='panel panel-primary'>
	            	<?php if(!$worldDomination){ ?>
		                <div class='panel-heading clickable'>
		                    <h3 class='panel-title'>Secret mission</h3>
		                    <span class='pull-right '><i class='glyphicon glyphicon-minus'></i></span>
		                </div>
		                <div class='panel-body' hidden>
		                    <?php echo $mission; ?> 
		                </div>
	                <?php } ?>
	                	<ul class='list-group'> 
							<?php foreach ($cards as $card) {
								?><li class='list-group-item'><?php echo $card; ?></li>
							<?php } ?>
	 					</ul>
	 			</div>
	 		</div>
		</div>
	</div>
<?php }

function parseToJson($players,$colors,$variant){
	global $deck;
	//Remove non-playing colors
	//removeNonPlayingColors($colors);
	//Shuffle the deck 10 times
	shuffleCards(10);

	$jsonArray = array();
	
	foreach(partition($deck, $players) as $cards ) { 
		$mission = getNextMission();
		$color = getNextColor($colors);

		$arr =  array(
			        "Color" => $color,
			        "Mission" => $mission,
			        "Cards" => $cards,
			        "Code" => randomCharCode()
			    );
		array_push($jsonArray, $arr);
	}
	echo json_encode($jsonArray);
}

function parseHtml($players,$colors,$variant){
	global $deck,$missions;
//	removeNonPlayingColors($colors);

	shuffleCards(10);	
	$worldDomination = ($players < 3 ? true : false);
	foreach(partition($deck, $players) as $cards ) { 
		$mission = getNextMission();
		$color = getNextColor($colors);
		
		getCardsForPlayer($color,$mission,$cards,$worldDomination);
	}
}


//Start
$players = $_GET['players'];
$colors = explode(",", $_GET['colors']);
$variant = $_GET['variant'];
//header("Content-type: application/json; charset=utf-8");
//http_response_code(200);

//parseToJson($players,$colors);
parseHtml($players,$colors,$variant);

