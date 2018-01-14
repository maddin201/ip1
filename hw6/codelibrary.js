/* Convert object name string or object reference
   into a valid object reference */
function getObj(elementID){
	return document.getElementById(elementID);
}

/* Object Motion and Position Scripts */
/*This function places a positionable object (obj) in 
  three dimensions (x,y, and z).*/
function shiftTo(obj,x,y,z){
	var newObj = getObj(obj)
	newObj.style.left = x + "px";
	newObj.style.top = y + "px";
	newObj.style.zIndex = z;
}

/*This function gets the x coordinate of a positionable object.*/
function getObjX(obj){
	return parseInt(getObj(obj).style.left);
}

/*This function gets the y coordinate of a positionable object.*/
function getObjY(obj){
	return parseInt(getObj(obj).style.top);
}

/*This function gets the z-index of a positionable object.*/
function getObjZ(obj){
	return parseInt(getObj(obj).style.zIndex);
}

/* Redirects visitors who are using outdated browsers.*/
function checkDOM(newlocation){
	if (!theDOM1){
		window.location.replace(newlocation);
	}
}

/*Set the background color of an object*/
function setBackground(thisobj, color){ 
	thisobj.style.background = color; 
}

/*Set the text color of an object*/
function setColor(thisobj, color){
	thisobj.style.color = color;
}

/*Setting the visibility of an object*/
function setVisibility(obj,vis){
	var theObj = getObj(obj);
	if (vis == true || vis=='visible' || vis=='y'){
		theObj.style.visibility = "visible";
	}else{
		theObj.style.visibility = "hidden";
	}
}

/*Getting the visibility of an object*/
function isVisible(obj) {
	var theObj = getObj(obj);
	return theObj.style.visibility;
}

/*Setting the display of an object*/
function setDisplay(obj,dis){
	var theObj = getObj(obj);
	if (dis==true || dis=='block' || dis=='y'){
		theObj.style.display = "block";
	}else{
		if (dis==false || dis=='n'){
			theObj.style.display = "none";
		}else{
			theObj.style.display = dis;
		}
	}
}

/*Getting the display of an object*/
function isDisplayed(obj) { 
	var theObj = getObj(obj); 
	return theObj.style.display;
}

/* This function changes the cursor. 
   The second argument is optional. */
function setCursor(cursortype,thisobj){
    if (UA.indexOf("msie 5")>=0){
		if (cursortype == 'pointer') { cursortype='hand'; }
    }
    if (thisobj==null){
    	document.body.style.cursor = cursortype;
    }else{
    	getObj(thisobj).style.cursor = cursortype;
    }
}

