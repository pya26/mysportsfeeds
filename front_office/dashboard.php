<?php

try {
			require '../config_files/_header.php';
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
			die();
		}


?>

<a href="<?php print $BASE_URL; ?>front_office/apis_and_parameters.php">Get APIs and their related parameters</a><br />
<a href="<?php print $BASE_URL; ?>getCurrentSeason.php">Get Current Season</a><br />
<a href="<?php print $BASE_URL; ?>getSeasonalVenues.php">Get MLB Teams and Venue Info</a><br />
<a href="<?php print $BASE_URL; ?>players.php">Get Players</a><br />
<a href="<?php print $BASE_URL; ?>injury.php">Get Injuries</a><br />
<a href="<?php print $BASE_URL; ?>getSeasonalStandings.php">Get Seasonal Standings</a><br />
<a href="<?php print $BASE_URL; ?>getSeasonalVenues.php">Get Seasonal Venues</a><br />
<a href="<?php print $BASE_URL; ?>player_stats_totals.php">Player Stats Totals</a><br />
<a href="<?php print $BASE_URL; ?>seasonal_games.php">Seasonal Games</a><br />
<a href="<?php print $BASE_URL; ?>seed_players_table.php">Seed players table</a><br />
<a href="<?php print $BASE_URL; ?>front_office/dashboard.php" id="test">Test</a><br /><br /><br />

<style>
 #mung {
 	display:none;
 }
</style>


<strong>SUPER ADMIN STUFF</strong><br />
Seed Players database table<br /><br />

 Date: <input id="date" type="text"/>

 <script type="text/javascript">
	$(document).ready(function(){
		//$("#date").datepicker();
		//$("#date").datepicker("setDate", new Date());
		$("#date").datepicker({			
			dateFormat: 'yymmdd',
			minDate: new Date()
		});
		
	    $("#date").datepicker( "option", "showAnim", "slideDown" );
	    
	});
</script>

    
<br /><br />
<?php
	require '../includes/functions.php';

	$api_info_array = get_api_and_params(3);
	print $api_info_array['api_name'].'<br />';
	print $api_info_array['api_desc'].'<br />';
	print $api_info_array['api_url'].'<br />';


	foreach($api_info_array as $key => $value) {
		if(is_array($value)){
			foreach($value as $key2 => $value2){
				$display_api_info = '<strong>'.$value2['api_param_name'].'</strong>'.' -- '.$value2['api_param_filter'];
				if(!empty($value2['api_param_desc'])){
					$display_api_info .= '<blockquote>'.$value2['api_param_desc'].'</blockquote>';
				}
				print $display_api_info;
			}
		}
	}



?>


<button>Toggle</button>
<div id="mung">
  This is the paragraph to end all paragraphs.  You
  should feel <em>lucky</em> to have seen such a paragraph in
  your life.  Congratulations!
</div>



<?php
try {
			require '../config_files/_footer.php';
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
			die();
		}	


		?>

<!--
<?php $BASE_URL; ?>
	-->