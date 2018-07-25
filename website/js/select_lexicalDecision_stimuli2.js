function shuffleArray(array) {
    	for (var i = array.length - 1; i > 0; i--) {
        	var j = Math.floor(Math.random() * (i + 1));
        	var temp = array[i];
        	array[i] = array[j];
        	array[j] = temp;
    	}
	}

function randomSample(items, n) {
	shuffleArray(items);
	return(items.slice(0,n))
	}

realWords = [ "laugh","classy", "basket", "crafty", "rascals", "classes","nasty","gasping","lasting","blasted", "ask", "bath", "path", "fast", "task", "staff","grass","shaft","vast","draft","grasp","castle", "brass",'raft', "gas","baffled","raffle", "hassle", "massive","passage","athlete","classic","traffic","acid", "gasket","scaffold", "cattle", "rattle", "tackle", "paddle", "sadly","acted","exact","tracking", "tactic", "tablet", "rapids", "flattens", "dad","tag", "rap","glad", "trap", "snap", "crab","slack","strap","brag","stab", "tacky"];

realFillers = ["swiftly","sushi","buffet", "yoga", "robot", "shining","safety","silent", "crutches","werewolf", "lemons", "hope", "hop","mouse","point", "raised", "twin", "lungs","clouds", "cult","fleet","drown","faith","humble", "post","forest", "kittens","raincoat", "union","yelling", "replies","escape", "trumpet","hit","chip","duck", "sleep","bridge", "dust", "pulse", "plate","tense","neutral","snakes", "solved","size", "unsafe", "rainy","sewing", "onion",  "announce" ,"nicely", "locate", "subway", "ancient" , "unit", "rephrase", "sailboat" ,"swim","grill"];
nonWords = ['zoke', 'loofrey', 'zamel', 'booskit', 'crufty', 'boses', 'clusses', 'meesty', 'feyshing', 'swaping', 'plifted', 'moich', 'koog', 'thwep', 'bowft', 'shoines', 'kliz', 'sploon', 'flast', 'maffled', 'roffle', 'shipple', 'mussive', 'zoofudge', 'eefleet', 'cleesik', 'voldic', 'soozle', 'ketchel', 'tuckle', 'sudly', 'peighted', 'exokes', 'gweeching', 'vakkik', 'peeglet', 'geeshids', 'sparbens', 'joig', 'beeg', 'chesk', 'chaysp', 'leesk', 'frix', 'blaipes', 'proink', 'yolb', 'swunge', 'pape', 'guk', 'sloys', 'skick', 'splesh', 'stell', 'snaize', 'shayby', 'vedden', 'smasket', 'chake', 'geps', 'kaythe', 'yoth', 'scropes', 'skwooped', 'trilts', 'spleenk', 'spunt', 'shrench', 'frecks', 'gup', 'glice', 'glunge', 'delch', 'quarsk', 'creymp', 'splois', 'grarmph', 'swoosp', 'gweets', 'fresp'];

list1 = ["buffet" , "swunge" , "replies" , "clouds" , "sewing" , "ask" , "frix" , "kittens" , "robot" , "humble" , "gasket" , "acid" , "safety" , "yolb" , "silent" , "castle" , "kaythe" , "hop" , "nasty" , "drown" , "rainy" , "lasting" , "basket" , "skwooped" , "shoines" , "swiftly" , "hope" , "lungs" , "size" , "traffic" , "grarmph" , "glunge" , "tackle" , "bridge" , "shrench" , "scaffold" , "acted" , "escape" , "leesk" , "crufty" , "delch" , "loofrey" , "dad" , "unit" , "crutches" , "werewolf" , "koog" , "chesk" , "crafty" , "vast" , "yelling" , "sailboat" , "thwep" , "brag" , "staff" , "splesh" , "raffle" , "plifted" , "eefleet" , "beeg" , "massive" , "trilts" , "peeglet" , "pulse" , "snap" , "bowft" , "strap" , "tuckle" , "baffled" , "gweeching" , "soozle" , "dust" , "vakkik" , "maffled" , "clusses" , "sadly" , "tactic" , "ketchel" , "brass" , "classic" , "zamel" , "roffle" , "sploon" , "bath" , "rascals" , "chake" , "passage" , "glice" , "locate" , "crab" , "sloys" , "flattens" , "mouse" , "kliz" , "boses" , "yoga" , "sushi" , "fleet" , "chaysp" , "faith" , "quarsk" , "subway" , "swoosp" , "zoofudge" , "peighted" , "nicely" , "proink" , "meesty" , "sparbens" , "yoth" , "gasping" , "point" , "twin" , "tracking" , "classy" , "sudly" , "joig" , "ancient" , "grasp" , "neutral" , "scropes" , "raised" , "post" , "plate" , "exact" , "union" , "geps" , "hassle" , "blasted" , "booskit" , "shipple" , "gweets" , "shayby" , "classes" , "guk" , "stell" , "shining" , "gas" , "trap" , "solved" , "exokes" , "tag" , "stab" , "duck" , "trumpet" , "paddle" , "lemons" , "tacky" , "cleesik" , "flast" , "frecks" , "raincoat" , "tense" , "tablet" , "zoke" , "pape" , "mussive" , "slack" , "laugh" , "forest" , "glad" , "skick" , "smasket" , "announce" , "snaize" , "grass" , "fast" , "spleenk" , "raft" , "rephrase" , "task" , "cult" , "athlete" , "vedden" , "moich" , "path" , "grill" , "creymp" , "chip" , "shaft" , "draft" , "fresp" , "cattle" , "feyshing" , "geeshids" , "rapids" , "onion" , "blaipes" , "swaping" , "rattle" , "rap" , "swim" , "voldic" , "snakes" , "gup" , "sleep" , "spunt" , "unsafe" , "hit" , "splois"];
list2 = ["splois" , "hit" , "unsafe" , "spunt" , "sleep" , "gup" , "snakes" , "voldic" , "swim" , "rap" , "rattle" , "swaping" , "blaipes" , "onion" , "rapids" , "geeshids" , "feyshing" , "cattle" , "fresp" , "draft" , "shaft" , "chip" , "creymp" , "grill" , "path" , "moich" , "vedden" , "athlete" , "cult" , "task" , "rephrase" , "raft" , "spleenk" , "fast" , "grass" , "snaize" , "announce" , "smasket" , "skick" , "glad" , "forest" , "laugh" , "slack" , "mussive" , "pape" , "zoke" , "tablet" , "tense" , "raincoat" , "frecks" , "flast" , "cleesik" , "tacky" , "lemons" , "paddle" , "trumpet" , "duck" , "stab" , "tag" , "exokes" , "solved" , "trap" , "gas" , "shining" , "stell" , "guk" , "classes" , "shayby" , "gweets" , "shipple" , "booskit" , "blasted" , "hassle" , "geps" , "union" , "exact" , "plate" , "post" , "raised" , "scropes" , "neutral" , "grasp" , "ancient" , "joig" , "sudly" , "classy" , "tracking" , "twin" , "point" , "gasping" , "yoth" , "sparbens" , "meesty" , "proink" , "nicely" , "peighted" , "zoofudge" , "swoosp" , "subway" , "quarsk" , "faith" , "chaysp" , "fleet" , "sushi" , "yoga" , "boses" , "kliz" , "mouse" , "flattens" , "sloys" , "crab" , "locate" , "glice" , "passage" , "chake" , "rascals" , "bath" , "sploon" , "roffle" , "zamel" , "classic" , "brass" , "ketchel" , "tactic" , "sadly" , "clusses" , "maffled" , "vakkik" , "dust" , "soozle" , "gweeching" , "baffled" , "tuckle" , "strap" , "bowft" , "snap" , "pulse" , "peeglet" , "trilts" , "massive" , "beeg" , "eefleet" , "plifted" , "raffle" , "splesh" , "staff" , "brag" , "thwep" , "sailboat" , "yelling" , "vast" , "crafty" , "chesk" , "koog" , "werewolf" , "crutches" , "unit" , "dad" , "loofrey" , "delch" , "crufty" , "leesk" , "escape" , "acted" , "scaffold" , "shrench" , "bridge" , "tackle" , "glunge" , "grarmph" , "traffic" , "size" , "lungs" , "hope" , "swiftly" , "shoines" , "skwooped" , "basket" , "lasting" , "rainy" , "drown" , "nasty" , "hop" , "kaythe" , "castle" , "silent" , "yolb" , "safety" , "acid" , "gasket" , "humble" , "robot" , "kittens" , "frix" , "ask" , "sewing" , "clouds" , "replies" , "swunge" , "buffet"];
list3 = ["quarsk" , "subway" , "swoosp" , "zoofudge" , "peighted" , "nicely" , "proink" , "meesty" , "sparbens" , "yoth" , "gasping" , "point" , "twin" , "tracking" , "classy" , "sudly" , "joig" , "ancient" , "grasp" , "neutral" , "scropes" , "raised" , "post" , "plate" , "exact" , "union" , "geps" , "hassle" , "blasted" , "booskit" , "shipple" , "gweets" , "shayby" , "classes" , "guk" , "stell" , "shining" , "gas" , "trap" , "solved" , "exokes" , "tag" , "stab" , "duck" , "trumpet" , "paddle" , "lemons" , "tacky" , "cleesik" , "flast" , "frecks" , "raincoat" , "tense" , "tablet" , "zoke" , "pape" , "mussive" , "slack" , "laugh" , "forest" , "glad" , "skick" , "smasket" , "announce" , "snaize" , "grass" , "fast" , "spleenk" , "raft" , "rephrase" , "task" , "cult" , "athlete" , "vedden" , "moich" , "path" , "grill" , "creymp" , "chip" , "shaft" , "draft" , "fresp" , "cattle" , "feyshing" , "geeshids" , "rapids" , "onion" , "blaipes" , "swaping" , "rattle" , "rap" , "swim" , "voldic" , "snakes" , "gup" , "sleep" , "spunt" , "unsafe" , "hit" , "splois" , "buffet" , "swunge" , "replies" , "clouds" , "sewing" , "ask" , "frix" , "kittens" , "robot" , "humble" , "gasket" , "acid" , "safety" , "yolb" , "silent" , "castle" , "kaythe" , "hop" , "nasty" , "drown" , "rainy" , "lasting" , "basket" , "skwooped" , "shoines" , "swiftly" , "hope" , "lungs" , "size" , "traffic" , "grarmph" , "glunge" , "tackle" , "bridge" , "shrench" , "scaffold" , "acted" , "escape" , "leesk" , "crufty" , "delch" , "loofrey" , "dad" , "unit" , "crutches" , "werewolf" , "koog" , "chesk" , "crafty" , "vast" , "yelling" , "sailboat" , "thwep" , "brag" , "staff" , "splesh" , "raffle" , "plifted" , "eefleet" , "beeg" , "massive" , "trilts" , "peeglet" , "pulse" , "snap" , "bowft" , "strap" , "tuckle" , "baffled" , "gweeching" , "soozle" , "dust" , "vakkik" , "maffled" , "clusses" , "sadly" , "tactic" , "ketchel" , "brass" , "classic" , "zamel" , "roffle" , "sploon" , "bath" , "rascals" , "chake" , "passage" , "glice" , "locate" , "crab" , "sloys" , "flattens" , "mouse" , "kliz" , "boses" , "yoga" , "sushi" , "fleet" , "chaysp" , "faith"];
list4 = ["faith" , "chaysp" , "fleet" , "sushi" , "yoga" , "boses" , "kliz" , "mouse" , "flattens" , "sloys" , "crab" , "locate" , "glice" , "passage" , "chake" , "rascals" , "bath" , "sploon" , "roffle" , "zamel" , "classic" , "brass" , "ketchel" , "tactic" , "sadly" , "clusses" , "maffled" , "vakkik" , "dust" , "soozle" , "gweeching" , "baffled" , "tuckle" , "strap" , "bowft" , "snap" , "pulse" , "peeglet" , "trilts" , "massive" , "beeg" , "eefleet" , "plifted" , "raffle" , "splesh" , "staff" , "brag" , "thwep" , "sailboat" , "yelling" , "vast" , "crafty" , "chesk" , "koog" , "werewolf" , "crutches" , "unit" , "dad" , "loofrey" , "delch" , "crufty" , "leesk" , "escape" , "acted" , "scaffold" , "shrench" , "bridge" , "tackle" , "glunge" , "grarmph" , "traffic" , "size" , "lungs" , "hope" , "swiftly" , "shoines" , "skwooped" , "basket" , "lasting" , "rainy" , "drown" , "nasty" , "hop" , "kaythe" , "castle" , "silent" , "yolb" , "safety" , "acid" , "gasket" , "humble" , "robot" , "kittens" , "frix" , "ask" , "sewing" , "clouds" , "replies" , "swunge" , "buffet" , "splois" , "hit" , "unsafe" , "spunt" , "sleep" , "gup" , "snakes" , "voldic" , "swim" , "rap" , "rattle" , "swaping" , "blaipes" , "onion" , "rapids" , "geeshids" , "feyshing" , "cattle" , "fresp" , "draft" , "shaft" , "chip" , "creymp" , "grill" , "path" , "moich" , "vedden" , "athlete" , "cult" , "task" , "rephrase" , "raft" , "spleenk" , "fast" , "grass" , "snaize" , "announce" , "smasket" , "skick" , "glad" , "forest" , "laugh" , "slack" , "mussive" , "pape" , "zoke" , "tablet" , "tense" , "raincoat" , "frecks" , "flast" , "cleesik" , "tacky" , "lemons" , "paddle" , "trumpet" , "duck" , "stab" , "tag" , "exokes" , "solved" , "trap" , "gas" , "shining" , "stell" , "guk" , "classes" , "shayby" , "gweets" , "shipple" , "booskit" , "blasted" , "hassle" , "geps" , "union" , "exact" , "plate" , "post" , "raised" , "scropes" , "neutral" , "grasp" , "ancient" , "joig" , "sudly" , "classy" , "tracking" , "twin" , "point" , "gasping" , "yoth" , "sparbens" , "meesty" , "proink" , "nicely" , "peighted" , "zoofudge" , "swoosp" , "subway" , "quarsk"];

function getBlock(listObject) {
	block1 = [];
	listObject.forEach(function(word) {
		if (realWords.includes(word)==true) {block1.push('south-f-1_' + word + '_bath')}
		else {block1.push('south-f-1_' + word)}
	});
	console.log(block1);
}

// First, randomly choose on one the four lists
listObject = randomSample([list1, list2, list3, list4], 1);

// Then make the list
getBlock(listObject[0]);


stimuli = block1;

console.log(stimuli.length);


