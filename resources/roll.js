//This will take two strings a description string and roll string and it will split the roll text into 
//a list of rolls and then will convert the roll into numbers and roll dice, it will then replace the text in the description
//And return it
function getRolls(d, r){
	var description = d;
	var rolls = r.split(",");
	for(var i=0; i<rolls.length; i++){
		var die = dice(rolls[i]);
		description = description.replace(rolls[i], die.roll());
	}
	return description;
}

var dice = function(rollString){
	var that = {};
	var diceNumber = Number(rollString.split("d")[0]);
	var diceKind = Number(rollString.split("d")[1].split("+")[0]);
	var dieModifer = Number(rollString.split("+")[1]);
	
	function roll(){
		var total = 0;
		for(var i=0; i<diceNumber; i++){
			total += Math.floor((Math.random() * diceKind) + (dieModifer+1));
		}
		return total;
	}
	that.roll = roll;
	
	return that;
	
}