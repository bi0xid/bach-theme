<?php /*
Template Name: Timeline old
*/

get_header(); ?>



<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/styles.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/script.js"></script>

</head>

<body>

<div id="timeline">
<div align="center"><strong><span style="font-size:22px;"> <a href="http://interno.mecus.es/informes/">PRIORIDAD</a> || <a href="http://interno.mecus.es/entrega/">FECHA ENTREGA</a> || <a href="http://interno.mecus.es/timeline/">TIMELINE</a> || <a href="http://interno.mecus.es/espera/">EN ESPERA</a> || <a href="http://interno.mecus.es/sin-fecha/">SIN FECHA</a></span> <br /> 
<span style="font-variant:small-caps;font-size:16px;"><a href="http://interno.mecus.es/informe-cerrado/">Cerrados</a> || <a href="http://interno.mecus.es/luis/">Luis</a> || <a href="http://interno.mecus.es/rocio/">Rocío</a> || <a href="http://interno.mecus.es/raven/">RaveN</a></span></strong></div>
	


    <div id="timelineLimiter"> <!-- Hides the overflowing timelineScroll div -->
        <div id="scroll"> <!-- The year time line -->
            <div id="centered"> <!-- Sized by jQuery to fit all the years -->
	            <div id="highlight"></div> <!-- The light blue highlight shown behind the years -->
	            <?php //echo $scrollPoints ?> <!-- This PHP variable holds the years that have events -->
                <div class="clear"></div>
            </div>
        </div>
        
        <div id="slider"> <!-- The slider container -->
        	<div id="bar"> <!-- The bar that can be dragged -->
            	<div id="barLeft"></div>  <!-- Left arrow of the bar -->
                <div id="barRight"></div>  <!-- Right arrow, both are styled with CSS -->
          </div>
        </div>
	    <div id="timelineScroll"> <!-- Contains the timeline and expands to fit -->

		<?php

             function compare($x, $y)
					{
					 if ( $x['prioridad'] == $y['prioridad'] )
					  return 0;
					 else if ( $x['prioridad'] > $y['prioridad'] )
					  return -1;
					 else
					  return 1;
					}


$halfday = 120;
$completeday = 86400;
        
        // We first select all the events from the database ordered by date:
        
        $dates = array();
        //$res = mysql_query("SELECT * FROM timeline ORDER BY date_event ASC");
		$res = mysql_query("SELECT *  FROM wp_postmeta WHERE meta_key = '_refactord-datepicker' ORDER BY meta_value ASC");
        while($row=mysql_fetch_assoc($res))
        {
			// Store the events in an array, grouped by years:
			
			$date = $row['meta_value'];
			$date = explode('/',$date);
			$fecha = $date[1].'-'.$date[0].'-'.$date[2];
			$date = $date[2].'-'.$date[0].'-'.$date[1];
            $dates[date('Y,m,d',strtotime($date))][] = $row;
        }
        
        
        
		$scrollPoints = '';
		
        $i=0;
        $lastyear=0;
        $lastmonth=0;
        foreach($dates as $year=>$array)
        {
			// Loop through the years:
			
			$edad = explode(',',$year);
			$year = $edad[0];
			$month = $edad[1];
			$day = $edad[2];
			
            foreach($array as $event)
            {
				// Loop through the events in the current year:
				//print_r($event);
				
				$post_id = $event['post_id'];
				//echo $post_id;

			$cerrado = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$post_id' AND term_taxonomy_id = '66'");  
			if ($cerrado != '0') $abierto = 1;
  			}              

	if ($abierto == 1):
	
	
	
	
            echo '<div class="event">';
                if ($lastyear != $year){
                	echo '<div class="eventHeading green">'.$year.'</div>';
                	$lastyear = $year;
                } else {
                	echo '<div class="eventHeading">&nbsp;</div>';
                } 
                if ($lastmonth != $month){
                	if ($month == '1') $muestrames = 'Enero';
                	if ($month == '2') $muestrames = 'Febrero';
                	if ($month == '3') $muestrames = 'Marzo';
                	if ($month == '4') $muestrames = 'Abril';
                	if ($month == '5') $muestrames = 'Mayo';
                	if ($month == '6') $muestrames = 'Junio';
                	if ($month == '7') $muestrames = 'Julio';
                	if ($month == '8') $muestrames = 'Agosto';
                	if ($month == '9') $muestrames = 'Septiembre';
                	if ($month == '10') $muestrames = 'Octubre';
                	if ($month == '11') $muestrames = 'Noviembre';
                	if ($month == '12') $muestrames = 'Diciembre';
                	echo '<div class="eventHeading blue">'.$muestrames.'</div>';
                	$lastmonth = $month;
                } else {
                	echo '<div class="eventHeading">&nbsp;</div>';
                } 
                	$weekday = date("N", mktime(0, 0, 0, $month, $day, $year));
                	if ($weekday == '1'): $weekday = 'Lunes';	  $weekcolor = 'chreme'; endif;
                	if ($weekday == '2'): $weekday = 'Martes';	  $weekcolor = 'chreme'; endif;
                	if ($weekday == '3'): $weekday = 'Miércoles'; $weekcolor = 'chreme'; endif;
                	if ($weekday == '4'): $weekday = 'Jueves';	  $weekcolor = 'chreme'; endif;
                	if ($weekday == '5'): $weekday = 'Viernes';	  $weekcolor = 'chreme'; endif;
                	if ($weekday == '6'): $weekday = 'Sábado';	  $weekcolor = 'fiesta'; endif;
                	if ($weekday == '7'): $weekday = 'Domingo';	  $weekcolor = 'fiesta'; endif;

                
                	echo '<div class="eventHeading '.$weekcolor.'">'.$weekday.' '.$day.'</div>';
              echo '  <ul class="eventList">';  
            
     
                $amigo = array();
              foreach($array as $pr_array){

            	$postid = $pr_array['post_id'];
				$p7 = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$postid' AND term_taxonomy_id = '228'");  
				$p6 = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$postid' AND term_taxonomy_id = '76'");  
				$p5 = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$postid' AND term_taxonomy_id = '75'");  
				$p4 = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$postid' AND term_taxonomy_id = '74'");  
				$p3 = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$postid' AND term_taxonomy_id = '73'");  
				$p2 = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$postid' AND term_taxonomy_id = '72'");  
				$p1 = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$postid' AND term_taxonomy_id = '71'");  
				$p0 = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$postid' AND term_taxonomy_id = '196'");  
				
				if ($p7 == '0') $pri = '7';
				if ($p6 == '0') $pri = '6';
				if ($p5 == '0') $pri = '5';
				if ($p4 == '0') $pri = '4';
				if ($p3 == '0') $pri = '3';
				if ($p2 == '0') $pri = '2';
				if ($p1 == '0') $pri = '1';
				if ($p0 == '0') $pri = '0';
            	$pr_array['prioridad'] = $pri;
            	$amigo[] = $pr_array;
            	//print_r($pr_array);
            }
                          

			usort($amigo, 'compare');


            foreach($amigo as $event)
            {
				// Loop through the events in the current year:
				//print_r($event);
				
				$post_id = $event['post_id'];
				//echo $post_id;

$cerrado = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$post_id' AND term_taxonomy_id = '66'");  
$raven = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$post_id' AND term_taxonomy_id = '58'");  
$luis = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$post_id' AND term_taxonomy_id = '59'");  
$rocio = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$post_id' AND term_taxonomy_id = '156'");  
$milestone = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$post_id' AND term_taxonomy_id = '227'");  

$p6 = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$post_id' AND term_taxonomy_id = '76'");  
$p5 = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$post_id' AND term_taxonomy_id = '75'");  
$p4 = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$post_id' AND term_taxonomy_id = '74'");  
$p3 = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$post_id' AND term_taxonomy_id = '73'");  
$p2 = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$post_id' AND term_taxonomy_id = '72'");  
$p1 = $wpdb->get_var("SELECT term_order FROM $wpdb->term_relationships WHERE object_id = '$post_id' AND term_taxonomy_id = '71'");  

if ($p6 == '0') $prioridad = 'pr6';
if ($p5 == '0') $prioridad = 'pr5';
if ($p4 == '0') $prioridad = 'pr4';
if ($p3 == '0') $prioridad = 'pr3';
if ($p2 == '0') $prioridad = 'pr2';
if ($p1 == '0') $prioridad = 'pr1';




if ($raven == '0') $usuario = '#f60';
if ($luis == '0') $usuario = 'blue';
if ($rocio == '0') $usuario = 'green';
if ($milestone == '0'): $clase = 'milestone'; $usuario = 'black'; else: $clase = 'news'; endif;

if ($cerrado != '0'):
				
			$metapost = mysql_query("SELECT * FROM wp_posts WHERE ID = '$post_id'");
			$post = mysql_fetch_array($metapost);
			//print_r($post);
				
			$entrega = get_post_meta($post_id, '_refactord-datepicker');  
			$entrega = $entrega[0];
			$entrega = explode('/', $entrega);
			if ($entrega[0] != ''){
				$entregado = $entrega[2].'-'.$entrega[0].'-'.$entrega[1];
				$entrega = $entrega[1].'/'.$entrega[0].'/'.$entrega[2];

				$date1 = $entregado;
				$date2 = time();
				$dateArr  = explode("-",$date1);
				$date1Int = mktime(0,0,0,$dateArr[1],$dateArr[2],$dateArr[0]) ;
				$diff = $date2-$date1Int;
					if (($diff > $halfday) && ($diff < $completeday)) {
						$style = 'font-weight:bold;color:red;border:3px solid '.$usuario.';padding:4px;';
					} 
					
					elseif ($diff > $completeday){
						$style = 'font-weight:bold;color:white;border:3px solid '.$usuario.';padding:4px;background-color:red;';
					} 
					
					else {
						$style = 'font-weight:bold;padding:4px;border:3px solid '.$usuario.';';
					}
					


			}
				
                echo '<li class="'.$clase.'" style="'.$style.'">
				<!--<span class="icon" title="'.$post['post_title'].'"></span>-->
				<span class="'.$prioridad.'" title="'.$post['post_title'].'"></span>
				'.$post['post_title'].'
				
				<div class="content">
					<div class="body">'.($event['type']=='image'?'<div style="text-align:center"><img src="'.$event['body'].'" alt="Image" /></div>':nl2br($post['post_content'])).'<br /><br /><a href="'.$post['guid'].'" target="_parent">'.$post['guid'].'</a></div>
					<div class="title">'.$post['post_title'].'</div>
					<div class="date">'.$fecha.'</div>
				</div>
				
				</li>';
  endif;
 
   
            }




            
            echo '</ul></div>';
	   endif;   
   $abierto = 0;  
		
			// Generate a list of years for the time line scroll bar:
			$scrollPoints.='<div class="scrollPoints">'.$day.'/'.$month.'/'.$year.'</div>';
        }
        
        ?>
	    
        <div class="clear"></div>
        </div>
        
        
    </div> 
</div>

</body>
</html>
