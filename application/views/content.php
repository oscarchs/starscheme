

<div class="container">
  <div class="row" style="height:100px;background-color:grey;">
    <h2 style="text-align:center;color:white;">Visualizador de Consultas dinámicas</h2>
  </div>
	<div class="row" style="text-align:center;margin-top:20px;">
    <div class="col-sm-2">

		</div>

    <?php echo form_open('welcome/update'); ?>
    <div class="col-sm-2">
		<p> Tiempo </p>

      <select multiple class="form-control" name="jerarquia">
      <?php
      $dim_tienda = $all_data['dim_tienda'];
      foreach ($dim_tienda as $entry): ?>

           <option value="<?php echo $entry; ?>"><?php echo $entry; ?></option>

      <?php endforeach; ?>
      </select>
      <br>

		</div>
		<div class="col-sm-2">
    <p> Producto </p>
    <select multiple class="form-control" name="medida">
    <?php
    $dim_medidas = $all_data['dim_medida'];
    foreach ($dim_medidas as $entry): ?>

         <option value="<?php echo $entry; ?>"><?php echo $entry; ?></option>

    <?php endforeach; ?>
    </select>
		</div>
		<div class="col-sm-2">
    <p> Tienda </p>

    <select multiple class="form-control" name="dimension">
    <?php
    $dim_pro = $all_data['dim_producto'];
    foreach ($dim_pro as $entry): ?>

         <option value="<?php echo $entry; ?>"><?php echo $entry; ?></option>

    <?php endforeach; ?>
    </select>

		</div>
    <div class="col-sm-2">
      <button type="submit" class="btn btn-primary">Update</button>


    </div>

    <?php echo form_close(); ?>

    <div class="col-sm-2">
    </div>
	</div>

  <div class="row" style="margin-top:20px;">

    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
        <?php echo $jerarquia ?>
        <?php echo $medida ?>
        <?php echo $dimension ?>
    </div>

    <div class="col-sm-2">
    </div>



  </div>
</div>
