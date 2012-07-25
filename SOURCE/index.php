<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Flash Tracer</title>
<style>
body{
	font-family:nanum,Dotum,돋움, 'Lucida Grande', AppleGothic, sans-serif;
	font-size:75%;
	text-align:center;
	margin:0;
	padding:0;
	line-height:1.6em;
	color:#454545;
	/*@background-image=background-image:;*/background-image: none;/*@*/
	/*@background-image-position=background-position:;*/background-position: ;/*@*/
	/*@background-image-repeat=background-repeat:;*/background-repeat: no-repeat;/*@*/
	/*@background-color=background-color:#333333;*/background-color: #DBDBDB;/*@*/
}
	img {
		border-width: 0px;
	}
textarea, input, td {
	font-family:nanum,Dotum,돋움, Verdana, 'Lucida Grande', AppleGothic, Sans-serif;
	font-size:1em;
	color : #666666;
}
	a:link { color:#336699; text-decoration:none; }
	a:visited { color:#336699; text-decoration:none; }
	a:hover { color:#6699cc; text-decoration:underline; }
	a img{ border:0; }r: auto;
}
#info_bottom {
	background:#DBDBDB;
	clear:both;
	padding:15px;
	font-size:0.9em;
	letter-spacing:-1px;
	text-align:justify;
}

#info_bottom ul {
	list-style:none;
	list-style-image:none;
	margin:0;
	padding:0;
	display:inline;
}

#info_bottom li {
	margin:0;
	padding:0 5px;
	display:inline;
}

#info_bottom ul li ul li { font-weight:bold; }
#info_bottom ul li ul li ul li { font-weight:normal; }

#info_bottom .cloud1 {
	font-weight:bold;
	font-size:15px;
	color:#f30;
}
#info_bottom .cloud2 {
	font-weight:bold;
	font-size:14px;
	color:#f60;
}
#info_bottom .cloud3 {
	font-weight:bold;
	font-size:13px;
	color:#369;
}
#info_bottom .cloud4 {
	font-size:12px;
	color:#690;
}
#info_bottom .cloud5 {
	font-size:11px;
	color:#999;
}
#info_bottom a:hover{ background-color:#FFFFFF; color:#6699cc; }
</style>
</head>

<body>
<div id="info_bottom" style="text-align:center">
<br />
<a href="/lab/flashtracer/index.php"><img src="logo.png" /></a>
<h2>v1.0</h2><p><br />
  
  
  <?php
	$ebmedcode = $_POST['embed'];
	if(!empty($ebmedcode)) {

	preg_match_all('/xml=([^"]*)&/i',$ebmedcode,$matches);
	
	//print_r($matches[1][0]);
	if( empty($matches[1][0]) ) {
		preg_match_all('/file=([^"]*)&/i',$ebmedcode,$matches);
		if( empty($matches[1][0]) ) {
			echo '잘못되거나 지원하지 않는 embed 코드입니다.';
			exit(0);
		}
	}
	
	$xml_string = file_get_contents($matches[1][0]);
	$enc = mb_detect_encoding($xml_string, array('EUC-KR', 'UTF-8', 'shift_iis', 'CN-GB'));
	if($enc != 'UTF-8') {
		$xml_string = iconv($enc, 'UTF-8', $xml_string);
	}
	
	$xml = new SimpleXMLElement($xml_string);

	foreach ($xml->trackList->track as $item) {
		echo('<a href="'.$item->location.'" target="_blank">'.$item->location.'</a><br>');
	}
	}

?>
  
</p>
<p>&nbsp;</p>

</p>
<form id="form1" name="form1" method="post" action="/lab/flashtracer/index.php">
<p>[embed code]</p>
  <p>
    <textarea name="embed" id="embed" cols="45" rows="5"></textarea>
  </p>
  <p>
    <input type="submit" value="주소불러오기" />
  </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Visit <a href="http://lab.devflow.kr">devflowlab</a></p>
<p>(C)Copyright All Reserved By <a href="http://devflow.kr">devflow</a></p>
<p>&nbsp;</p>
</div>
</body>
</html>