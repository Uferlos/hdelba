<?php
include 'config/config.php';

$db = new mysqli(host, usr, pssw, db);
if($db->connect_errno){
	echo $db->connect_error;
	exit();
}
$db->set_charset('utf8');

date_default_timezone_set('America/Caracas');
$Tday = date('Y-m-d');
$TdayF = date('d-m-Y');

$sval = isset($_POST['val']) ? $_POST['val'] : '';

$limit = 5;
$ini = 0;

if(isset($_POST['idp'])){
  $idp = $_POST['idp'];
  $ini = ($idp-1) * $limit;
}else{
  $idp = 1;
}


$queryC = "SELECT * FROM users WHERE ";

if($sval != ''){
	$queryC .= "ci LIKE '%$sval%' OR nom LIKE '%$sval%' OR ape LIKE '%$sval%' OR fna LIKE '%$sval%' AND ";
}

$queryC .= "dat = '$Tday' ORDER BY nom ASC LIMIT $ini, $limit";

$resC = $db->query($queryC);
?>
<div class="section">
<?php if($resC->num_rows): ?>
	<h2 class="header center orange-text">Clientes Registrados Hoy <?php echo $TdayF; ?></h2>
	<table class="centered responsive-table">
		<thead>
			<th colspan="8">
				<div class="row">
					<div class="col s12">
						<div class="col s4 offset-s4">
	            <input type="search" id="search" placeholder="Buscar Clientes" autocomplete="off" value="<?php echo $sval ?>">
	          </div>
	          <div class="col s1">
	            <button class="btn-floating btn-large waves-effect blue" id="go">
	              <i class="material-icons">search</i>
	            </button>
	        	</div>
		      </div>
				</div>
			</th>
		</thead>
		<tbody>
			<tr>
				<td>Nombres</td>
				<td>Apellidos</td>
				<td>Documento Identidad</td>
				<td>Habitación</td>
				<td>Fecha Salida</td>
				<td>Hora de Entrada</td>
				<td>Hora de Salida</td>
				<td>Foto</td>
			</tr>
		<?php while($rowC = $resC->fetch_assoc()): ?>
			<tr>
				<td class="cap"><?php echo $rowC['nom'] ?></td>
				<td class="cap"><?php echo $rowC['ape'] ?></td>
				<td class="cap"><?php echo $rowC['ci'] ?></td>
				<td class="cap"><?php echo $rowC['room'] ?></td>
				<td class="cap">
					<?php 
					$x = $rowC['dexit'];
	        $f = explode('-', $x);
	        $fixed = $f[2]."-".$f[1]."-".$f[0];
	        echo $fixed; ?>
				</td>
				<td class="uper"><?php echo $rowC['he'] ?></td>
				<td class="uper"><?php echo $rowC['hs'] ?></td>
				<td>
					<div class="material-placeholder">
						<img class="materialboxed" src="../img/users/<?php echo $rowC['id_ced'] ?>" width="180" height="100">
					</div>
				</td>
			</tr>
		<?php
			endwhile;
			$squery = "SELECT * FROM users WHERE ";
			
			if($sval != ''){
				$squery .= "ci LIKE '%$sval%' OR nom LIKE '%$sval%' OR ape LIKE '%$sval%' OR fna LIKE '%$sval%' AND ";
			}
			
			$squery .= "dat = '$Tday' ORDER BY nom ASC";

			$fields = $db->query($squery);
	  	$total_rows = $fields->num_rows;
	  	$total = ceil($total_rows/$limit);
			?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="9" class="center">
						<ul class="pagination"><?php if($idp > 1): ?>
	        		<li class="waves-effect">
	              <a id="link" data-page="<?php echo ($idp-1); ?>">
	              	<i class="material-icons">chevron_left</i>
	              </a>
	            </li>
	          <?php else : ?>
	            <li class="disabled">
	              <a id="link" data-page="NaN">
	              	<i class="material-icons">chevron_left</i>
	              </a>
	            </li><?php endif; for($i = 1; $i <= $total; $i++): if($i == $idp) : ?>
	            <li class="waves-effect active light-blue lighten-1">
	            	<a id="link" data-page="NaN">
	            		<?php echo $i ?>
	            	</a>
	            </li><?php else: ?>
	            <li class="waves-effect">
	            	<a id="link" data-page="<?php echo $i ?>">
	            		<?php echo $i ?>
	            	</a> 
	            </li><?php endif; endfor; if($idp != $total) : ?>
	            <li class="waves-effect">
	              <a id="link" data-page="<?php echo ($idp+1); ?>"><i class="material-icons">chevron_right</i></a>
	            </li>
	          <?php else : ?>
	            <li class="disabled">
	              <a id="link" data-page="NaN"><i class="material-icons">chevron_right</i></a>
	            </li><?php
	          endif; ?>
	        </ul>
					</td>
				</tr>
			</tfoot>
		</table>
	<?php else: ?>
	<div class="row">
    <div class="col s12">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">No se Encuentran Registros</span>
          <p>
          	No hay registros para el día de hoy, proceda al listado general si necesita consultar
          	los clientes y las habitaciones que han ocupado.
          </p>
        </div>
        <div class="card-action">
          <a href="../php/data_Aday.php">Listado General</a>
          <a href="../html/">Registrar</a>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
</div>

<script>
	$(document).ready(function(){
    $('.materialboxed').materialbox();
  });
</script>