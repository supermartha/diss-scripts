<?php

if(isset($_POST['results']))
{
    $results = $_POST['results'];
    # First item of results is part #, use this to name file and set up CSV
    $part_num = $results[0];
    $results = array_slice($results, 1);
    $filename = 'results/part' . $part_num . '_' . $_COOKIE["ParticipantID"];

	$res_file = fopen($filename, "w") or die("Unable to open file!");

	$header = $part_num;

	if ($part_num == 1) {$header = "stimulus \t adj1 \t adj2 \t adj3 \t whereFrom \t comments \t timestamp \t x"; }
	elseif ($part_num == 3) {$header = "pair \t stimulus \t response \t timestamp \t x"; }
	elseif ($part_num == 4) {$header = "stimulus \t response \t timestamp \t x"; };

	fwrite($res_file, $header . "\n");

	foreach ($results as $item) {
		$item = explode(':',$item);
		foreach ($item as $element) {fwrite($res_file, $element . "\t"); };
		fwrite($res_file, "\n");
	}

	fclose($res_file);

}

?>