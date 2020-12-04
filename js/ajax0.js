function showCities(countryid){
	if(countryid==""){
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

