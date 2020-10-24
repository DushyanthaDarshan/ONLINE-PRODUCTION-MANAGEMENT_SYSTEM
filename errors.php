<?php if (count($errors) > 0) : ?>
	<div>
  		<?php foreach ($errors as $error) : ?>
  	  		<p style="background-color: #F90919; 
			  width: 90%; 
			  border: 1px solid #F90919; 
			  height: 30px; 
			  text-align: center;
			  marging: 0px;
			  padding: 10px;
			  padding-top: 0px;
			  marigin-bottom: 5px;"><?php echo $error ?></p>
  		<?php endforeach ?>
  	</div>
<?php endif ?>