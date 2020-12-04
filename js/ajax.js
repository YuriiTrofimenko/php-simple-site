function showCities(countryid){
	if(countryid=="0"){
		document.getElementById('citylist').innerHTML="";
	}
	if(window.XMLHttpRequest){
		ao=new XMLHttpRequest();
	}
	else{
		ao=new ActiveXObject('Microsoft.XMLHTTP');
	}
	ao.onreadystatechange=function(){
		if(ao.readyState==4 && ao.status==200){
			document.getElementById('citylist').innerHTML=ao.responseText;
		}
	}
	ao.open('GET',"pages/ajax1.php?cid="+countryid, true);
	ao.send(null);
}


function showHotels(cityid){
	var h=document.getElementsByTagName('main')[0];
	if(cityid=="0"){
		h.innerHTML="";
	}
	if(window.XMLHttpRequest){
		ao=new XMLHttpRequest();
	}
	else{
		ao=new ActiveXObject('Microsoft.XMLHTTP');
	}
	ao.onreadystatechange=function(){
		if(ao.readyState==4 && ao.status==200){
			h.innerHTML=ao.responseText;
		}
	}
	//ao.open('GET',"pages/ajax2.php?cid="+cityid, true);
	//ao.send(null);
	ao.open("POST","pages/ajax2.php",true);
	ao.setRequestHeader("Content-Type",'application/x-www-form-urlencoded');
	ao.send("cid="+cityid);
}