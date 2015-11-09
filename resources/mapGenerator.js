var sizeHash = {"S": 6, "M": 8, "L":12};

//Map object, has methods for interfacing with map of tiles
var map = function(t){
	var that = {};
	var tiles = t;
	var activeTiles =[];
	var maxTiles = {"S": 20, "M": 40, "L": 80};

	//finds the map size based on the number of rows
	function getSize(){
		return (_.invert(sizeHash))[tiles[0].length];
		} 
	
	//will return true if the map has the specifed number active tiles based on size
	function mapFull(){
		return activeTiles.length >= maxTiles[getSize()];
	}
	that.mapFull = mapFull;

	//Returns a random active tile
	function getRandomActive(){
		return activeTiles[getRandomNormal(activeTiles.length)];
	}
	that.getRandomActive = getRandomActive;

	//Will see if any of the surrounding tiles are active based off direction
	function noneAround(t, d){
		var lookOne; var lookTwo;
		//going up or down will look left and right
		if(d==0 || d==1){
			lookOne = move(t, 2);
			lookTwo = move(t, 3);
		}
		// right or left will look up and down
		else{
			lookOne = move(t,0);
			lookTwo = move(t,1);
		}
		//If both tiles are either null or inactive it will return true
		return (lookOne==null || !active(lookOne)) && (lookTwo == null || !active(lookTwo));
	}
	that.noneAround = noneAround;
	
	//returns all tiles 
	function getTiles(){
		return tiles;
	}
	that.getTiles = getTiles;
	
	//returns tile of specifed location, if tile doesn't exist it will return null
	function get(x,y){
		return vaildTile(x,y) ? {"x" : x, "y" : y} : null;
	}
	that.get = get;

	//Will check to see if requested tile exists in grid, returns false if tile is invaild
	function vaildTile(x,y){
		return (x>=0 && y>=0 && x<tiles[0].length && y<tiles[0].length);
	}

	//Will set the value of a specifyed tile, if tile does not exist will return false
	function set(t, value){
		if(vaildTile(t.x,t.y)){
			tiles[t.y][t.x]=value;
			activeTiles.push(t);
			return true;
		}
		return false;
	}
	that.set = set;

	//Will check to see if specifed tile already has a value
	function active(t){
		for(var i=0; i<activeTiles.length; i++){
			var at = activeTiles[i];
			if(at.x == t.x && at.y == t.y){return true;}
		}
		return false;
	}
	that.active = active;

	//Will return the tile in the direction specified
	//0 == down, 1 == up, 2 == left, 3 == right
	//Will return null if tile doesn't exist
	function move(s, d){
		if(d==0){return get(s.x, s.y+1);}
		else if(d==1){return get(s.x, s.y-1);}
		else if(d==2){return get(s.x+1, s.y);}
		else{return get(s.x-1, s.y);}
	}
	that.move = move;
	
	return that;
}

function drawMap(tiles){
		var c = document.getElementById("mapDisplay");
		var tileSize = 16; var mapSize = tiles[0].length
		var colors = { 
				"x" : "#FFFFFF", "s" : "#006400",
				"t" : "#DC143C", "w" : "#A9A9A9"
					}
		
		var ctx = c.getContext("2d");
		//Clear canvas
		ctx.clearRect (0, 0, 384, 384);
		
		var yStart=0;
		for(var y=0; y<mapSize; y++){
			var xStart = 0;
			for(var x=0; x<mapSize; x++){
				ctx.fillStyle = colors[tiles[y][x]];
				ctx.fillRect(xStart,yStart,tileSize, tileSize/2);
				xStart += tileSize;
			}
			yStart += (tileSize/2);
		}
		
	}

//Will return a randomly generated map
function generateMap(size){
	//Start by finding the size if it dons't exist
	var t = getBlankMap(size);
	//Create a map object out of the a blank map
	var m = map(t);
	//Sets map start
	var tile = m.get(getRandomNormal(sizeHash[size]),0);
	m.set(tile,"s");
	//Set first main branch
	makeBranch(m, tile, 0);
	//Will keep trying to make random branches untill map is full or 100 branches have been tried
	var branchTryCount = 0;
	var maxBranchTry = 500;
	while(!m.mapFull() && branchTryCount < maxBranchTry){
		//Keep making branches off random active tiles, until map is full
		makeBranch(m, m.getRandomActive(), getRandomDirection());
		branchTryCount++;
	}	
	//$scope.stringifyMap(m.getTiles());
	return m;
	//drawMap(m.getTiles());
	
}

//Down = 0, Up = 1, Right = 2, Left = 4
function makeBranch(map, s, d){
	//Create branch size, add one so min is 1;
	var size = getRandomNormal(4)+1;
	var currentTile = s;
	for(var i=0; i<size; i++){
		var t = map.move(currentTile, d);
		//Set tile to walkway if it exists, if not end loop or requested tile is already active
		if(t != null && !map.active(t) && map.noneAround(t,d)){
			map.set(t, "w");
			currentTile = t;
		}
		else{break;}
	}
}
	
function getBlankMap(size){
	var count = sizeHash[size];
	var map = [];
	for(var y=0; y<count; y++){
		var mapRow = [];
		for(var x=0; x<count; x++){
			mapRow.push("x");
		}
		map.push(mapRow);
	}
	return map;
}

function getRandomDirection(){
	return Math.floor(Math.random() * 4);
}

function getRandomSize(){
	var rand = Math.floor(Math.random() * 2);
	return (rand==0) ? "S" : (rand==1) ? "M" : "L";
}

function getRandomNormal(n){
	return Math.floor(Math.random() * n);
}