<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Tip's IP View</title>
</head>
<!--//----------ȥSitemix���---------->
<style>
#meerkat-wrap{
display:none!important;
}
#sitemix_pr_footer_js{
display:none!important;
}
</style>
<!--//----------ȥSitemix���---------->
<body>
<center><h3>Tip's IP��ѯ(����IP��ַ�ĵ���λ��)</h3></center>
<center>
<!--//----------�ԼӴ��뿪ʼ---------->
<?php
$iip=$_SERVER["REMOTE_ADDR"];//��ȡ�ͻ���ip
$iurl="http://services.ipaddresslabs.com/iplocation/locateip?key=SAKKH9P7835PZ8XU9N7Z&ip=".$iip;//���Ӳ�ѯurl�ַ���
?>
<div width=100% align="center">
<fieldset align="left" style="width:500px;">
<legend>���ip��<font color=red><?php echo $iip;?></font> ��Ϣ���£�<br></legend>
<?php geo($iurl);?>
</fieldset>
</div>
<?php
/*function get_contents($url){
              $ch = curl_init();     
              curl_setopt ($ch, CURLOPT_URL, $url);     
              curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt ($ch, CURLOPT_TIMEOUT, 1000); 
              $file_contents = curl_exec($ch);     
              curl_close($ch);
              return $file_contents;
       }*/
//�ж��ַ����Ƿ��� IP ��ַ
function IsIPAdress($value){

    if (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $value)){
        return true;
    }
    return false;
}
//--------ip��Ϣ�˳�-------------->
function geo($iurl){
//global $ip_address,$continent_name,$country_code,$country_name,$region_code,$region_name,$city,$postal_code,$latitude,$longitude,$isp;
error_reporting(7); 
$file = fopen ($iurl, "r"); //Զ�̴򿪲�ѯurl
if (!$file) { //�������ڣ����������Ϣ
			echo "<font color=red>Unable to open remote file.</font>\n"; 
			exit; 
			}
while (!feof ($file)) { //���б���$file����ѯƥ���ַ�����������������ָ����
		$line = fgets ($file, 1024); 
		if (eregi ("<query_status_code>OK</query_status_code>", $line)) { 
			//echo "ERROR! Worng ip or hostname!"; 
			$p = true;
			break;
			} 
	 }
if ($p){
		rewind($file);
		while (!feof ($file)) { //���б���$file����ѯƥ���ַ��������
				$line = fgets ($file, 1024);  
				if (eregi ("<ip_address>(.*)</ip_address>", $line, $out)) { 
					$ip_address = $out[1]; 
					break;
					} else if(eregi ("<resolved_ip_address>(.*)</resolved_ip_address>", $line, $out)) {
								$ip_address = $out[1]; 
								break;
								}
				} 
		rewind($file);//�����ļ�ָ��λ��
		while (!feof ($file)) { 
				$line = fgets ($file, 1024); 
				if (eregi ("<continent_name>(.*)</continent_name>", $line, $out)) { 
					$continent_name = $out[1];  
					break;
					} 
				}			
		rewind($file);
		while (!feof ($file)) { 
				$line = fgets ($file, 1024); 
				if (eregi ("<country_code_iso3166alpha2>(.*)</country_code_iso3166alpha2>", $line, $out)) { 
				$country_code = $out[1]; 
				break;
					} 
				}
		rewind($file);
		while (!feof ($file)) { 
				$line = fgets ($file, 1024); 
				if (eregi ("<country_name>(.*)</country_name>", $line, $out)) { 
					$country_name = $out[1]; 
					break;
					} 
				}
		rewind($file);
		while (!feof ($file)) { 
				$line = fgets ($file, 1024); 
				if (eregi ("<region_code>(.*)</region_code>", $line, $out)) { 
					$region_code = $out[1];  
					break;
					} 
				}
		rewind($file);
		while (!feof ($file)) { 
				$line = fgets ($file, 1024); 
				if (eregi ("<region_name>(.*)</region_name>", $line, $out)) { 
					$region_name = $out[1]; 
					break;
					} 
				}
		rewind($file);
		while (!feof ($file)) { 
				$line = fgets ($file, 1024); 
				if (eregi ("<city>(.*)</city>", $line, $out)) { 
					$city = $out[1];  
					break;
					} 
				}
		rewind($file);
		while (!feof ($file)) { 
				$line = fgets ($file, 1024); 
				if (eregi ("<postal_code>(.*)</postal_code>", $line, $out)) { 
					$postal_code = $out[1]; 
					break;
					} 
				}
		rewind($file);
		while (!feof ($file)) { 
				$line = fgets ($file, 1024); 
				if (eregi ("<latitude>(.*)</latitude>", $line, $out)) { 
					$latitude = $out[1];  
					break;
					} 
				}
		rewind($file);
		while (!feof ($file)) { 
				$line = fgets ($file, 1024); 
				if (eregi ("<longitude>(.*)</longitude>", $line, $out)) { 
					$longitude = $out[1]; 
					break;
					} 
				}
		rewind($file);
		while (!feof ($file)) { 
				$line = fgets ($file, 1024); 
				if (eregi ("<isp>(.*)</isp>", $line, $out)) { 
					$isp = $out[1]; 
					break;
					} 
				}
		}else{
			echo "ERROR! Worng ip or hostname!";
			}
fclose($file); 
if ($p){//�Ʊ���ʾip��ѯ���
?>
<div align="center">
<table width="500" border="0">
  <tr>
    <th width="84" align="right" scope="row">ip��ַ��</th>
    <td width="306" align="center"><?php echo $ip_address;?></td>
  </tr>
  <tr>
    <th align="right" scope="row">����</th>
    <td align="center"><?php echo $continent_name;?></td>
  </tr>
  <tr>
    <th align="right" scope="row">���Ҵ��룺</th>
    <td align="center"><?php echo $country_code;?></td>
  </tr>
  <tr>
    <th align="right" scope="row">���ң�</th>
    <td align="center"><?php echo $country_name;?></td>
  </tr>
  <tr>
    <th align="right" scope="row">������룺</th>
    <td align="center"><?php echo $region_code;?></td>
  </tr>
  <tr>
    <th align="right" scope="row">����</th>
    <td align="center"><?php echo $region_name;?></td>
  </tr>
  <tr>
    <th align="right" scope="row">���У�</th>
    <td align="center"><?php echo $city;?></td>
  </tr>
  <tr>
    <th align="right" scope="row">�ʱࣺ</th>
    <td align="center"><?php echo $postal_code;?></td>
  </tr>
  <tr>
    <th align="right" scope="row">��γ�ȣ�</th>
    <td align="center"><?php echo $latitude." x ".$longitude;?></td>
  </tr>
  <tr>
    <th align="right" scope="row">ISP��</th>
    <td align="center"><?php echo $isp;?></td>
  </tr>
</table>
</div>
<?php
		}
				}
?>


<!--//----------�ԼӴ������---------->
<div id="locaIp"></div><br>
<!--<div id="queryIp"></div>
<br>
<form id="ipform" name="ipform" method="post" action="javascript:void(0)">
<input name="ip_url" type="text" class="socss" id="ip_url" size="28" /> 
<input name="Submit" type="submit" class="btn" value=" �� ѯ " onClick="getipdata('queryip','queryIp')"/>
</form>-->
<div align=center>
<?php
//If we submitted the form
if(isset($_POST['Submit'])){
							$ip_url = trim($_POST["ip_url"]);//ȥ����β�հ��ַ�
							if($ip_url){
										if(IsIPAdress($ip_url)) {
											$qurl = "http://services.ipaddresslabs.com/iplocation/locateip?key=SAKKH9P7835PZ8XU9N7Z&ip=".$ip_url;
											} else {
													$qurl = "http://services.ipaddresslabs.com/iplocation/locatehostname?key=SAKKH9P7835PZ8XU9N7Z&hostname=".$ip_url;
													}
?>
										<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
										<input type="text" name="ip_url" id="ip_url" size="28">
										<input type="submit" value=" �� ѯ " name="Submit">
										</form>
									<div width=100% align="center">
									<fieldset align="left" style="width:500px;">
									<legend>���ѯ��ip��<font color=red><?php echo $ip_url;?></font> ��Ϣ���£�<br></legend>
									<?php geo($qurl);?>
									</fieldset>
									</div>
<?php
										}else{
?>
										<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
										<input type="text" name="ip_url" id="ip_url" size="28">
										<input type="submit" value=" �� ѯ " name="Submit">
										</form>
<?php
										echo "None!";
											}
//If we haven't submitted the form
	}else{
?>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
    <input type="text" name="ip_url" id="ip_url" size="28">
    <input type="submit" value=" �� ѯ " name="Submit">
    </form>
<?php
		}
?>
</div>
</center>
<script language="javascript">
function myObjRequest(){
	var myhttp=null;
	try {
		myhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(ie) {
			    try{
					myhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch(huohu){
					myhttp = new XMLHttpRequest();
					}
			}
	return myhttp;
}

function getipdata(action,divname){
  var ip_url=document.getElementById("ip_url").value;
  var url="ip.php?action="+action+"&ip_url="+ip_url;
  //alert(url);
  var myObj=myObjRequest();
  myObj.open("GET",url,true);
  myObj.onreadystatechange=function(){
    if (myObj.readyState==4){
	  //alert(myObj.readyState);
	  if (myObj.status==200){ //��ȡ��������ȷ
	     document.getElementById(divname).innerHTML=myObj.responseText;
	  }
	  else {
	     document.getElementById(divname).innerHTML="��ȡ����IP����,��ˢ�±�ҳ����ϵ����Ա!";
	  }
	}
  }
  myObj.send(null)
  }
getipdata("getip","locaIp");
</script>
<center>Copyright 2013. All rights reserved.</center>
</body>
</html>