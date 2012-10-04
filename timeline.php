<?php /*
Template Name: Timeline
*/

bach_init();

			$abierto = get_option('bach_open'); 
			$open = get_cat_id($abierto);
			$cerrado = get_option('bach_closed'); 
			$closed = get_cat_id($cerrado);
			$esperas = get_option('bach_wait'); 
			$espera = get_cat_id($esperas);

if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'post' ) {
	if ( ! is_user_logged_in() )
		auth_redirect();

	if( !current_user_can( 'publish_posts' ) ) {
		wp_redirect( get_bloginfo( 'url' ) . '/' );
		exit;
	}

	check_admin_referer( 'new-post' );  // This executes the post form. Status = open by default

	$user_id		= $current_user->user_id;
	$post_content	= $_POST['posttext'];
	$tags			= $_POST['tags'];
	$post_title    = strip_tags($_POST['postTitle']);
	$estado = $open;
	$prioridad = $_POST['prioridad'];
	$proyecto = $_POST['proyecto'];
	$usuario = $_POST['usuario']; 
	$fecha = $_POST['fecha'];
	$post_category = array($estado,$prioridad,$proyecto,$usuario);
	global $wpdb;
		$proyecto_nombre = $wpdb->get_var("SELECT name FROM wp_terms WHERE term_id = '$proyecto'");


function generatePassword($length=9) {
	$consonants = 'BDGHJLMNPQRSTVWXZ';
	$numbers .= '123456789';
	$password = '';
	for ($i = 0; $i < 3; $i++) {
			$password .= $consonants[(rand() % strlen($consonants))];
		}
	$password .= '-';
	for ($i = 3; $i < $length; $i++) {
			$password .= $numbers[(rand() % strlen($numbers))];
		}
	
	return $password;
}
 
 	$assigned = generatepassword(7);

	$title = '#' . $assigned . ' ' . $post_title . ' ('. $proyecto_nombre . ')';



		// if no category was selected, unset it & default will be used
 /*       if ($post_category == '-1') {
            unset($post_category);
        } elseif ( isset($post_category) ) {
           $post_category = array($post_category);
        }
*/


	$post_id = wp_insert_post( array(	// Inserts the post with our options
		'post_author'	=> $user_id,
		'post_title'	=> $title,
		'post_content'	=> $post_content,
		'post_category' => $post_category,
		'post_name'		=> $assigned,
		'tags_input'	=> $tags,
		'post_status'	=> 'publish'
	) );

	update_post_meta( $post_id, '_refactord-datepicker', $fecha );
	wp_notify_mail($title,$post_content,$post_category,$assigned);
	wp_redirect( get_bloginfo( 'url' ) . '/' );
	exit;
}

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
	
<div style="font-size:16px;margin-top:30px;text-decoration:underline;"><a href="#actual-day">Ir al día de hoy &darr;</a></div>


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
$diadehoy = date('m/d/Y');
        
        // We first select all the events from the database ordered by date:
        
        $dates = array();
        $fechas = array();
        //$res = mysql_query("SELECT * FROM timeline ORDER BY date_event ASC");
		$res = mysql_query( "SELECT *  FROM wp_postmeta WHERE meta_key = '_refactord-datepicker' ORDER BY meta_value ASC" );
        while($row=mysql_fetch_assoc($res))
        {
			// Store the events in an array, grouped by years:
			
			$date = $row['meta_value'];
			$date = explode('/',$date);
			//$fecha = $date[1].'-'.$date[0].'-'.$date[2];
			$fechas[] = array( $date[2], $date[0], $date[1], $row['post_id'] );
			//$date = $date[2].'-'.$date[0].'-'.$date[1];
            $dates[date('Y,m,d',strtotime($date))][] = $row;
        }		
		sort( $fechas );
    
		$scrollPoints = '';
		
        $i = 0;
        $lastyear = 0;
        $lastmonth = 0;
        $lastday = 0;
	// get first fecha
	$year = $fechas[0][0];
	$month = $fechas[0][1];
	$day = $fechas[0][2];
//	$post_id = $fechas[0][3];


	for ( $i = 2012; $i <= 2013; $i++ ){
		echo '<table class="event">';
		    if ($lastyear != $i){
		    	echo '<tr><td class="eventHeading green" colspan="7">'.$i.'</td></tr>';
		    	$lastyear = $i;
		    } 
		$i == '2012' ? $valuej = 7 : $valuej = 1;
		for ( $j = $valuej; $j <= 12; $j++ ){
		    if ($lastmonth != $j){
	 		   	if ($j == '01') { $muestrames = 'Enero'; $dayvalue = 31; }
	 		   	if ($j == '02') { $muestrames = 'Febrero'; $dayvalue = 28; }
	 		   	if ($j == '03') { $muestrames = 'Marzo'; $dayvalue = 31; }
	 		   	if ($j == '04') { $muestrames = 'Abril'; $dayvalue = 30; }
	 		   	if ($j == '05') { $muestrames = 'Mayo'; $dayvalue = 31; }
	 		   	if ($j == '06') { $muestrames = 'Junio'; $dayvalue = 30; }
	 		   	if ($j == '07') { $muestrames = 'Julio'; $dayvalue = 31; }
	 		   	if ($j == '08') { $muestrames = 'Agosto'; $dayvalue = 31; }
	 		   	if ($j == '09') { $muestrames = 'Septiembre'; $dayvalue = 30; }
	 		   	if ($j == '10') { $muestrames = 'Octubre'; $dayvalue = 31; }
	 		   	if ($j == '11') { $muestrames = 'Noviembre'; $dayvalue = 30; }
	 		   	if ($j == '12') { $muestrames = 'Diciembre'; $dayvalue = 31; }
	 		   	echo '<tr><td class="eventHeading blue" colspan="7">'.$muestrames.'</td></tr>';
	 		   	echo '<tr><td class="eventHeading chreme"><strong>Lunes</strong></td><td class="eventHeading chreme"><strong>Martes</strong></td><td class="eventHeading chreme"><strong>Miércoles</strong></td><td class="eventHeading chreme"><strong>Jueves</strong></td><td class="eventHeading chreme"><strong>Viernes</strong></td><td class="eventHeading fiesta"><strong>Sábado</strong></td><td class="eventHeading fiesta"><strong>Domingo</strong></td></tr>';
	 		   	$lastmonth = $j;
	   		 } 
					$weekday = date("N", mktime(0, 0, 0, $j, 1, $i));
	    		if ($weekday == '1'): $weekday = 'Lunes';	  $ajuste = ''; endif;
	    		if ($weekday == '2'): $weekday = 'Martes';	 $ajuste = '<tr><td></td>'; endif;
	    		if ($weekday == '3'): $weekday = 'Miércoles'; $ajuste = '<tr><td></td><td></td>'; endif;
	    		if ($weekday == '4'): $weekday = 'Jueves';	  $ajuste = '<tr><td></td><td></td><td></td>'; endif;
	    		if ($weekday == '5'): $weekday = 'Viernes';	  $ajuste = '<tr><td></td><td></td><td></td><td></td>'; endif;
	    		if ($weekday == '6'): $weekday = 'Sábado';	  $ajuste = '<tr><td></td><td></td><td></td><td></td><td></td>'; endif;
	    		if ($weekday == '7'): $weekday = 'Domingo';	  $ajuste = '<tr><td></td><td></td><td></td><td></td><td></td><td></td>'; endif;


	   		 for ( $k = 1; $k <= $dayvalue; $k++ ) {
	    		$weekday = date("N", mktime(0, 0, 0, $j, $k, $i));
	    		if ($weekday == '1'): $weekday = 'Lunes';	  $weekcolor = 'chreme'; endif;
	    		if ($weekday == '2'): $weekday = 'Martes';	  $weekcolor = 'chreme'; endif;
	    		if ($weekday == '3'): $weekday = 'Miércoles'; $weekcolor = 'chreme'; endif;
	    		if ($weekday == '4'): $weekday = 'Jueves';	  $weekcolor = 'chreme'; endif;
	    		if ($weekday == '5'): $weekday = 'Viernes';	  $weekcolor = 'chreme'; endif;
	    		if ($weekday == '6'): $weekday = 'Sábado';	  $weekcolor = 'fiesta'; endif;
	    		if ($weekday == '7'): $weekday = 'Domingo';	  $weekcolor = 'fiesta'; endif;
	
	    		if ( $weekday == 'Lunes' ) echo '<tr>';
	    		if ( $k == 1 ) echo $ajuste;
	    		echo '<td class="eventHeading '.$weekcolor.'" colspan="1" valign="top">'.$k;
	  			echo '  <ul class="eventList">';
	  			//foreach ($fechas as $fecha){
	  				
	  			//	if ( ( $fecha[0] == $i ) && ( $fecha[1] == $j ) && ( $fecha[2] == $k ) ){
	  				
                $amigo = array();
                strlen( $i ) == 4 ? $ano = $i : $ano = '0' . $i;
                strlen( $j ) == 2 ? $mes = $j : $mes = '0' . $j;
                strlen( $k ) == 2 ? $dia = $k : $dia = '0' . $k;
                $diary_date = $mes.'/'.$dia.'/'.$ano;
                if ( $diary_date == $diadehoy ) echo '<a name="actual-day"></a>';
                $diary_data = mysql_query( "SELECT *  FROM wp_postmeta WHERE meta_key = '_refactord-datepicker' AND meta_value = '$diary_date' ORDER BY meta_value ASC" );
	  				  	while( $diary = mysql_fetch_assoc( $diary_data )) {
            	$postid = $diary['post_id'];
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
            	$diary['prioridad'] = $pri;
            	$amigo[] = $diary;
            	//print_r($pr_array);
            }
            $lastday = $day;              

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
						$style = 'font-weight:bold;color:red;border:5px solid '.$usuario.';padding:4px;';
					} 
					
					elseif ($diff > $completeday){
						$style = 'font-weight:bold;color:black;border:5px solid '.$usuario.';padding:4px;background-color:#FFAAAA;';
					} 
					
					else {
						$style = 'color:white;font-weight:bold;padding:4px;border:3px solid '.$usuario.';background-color:'.$usuario.';';
					}
					


			}
				
                echo '<li class="'.$clase.'" style="'.$style.'">
				<!--<span class="icon" title="'.$post['post_title'].'"></span>-->
				<span class="'.$prioridad.'" title="'.$post['post_title'].'"></span>
				'.$post['post_title'].'
				
				<div class="content">
					
					<div class="body"><a href="'.$post['guid'].'" target="_blank">'.$post['guid'].'</a><br /><br />'.($event['type']=='image'?'<div style="text-align:center"><img src="'.$event['body'].'" alt="Image" /></div>':nl2br($post['post_content'])).'</div>
					<div class="title">'.$post['post_title'].'</div>
					<div class="date">'.$diary_date.' '.$post['ID'].'</div>
				</div>
				
				</li>';
  endif; // cerrado
 
   				//		}
          //  }
	  				
	  			}
	  			echo '</ul></td>';  
	    		if ( $weekday == 'Domingo' ) echo '</tr>';
	   		 } //for day
		}	// for month
		echo '</table>';
	} // for year
  $abierto = 0;  
		
?>	    
        <div class="clear"></div>
        </div>
        
        
    </div> 
</div>
	
</body>
</html>
