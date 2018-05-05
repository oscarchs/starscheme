

<div class="container">
  <div class="row" style="text-align:center;margin-top:20px;">
    <div class="col-sm-2">

    </div>

    <?php echo form_open('welcome/get_query'); ?>
    <div class="col-sm-2">
    <p> Tiempo </p>

      <select multiple class="form-control" name="jerarquia">
      <?php

      foreach ($tiempo as $entry): ?>

           <option value="<?php echo $entry['nombre_jer']; ?>"><?php echo $entry['nombre_jer']; ?></option>

      <?php endforeach; ?>
      </select>
      <br>

    </div>
    <div class="col-sm-2">
    <p> Producto </p>
    <select multiple class="form-control" name="medida">
    <?php

    foreach ($producto as $entry): ?>

         <option value="<?php echo $entry['nombre_jer']; ?>"><?php echo $entry['nombre_jer']; ?></option>

    <?php endforeach; ?>
    </select>
    </div>
    <div class="col-sm-2">
    <p> Tienda </p>

    <select multiple class="form-control" name="dimension">
    <?php

    foreach ($tienda as $entry): ?>

         <option value="<?php echo $entry['nombre_jer']; ?>"><?php echo $entry['nombre_jer']; ?></option>

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
</div>
