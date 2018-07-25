<?php include('header.php'); ?>

<style>
.parent {
  position: relative;
  top: 0;
  left: 0;
}

.parent img {width: 300px;
	border: 0;}

.image1 {
  position: relative;
  top: 0;
  left: 0;
}
.image2 {
  position: absolute;
  top: 0;
  left: 0;
  display: none;
}

span.verySmall {font-size: 70%}

</style>

<script>

checkedCount = 0;
checkedPlaces = {};

moreInfoText = "<p>You indicated that you lived in more than one place between the ages of 5 and 15. Can you tell us <b>what ages</b> you lived in each of these places?</p> <ul>";

function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt){
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
}

function colormap(areaName) {
	if (areaName != 'other-country') { // color / uncolor map
		currentState = document.getElementById(areaName).style.display;
		if (currentState == 'block') {document.getElementById(areaName).style.display = 'none'}
		else {document.getElementById(areaName).style.display = 'block'};
	}
	if (areaName.substr(areaName.length - 1)!="2") {
		isClicked = document.getElementById(areaName + '-younger').checked;
		if (isClicked==true) {
			checkedCount++; 
			checkedPlaces[areaName] = 1;}
		else {checkedCount = checkedCount - 1;
			delete checkedPlaces[areaName]}
		if (checkedCount > 1) {
			resText = moreInfoText;
			for (placeName in checkedPlaces) {
				resLine = "<li>" + toTitleCase(placeName.replace('-', ' ')) +  ": <input type='text' name='" + areaName + "_age'> </li>";
				resText = resText + resLine;
			}
			document.getElementById('multiplePlaces').innerHTML = resText + "</ul>";
		}
		else {document.getElementById('multiplePlaces').innerHTML = ''}
	}
	console.log(checkedCount);
}


</script>

<table>
	<tr>
		<td>

<p class="question">Please check the places you lived <b>between the ages of 5 and 15</b>:</p>
England:</br />
<div style='padding-left: 40px; font-size: 80%' class="places">
	<input type="checkbox" name="east-anglia-younger" id="east-anglia-younger" onclick="colormap('east-anglia')" /> East Anglia <span class="verySmall">(Cambridgeshire, Norfolk, Suffolk)</span><br />
	<input type="checkbox" name="east-midlands-younger" id="east-midlands-younger" onclick="colormap('east-midlands')" /> East Midlands <span class="verySmall">(Derbyshire, Leicestershire, Lincolnshire, Northamptonshire, Nottinghamshire)</span><br />
	<input type="checkbox" name="greater-london-younger" id="greater-london-younger" onclick="colormap('greater-london')" /> Greater London<br />
	<input type="checkbox" name="north-east-younger" id="north-east-younger" onclick="colormap('north-east')" /> North East <span class="verySmall">(Durham, Newcastle, Northumberland, Teesside)</span><br />
	<input type="checkbox" name="north-west-younger" id="north-west-younger" onclick="colormap('north-west')" /> North West <span class="verySmall">(Cheshire, Cumbria, Lancashire, Manchester, Merseyside)</span><br />
	<input type="checkbox" name="south-east-younger" id="south-east-younger" onclick="colormap('south-east')" /> South East <span class="verySmall">(Bedfordshire, Berkshire, Buckinghamshire, Essex, Hampshire, Hertfordshire, Kent, Oxfordshire, Surrey, Sussex)</span><br />
	<input type="checkbox" name="south-west-younger" id="south-west-younger" onclick="colormap('south-west')" /> South West <span class="verySmall">(Avon/Bristol, Cornwall, Devon, Dorset, Gloucestershire, Somerset, Wiltshire)</span><br />
	<input type="checkbox" name="west-midlands-north-younger" id="west-midlands-north-younger" onclick="colormap('west-midlands-north')" /> West Midlands - Birmingham or north of Birmingham <span class="verySmall">(Shropshire, Staffordshire, West Midlands)</span><br />
	<input type="checkbox" name="west-midlands-south-younger" id="west-midlands-south-younger" onclick="colormap('west-midlands-south')" /> West Midlands - south of Birmingham <span class="verySmall">(Hereford and Worcestershire, Warwickshire)</span><br />
	<input type="checkbox" name="yorkshire-younger" id="yorkshire-younger" onclick="colormap('yorkshire')" /> Yorkshire and the Humber<br />
</div>
<input type="checkbox" name="northern-ireland-younger" id="northern-ireland-younger" onclick="colormap('northern-ireland')" /> Northern Ireland<br />
<input type="checkbox" name="scotland-younger" id="scotland-younger" onclick="colormap('scotland')" /> Scotland<br />
<input type="checkbox" name="wales-younger" id="wales-younger" onclick="colormap('wales')" /> Wales<br />
<input type="checkbox" name="other-country-younger" id="other-country-younger" onclick="colormap('other-country')" /> another country <span class="verySmall">(please specify)</span>: <input type="text" name="other-country-younger_text">


	</td>

	<td>
	<div class="parent">
	<img src="images/area_map_large.png" class="image1" />
	<img src="images/map_east-anglia.png" class="image2" id="east-anglia" />
	<img src="images/map_east-midlands.png" class="image2" id="east-midlands" />
	<img src="images/map_greater-london.png" class="image2" id="greater-london" />
	<img src="images/map_north-east.png" class="image2" id="north-east" />
	<img src="images/map_north-west.png" class="image2" id="north-west" />
	<img src="images/map_northern-ireland.png" class="image2" id="northern-ireland" />
	<img src="images/map_south-east.png" class="image2" id="south-east" />
	<img src="images/map_south-west.png" class="image2" id="south-west" />
	<img src="images/map_west-midlands-north.png" class="image2" id="west-midlands-north" />
	<img src="images/map_west-midlands-south.png" class="image2" id="west-midlands-south" />
	<img src="images/map_yorkshire.png" class="image2" id="yorkshire" />
	<img src="images/map_scotland.png" class="image2" id="scotland" />
	<img src="images/map_wales.png" class="image2" id="wales" />
	</div>
	</td>
	</tr>

	<tr>
	<td>
	<p class="question">Please check the places you have lived <b>since age 16 and older</b> (including where you live now):</p>

<div style='padding-left: 40px; font-size: 80%' class="places">
	<input type="checkbox" name="east-anglia-older" onclick="colormap('east-anglia2')" /> East Anglia <span class="verySmall">(Cambridgeshire, Norfolk, Suffolk)</span><br />
	<input type="checkbox" name="east-midlands-older" onclick="colormap('east-midlands2')" /> East Midlands <span class="verySmall">(Derbyshire, Leicestershire, Lincolnshire, Northamptonshire, Nottinghamshire)</span><br />
	<input type="checkbox" name="greater-london-older" onclick="colormap('greater-london2')" /> Greater London<br />
	<input type="checkbox" name="north-east-older" onclick="colormap('north-east2')" /> North East <span class="verySmall">(Durham, Newcastle, Northumberland, Teesside)</span><br />
	<input type="checkbox" name="north-west-older" onclick="colormap('north-west2')" /> North West <span class="verySmall">(Cheshire, Cumbria, Lancashire, Manchester, Merseyside)</span><br />
	<input type="checkbox" name="south-east-older" onclick="colormap('south-east2')" /> South East <span class="verySmall">(Bedfordshire, Berkshire, Buckinghamshire, Essex, Hampshire, Hertfordshire, Kent, Oxfordshire, Surrey, Sussex)</span><br />
	<input type="checkbox" name="south-west-older" onclick="colormap('south-west2')" /> South West <span class="verySmall">(Avon/Bristol, Cornwall, Devon, Dorset, Gloucestershire, Somerset, Wiltshire)</span><br />
	<input type="checkbox" name="west-midlands-north-older" onclick="colormap('west-midlands-north2')" /> West Midlands - Birmingham or north of Birmingham <span class="verySmall">(Shropshire, Staffordshire, West Midlands)</span><br />
	<input type="checkbox" name="west-midlands-south-older" onclick="colormap('west-midlands-south2')" /> West Midlands - south of Birmingham <span class="verySmall">(Hereford and Worcestershire, Warwickshire)</span><br />
	<input type="checkbox" name="yorkshire-older" onclick="colormap('yorkshire2')" /> Yorkshire and the Humber<br />
</div>
<input type="checkbox" name="northern-ireland-older" onclick="colormap('northern-ireland2')" /> Northern Ireland<br />
<input type="checkbox" name="scotland-older" onclick="colormap('scotland2')" /> Scotland<br />
<input type="checkbox" name="wales-older" onclick="colormap('wales2')" /> Wales<br />
<input type="checkbox" name="other-country-older" /> another country <span class="verySmall">(please specify)</span>: <input type="text" name="other-country-older_text">


	</td>

	<td>
	<div class="parent">
	<img src="images/area_map_large.png" class="image1" />
	<img src="images/map_east-anglia.png" class="image2" id="east-anglia2" />
	<img src="images/map_east-midlands.png" class="image2" id="east-midlands2" />
	<img src="images/map_greater-london.png" class="image2" id="greater-london2" />
	<img src="images/map_north-east.png" class="image2" id="north-east2" />
	<img src="images/map_north-west.png" class="image2" id="north-west2" />
	<img src="images/map_northern-ireland.png" class="image2" id="northern-ireland2" />
	<img src="images/map_south-east.png" class="image2" id="south-east2" />
	<img src="images/map_south-west.png" class="image2" id="south-west2" />
	<img src="images/map_west-midlands-north.png" class="image2" id="west-midlands-north2" />
	<img src="images/map_west-midlands-south.png" class="image2" id="west-midlands-south2" />
	<img src="images/map_yorkshire.png" class="image2" id="yorkshire2" />
	<img src="images/map_scotland.png" class="image2" id="scotland2" />
	<img src="images/map_wales.png" class="image2" id="wales2" />
	</div>
	</td>
	</tr>
</table>

<div id="multiplePlaces"></div>



<?php include('footer.php') ?>