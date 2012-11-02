<?php
	$cfg['db']['host'] = 'localhost';
	$cfg ['db'] ['user'] = 'prttlub';
	$cfg ['db'] ['password'] = 'ubprtl2012';
	$cfg ['db'] ['name'] = 'ubprtl_db';
		
	$charset = "utf-8";
	$byteUnits = array("Bytes", "KB", "MB", "GB", "TB", "PB", "EB");
	$strDateFormat = "/yyyy-mm-dd/";
	
	$rf="";	//"/mayor";
	$rfo="";			//"/ub";
	$rfub="http://www.ulaanbaatar.mn";
	
	$drf=$_SERVER['DOCUMENT_ROOT'].$rf;	//"/mayor";	
	$drfo=$_SERVER['DOCUMENT_ROOT'].$rfo;	//"/ub";	
	
	define(MAYORID,"10102");

$letters_nonunicode = array( 
					184=>"¸",  //ё 
					168=>"¨",  //Ё 
					186=>"º",  //ө 
					170=>"ª",  //Ө
					175=>"¯",  //Ү 
					191=>"¿",  //ү                     
					192=>"À",  //А
					193=>"Á",  //Б
					194=>"Â",  //В
					195=>"Ã",  //Г
					196=>"Ä",  //Д
					197=>"Å",  //Е
					198=>"Æ",  //Ж
					199=>"Ç",  //З
					200=>"È",  //И
					201=>"É",  //Й
					202=>"Ê",  //К
					203=>"Ë",  //Л
					204=>"Ì",  //М
					205=>"Í",  //Н
					206=>"Î",  //О
					207=>"Ï",  //П
					208=>"Ð",  //Р
					209=>"Ñ",  //С
					210=>"Ò",  //Т
					211=>"Ó",  //У
					212=>"Ô",  //Ф
					213=>"Õ",  //Х
					214=>"Ö",  //Ц
					215=>"×",  //Ч
					216=>"Ø",  //Ш
					217=>"Ö",  //Щ
					218=>"Ú",  //Ь
					219=>"Û",  //Ы
					220=>"Ü",  //Ь
					221=>"Ý",  //Э
					222=>"Þ",  //Ю
					223=>"ß",  //Я
					224=>"à",  //а
					225=>"á",  //б
					226=>"â",  //в
					227=>"ã",  //г
					228=>"ä",  //д
					229=>"å",  //е
					230=>"æ",  //ж
					231=>"ç",  //з
					232=>"è",  //и
					233=>"é",  //й
					234=>"ê",  //к
					235=>"ë",  //л
					236=>"ì",  //м
					237=>"í",  //н
					238=>"î",  //о
					239=>"ï",  //п
					240=>"ð",  //р
					241=>"ñ",  //с
					242=>"ò",  //т
					243=>"ó",  //у
					244=>"ô",  //ф
					245=>"õ",  //х
					246=>"ö",  //ц
					247=>"÷",  //ч
					248=>"ø",  //ш
					249=>"ù",  //щ
					250=>"ú",  //ъ
					251=>"û",  //ы
					252=>"ü",  //ь
					253=>"ý",  //э
					254=>"þ",  //ю
					255=>"ÿ"); //я
$letters_unicode = array( 
					184=>"ё",  
					168=>"Ё",  
					186=>"ө",  
					170=>"Ө",  
					175=>"Ү",  // tom Y useg 
					191=>"ү",  // jijig v useg
					192=>"А",  
					193=>"Б",  
					194=>"В",  
					195=>"Г",  
					196=>"Д",  
					197=>"Е",  
					198=>"Ж",  
					199=>"З",  
					200=>"И",  
					201=>"Й",  
					202=>"К",  
					203=>"Л",  
					204=>"М",  
					205=>"Н",  
					206=>"О",  
					207=>"П",  
					208=>"Р",  
					209=>"С",  
					210=>"Т",  
					211=>"У",  
					212=>"Ф",  
					213=>"Х",  
					214=>"Ц",  
					215=>"Ч",  
					216=>"Ш",  
					217=>"Щ",  
					218=>"Ъ",  
					219=>"Ы",  
					220=>"Ь",  
					221=>"Э",  
					222=>"Ю",  
					223=>"Я",  
					224=>"а",  
					225=>"б",  
					226=>"в",  
					227=>"г",  
					228=>"д",  
					229=>"е",  
					230=>"ж",  
					231=>"з",  
					232=>"и",  
					233=>"й",  
					234=>"к",  
					235=>"л",  
					236=>"м",  
					237=>"н",  
					238=>"о",  
					239=>"п",  
					240=>"р",  
					241=>"с",  
					242=>"т",  
					243=>"у",  
					244=>"ф",  
					245=>"х",  
					246=>"ц",  
					247=>"ч",  
					248=>"ш",  
					249=>"щ",  
					250=>"ъ",  
					251=>"ы",  
					252=>"ь",  
					253=>"э",  
					254=>"ю",  
					255=>"я");
?>
