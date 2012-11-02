<?php
# PHP Calendar (version 2.3), written by Keith Devens
# http://keithdevens.com/software/php_calendar
#  see example at http://keithdevens.com/weblog
# License: http://keithdevens.com/software/license

function generate_calendar($year, $month, $days = array(), $day_name_length = 3, $month_href = NULL, $first_day = 0, $pn = array()){
	$first_of_month = gmmktime(0,0,0,$month,1,$year);
	#remember that mktime will automatically correct if invalid dates are entered
	# for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
	# this provides a built in "rounding" feature to generate_calendar()
	
	//$day_names = Array("Даваа", "Мягмар", "Лхагва", "Пүрэв", "Баасан", "Бямба", "Ням");
	$day_names = Array("Ням", "Даваа", "Мягмар", "Лхагва", "Пүрэв", "Баасан", "Бямба");
	list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month));
	
	$months_namesmn = Array("January"=>"1 сар", "February"=>"2 сар", "March"=>"3 сар",
							"April"=>"4 сар", "May"=>"5 сар", "June"=>"6 сар",
							"July"=>"7 сар", "August"=>"8 сар", "September"=>"9 сар",
							"October"=>"10 сар", "November"=>"11 сар", "December"=>"12 сар");
	
	$month_name = $months_namesmn [$month_name];
	$weekday = ($weekday - $first_day) % 6; #adjust for $first_day
	$title   = $year.' оны '.ucfirst($month_name);  #note that some locales don't capitalize month and day names

	#Begin calendar. Uses a real <caption>. See http://diveintomark.org/archives/2002/07/03
	@list($p, $pl) = each($pn); @list($n, $nl) = each($pn); #previous and next links, if applicable
	if($p) $p = '<span class="calendar-prev">'.($pl ? '<a href="'.htmlspecialchars($pl).'">'.$p.'</a>' : $p).'</span>&nbsp;';
	if($n) $n = '&nbsp;<span class="calendar-next">'.($nl ? '<a href="'.htmlspecialchars($nl).'">'.$n.'</a>' : $n).'</span>';
	$calendar = '<table class="calendar">'."\n".
		'<caption class="calendar-month">'.$p.($month_href ? '<a href="'.htmlspecialchars($month_href).'">'.$title.'</a>' : $title).$n."</caption>\n<tr>";

	if($day_name_length){ #if the day names should be shown ($day_name_length > 0)
		#if day_name_length is >3, the full name of the day will be printed
		$dd=1;
		foreach($day_names as $d){
			$calendar .= '<th abbr="'.$d.'" id="day'.$dd.'">'.($day_name_length < 4 ? mb_substr($d,0,$day_name_length,'UTF8') : $d).'</th>';
			$dd++;
		}$calendar .= "</tr>\n<tr>";
	}

	if($weekday > 0) $calendar .= '<td colspan="'.$weekday.'">&nbsp;</td>'; #initial 'empty' days
	for($day=1,$days_in_month=gmdate('t',$first_of_month); $day<=$days_in_month; $day++,$weekday++){
		if($weekday == 7){
			$weekday   = 0; #start a new week
			$calendar .= "</tr>\n<tr>";
		}
		if(isset($days[$day]) and is_array($days[$day])){
			@list($link, $classes, $content) = $days[$day];
			if(is_null($content))  $content  = $day;
			$calendar .= '<td class="td_day">'.
				($link ? '<a href="'.htmlspecialchars($link).'" class="linkedday">'.$content.'</a>' : $content).'</td>';
		}
		else $calendar .= "<td class='td_day'>$day</td>";
	}
	if($weekday != 7) $calendar .= '<td colspan="'.(7-$weekday).'">&nbsp;</td>'; #remaining "empty" days

	return $calendar."</tr>\n</table>\n";
}
?>