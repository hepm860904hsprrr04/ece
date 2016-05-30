<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<style>
ul.ul-mensajes {list-style-type: none;}
</style>

<?php ?>
<ul class="list-group ul-mensajes">
    <?php if(isset($mensajes)){ ?>
        <?php foreach($mensajes as $mensaje){ ?>
          <li class="list-group-item" style="padding-top: 10px;"> <strong> Admin </strong> :  <span class="text-muted"><?php echo $mensaje->mensaje_texto;?></span></li>
        <?php } ?>
    <?php } ?>
</ul>

