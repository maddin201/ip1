var xmlHttp;
var count=0;
function pageUpdate(id)
{
  if (id.length == 0)
  {
    document.getElementById("tid").innerHTML="";  
      document.getElementById("tname").innerHTML="";  
        document.getElementById("tcity").innerHTML="";
    return;
  }
  xmlHttp=GetXmlHttpObject();
  if (xmlHttp==null)
  {
    alert ("Your browser does not support AJAX!");
    return;
  }
  var url="hw9.php";
  url=url+"?tid="+id;
  xmlHttp.onreadystatechange=changing;
  xmlHttp.open("GET",url,true);
  xmlHttp.send(null);
}
 
function changing()
{
 // count++;
  if (xmlHttp.readyState == 4 && xmlHttp.status==200)
  {
    var xmlDoc=xmlHttp.responseXML.documentElement;
     
    document.getElementById("tid").innerHTML="";
    document.getElementById("tname").innerHTML="";
    document.getElementById("tcity").innerHTML="";
        if (xmlDoc.childNodes == null || xmlDoc.childNodes.length == 0)
    {
        document.getElementById("tid").innerHTML= "No match";
        
    }
   else if (xmlDoc.getElementsByTagName("error") != null

            && xmlDoc.getElementsByTagName("error").length != 0)

    {

        alert(xmlDoc.getElementsByTagName("error")[0].firstChild.nodeValue);

    }

    
    else
    {   
        document.getElementById("tid").innerHTML=
            xmlHttp.responseXML.documentElement.getElementsByTagName("TEAM_ID")[0].firstChild.nodeValue;
        document.getElementById("tname").innerHTML=
            xmlDoc.getElementsByTagName("TEAM_NAME")[0].firstChild.nodeValue;
        document.getElementById("tcity").innerHTML=
            xmlDoc.getElementsByTagName("TEAM_CITY")[0].firstChild.nodeValue;            
    } 
  
}
}
 
function GetXmlHttpObject()
{
  var xmlHttp=null;
  try
  {  xmlHttp=new XMLHttpRequest();
  }  catch (e)
  {  try
    {      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e)
    {      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
  return xmlHttp;
}