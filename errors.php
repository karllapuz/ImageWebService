<?php  

    /*
        Authors: Karl Lapuz and Michelle Luong
	*/
	
	if (count($errors) > 0) : 
?>
	<div class="error">
		<?php foreach ($errors as $error) : ?>
			<p><?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php  endif ?>
