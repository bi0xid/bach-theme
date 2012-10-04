<?php $search_text = "Buscar"; ?> 
<form method="get" id="searchform"  action="<?php bloginfo('home'); ?>/"><label>Buscar: </label> <input style="w_auto" type="text" value="<?php echo $search_text; ?>"  
name="s" id="s"  
onblur="if (this.value == '')  
{this.value = '<?php echo $search_text; ?>';}"  
onfocus="if (this.value == '<?php echo $search_text; ?>')  
{this.value = '';}" /> 
<input type="hidden" id="searchsubmit" /> 
</form>

