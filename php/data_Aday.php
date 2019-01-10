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

$limit = 5;
$ini = 0;

$sval = isset($_POST['val']) ? $_POST['val'] : '';

if(isset($_POST['idp'])){
  $idp = $_POST['idp'];
  $ini = ($idp-1) * $limit;
}else{
  $idp = 1;
}

$queryC = "SELECT ANY_VALUE(users.ci) AS ci, ANY_VALUE(users.id_ced) AS id_ced, ANY_VALUE(users.nom) AS nom, ANY_VALUE(users.ape) AS ape, ANY_VALUE(users.room) AS nr, ANY_VALUE(users.he) AS he, ANY_VALUE(users.hs) AS hs, ANY_VALUE(users.dat) AS dat, ANY_VALUE(users.dat) AS dat, ANY_VALUE(users.dexit) AS dtf FROM users ";

if($sval != ''){
	$queryC .= "WHERE users.ci LIKE '%$sval%' OR users.nom LIKE '%$sval%' OR users.ape LIKE '%$sval%' OR users.dat LIKE '%$sval%' OR users.fna LIKE '%$sval%' ";
}

$queryC .= "ORDER BY users.dat ASC LIMIT $ini, $limit";

$resC = $db->query($queryC);
?>

<div class="section">
<?php if($resC->num_rows): ?>
	<h2 class="header center orange-text">Clientes Registrados</h2>
	<table class="centered responsive-table">
		<thead>
			<th colspan="9">
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
				<td>Fecha Ocupada</td>
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
				<td class="cap"><?php echo $rowC['nr'] ?></td>
				<td>
					<?php 
					$x = $rowC['dat'];
	        $f = explode('-', $x);
	        $fixed = $f[2]."-".$f[1]."-".$f[0];
	        echo $fixed;
					?>							
				</td>
				<td>
					<?php 
					$x2 = $rowC['dtf'];
	        $f2 = explode('-', $x2);
	        $fixed2 = $f2[2]."-".$f2[1]."-".$f2[0];
	        echo $fixed2;
					?>	
				</td>
				<td><?php echo $rowC['he'] ?></td>
				<td><?php echo $rowC['hs'] ?></td>
				<td>
					<img class="materialboxed" src="../img/users/<?php echo $rowC['id_ced'] ?>" width="180" height="100">
				</td>
			</tr>
			<?php
			endwhile;
			$squery = "SELECT ANY_VALUE(users.ci) AS ci, ANY_VALUE(users.id_ced) AS id_ced, ANY_VALUE(users.nom) AS nom, ANY_VALUE(users.ape) AS ape, ANY_VALUE(users.room) AS nr, ANY_VALUE(users.he) AS he, ANY_VALUE(users.hs) AS hs, ANY_VALUE(users.dat) AS dat, ANY_VALUE(users.dat) AS dat, ANY_VALUE(users.dexit) AS dtf FROM users";
			
			if($sval != ''){
				$squery .= " WHERE users.ci LIKE '%$sval%' OR users.nom LIKE '%$sval%' OR users.ape LIKE '%$sval%' OR users.dat LIKE '%$sval%' OR users.fna LIKE '%$sval%'";
			}

			$squery .= " ORDER BY users.dat ASC";
			
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
          	No hay registros existentes, proceda al registro de clientes.
          </p>
        </div>
        <div class="card-action">
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