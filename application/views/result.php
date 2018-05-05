

<div class="container">

	<div class="row" style="margin-top:20px;">



	 <table class="table table-condensed">
	     <thead>
	       <tr>
					 <?php foreach ($fields as $col):
						 if($col){
						 ?>
						 			<th> <?php echo $col; ?> </th>
				 	 <?php }
				  endforeach; ?>
				 <th> cantidad </th>
				 <th> monto </th>
	       </tr>
	     </thead>
	     <tbody>

			 <?php foreach ($query['datos'] as $entry): ?>
	       			<tr>
							<?php foreach ($entry as $d): ?>
			        		<td> <?php echo $d; ?></td>
			       	<?php endforeach; ?>
	       			</tr>
			 <?php endforeach; ?>

	     </tbody>

	   </table>
<?php echo $query['q']; ?>


  </div>
</div>
