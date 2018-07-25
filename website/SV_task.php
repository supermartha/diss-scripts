<?php include('header.php'); ?>

<script src="js/select_SV_stimuli.js"> </script>

<script>
var results = [4];
var stimuli_dir = "sounds/sentenceVersionPilot/";
var max = 30; // how many stimuli should each participant hear
var count = 0;
all_items = ['q1a', 'q1b', 'q2a', 'q2b', 'q3a', 'q3b', 'q4a', 'q4b', 'q5a', 'q5b', 'q6a', 'q6b', 'q7a', 'q7b'];
clickedDict = {}; // Dictionary of which buttons are clicked
// Populate dictionary
all_items.forEach(function(item) {
	clickedDict[item] = 0;
});
 
 window.onload = function() {
    document.getElementById('audioA').src = stimuli_dir + stimuliA[0] + '.wav';
    document.getElementById('audioB').src = stimuli_dir + stimuliB[0] + '.wav';
  }

function chooseButton(buttonID, oppositeButtonID) {
	document.getElementById(buttonID).style.background = "#21bfb9";
	document.getElementById(buttonID).style.color = "#fff";
	document.getElementById(oppositeButtonID).style.background = "none";
	document.getElementById(oppositeButtonID).style.color = "#333333";
	clickedDict[buttonID] = 1;
	clickedDict[oppositeButtonID]= 0;
}

function play(audioName) {
    document.getElementById(audioName).play();
}

function changeText() {
count = count + 1;
if (count == max) {
  sendResults();;
  }
else {
	all_items.forEach(function(item) {
		document.getElementById(item).style.background = '#bcbcbc';
		document.getElementById(item).style.color = "#333333";
	});
 	document.getElementById('progressbar').value = document.getElementById('progressbar').value + 1;
  document.getElementById('completed_count').innerHTML = document.getElementById('progressbar').value;
  document.getElementById('comments').value = '';
  document.getElementById('audioA').src = stimuli_dir + stimuliA[count] + '.wav';
  document.getElementById('audioB').src = stimuli_dir + stimuliB[count] + '.wav';
  }
}

function sendResults(){
  document.getElementById('main').innerHTML = "<p>...saving responses...</p>"
    $.ajax({url: 'save_data.php',
    data: {results : results},
    type: 'POST',
    success: function(){location.href='SVP_part3_instructions.php'}} // Redirect to demographics/Br Eng questionnaire when finished
    );
  }

  function record_responses() {
  	console.log('sup');
    responses = [stimuliA[count], stimuliB[count]];
    for (var n = 1; n < 8; n++) {
    	console.log(n);
    	itemA = clickedDict['q' + n + 'a'];
    	itemB = clickedDict['q' + n + 'b'];
    	if (itemA == 1) {responses.push('A')}
    	else if (itemB == 1) {responses.push('B')}
    	else {responses.push('neither')}
    }
	responses.push(document.getElementById('comments').value, Date.now()); 
    results.push(responses.join(':'));
    console.log(results)
    changeText();
  }

</script>

<table class="sentence_version">
<tr>
	<td></td>
	<td><a href="#/" onClick="play('audioA')">
<div class="audio2">
<audio id="audioA" src="daniel_stimuli/DL_northern_bath.wav"></audio>
<img src="speaker.png" width=100px /><br />
<div id="replay_text">A</div>
</div>
</a></td>
	<td><a href="#/" onClick="play('audioB')">
<div class="audio2">
<audio id="audioB" src="daniel_stimuli/DL_southern_bath.wav"></audio>
<img src="speaker.png" width=100px /><br />
<div id="replay_text">B</div>
</div>
</a></td>
</tr>

<tr>
	<td class="openingQuestion"><b>Which version sounds more...</b></td>
	<td><p class="smaller" style="font-style: italic">Click to play</p></td>
	<td></td>
</tr>
<tr>
	<td>... educated?</td>
	<td><div class="check" id="q1a" onclick="chooseButton('q1a', 'q1b')">A</div></td>
	<td><div class="check" id="q1b" onclick="chooseButton('q1b', 'q1a')">B</div></td>
</tr>

<tr>
	<td>... working class?</td>
	<td><div class="check" id="q2a" onclick="chooseButton('q2a', 'q2b')">A</div></td>
	<td><div class="check" id="q2b" onclick="chooseButton('q2b', 'q2a')">B</div></td>
</tr>

<tr>
	<td>... correct?</td>
	<td><div class="check" id="q3a" onclick="chooseButton('q3a', 'q3b')">A</div></td>
	<td><div class="check" id="q3b" onclick="chooseButton('q3b', 'q3a')">B</div></td>
</tr>

<tr>
	<td>... like the person wants to sound posh?</td>
	<td><div class="check" id="q4a" onclick="chooseButton('q4a', 'q4b')">A</div></td>
	<td><div class="check" id="q4b" onclick="chooseButton('q4b', 'q4a')">B</div></td>
</tr>

<tr>
	<td>... like the person is from the south of England?</td>
	<td><div class="check" id="q5a" onclick="chooseButton('q5a', 'q5b')">A</div></td>
	<td><div class="check" id="q5b" onclick="chooseButton('q5b', 'q5a')">B</div></td>
</tr>

<tr>
	<td>... like the person is faking an accent?</td>
	<td><div class="check" id="q6a" onclick="chooseButton('q6a', 'q6b')">A</div></td>
	<td><div class="check" id="q6b" onclick="chooseButton('q6b', 'q6a')">B</div></td>
</tr>

<tr>
	<td>... like the person comes from a wealthy background?</td>
	<td><div class="check" id="q7a" onclick="chooseButton('q7a', 'q7b')">A</div></td>
	<td><div class="check" id="q7b" onclick="chooseButton('q7b', 'q7a')">B</div></td>
</tr>


<tr>
	<td><p class="question">Comments (optional):</p> <textarea name="comments" id="comments" rows="5" cols="40"></textarea></td>
	<td style="vertical-align: bottom;"><a href="#"><div class="button" onclick="record_responses()"> Next </div> </a></td>
	<td></td>
</tr>

</table>

<div style="text-align: center;">

<br /><br />
<br /><br /><br />
<progress max="30" value="1" id="progressbar"></progress>  <span class="progress_count"> <span id="completed_count">1</span> / 30 </span>
<br /><br />
</div>

<?php include('footer.php'); ?>