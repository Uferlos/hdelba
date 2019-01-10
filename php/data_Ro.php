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

if(isset($_POST['idp'])){
  $idp = $_POST['idp'];
  $ini = ($idp-1) * $limit;
}else{
  $idp = 1;
}

$query = "SELECT rooms.nr, rooms.sts, rooms.htf, rooms.dat AS rodat, rooms.who, ANY_VALUE(users.id) AS id, ANY_VALUE(users.ci) AS ci, ANY_VALUE(users.nom) AS nom, ANY_VALUE(users.ape) AS ape, ANY_VALUE(users.he) AS he, ANY_VALUE(users.hs) AS hs, ANY_VALUE(users.dexit) AS dtf FROM rooms INNER JOIN users ON rooms.who = users.ci WHERE rooms.sts = 'bs' AND rooms.dat = users.dat GROUP BY rooms.nr ORDER BY ANY_VALUE(users.he) ASC LIMIT $ini, $limit";

if(!$res = $db->query($query)){
	echo $db->error;
	exit();
}
?>

<div class="section">
<?php if($res->num_rows): ?>
	<h2 class="header center orange-text">Habitaciones Ocupadas</h2>
	<table class="centered responsive-table">
		<thead>
			<th colspan="8">Listado Completo de la fecha <?php echo $TdayF; ?></th>
		</thead>
		<tbody>
			<tr>
				<td>Habitación</td>
				<td>Usuario</td>
				<td>Hora de Entrada</td>
				<td>Hora de Salida</td>
				<td>Documento</td>
				<td>Fecha Ocupada</td>
				<td>Fecha Salida</td>
				<td>Opciones</td>
			</tr>
		<?php while($row = $res->fetch_assoc()): ?>
			<tr>
				<td class="cap"><?php echo $row['nr'] ?></td>
				<td class="cap"><?php echo $row['nom']. ' '. $row['ape'] ?></td>
				<td class="uper"><?php echo $row['he'] ?></td>
				<td class="uper"><?php echo $row['hs'] ?></td>
				<td class="cap"><?php echo $row['who'] ?></td>
				<td>
					<?php 
					$x = $row['rodat'];
	        $f = explode('-', $x);
	        $fixed = $f[2]."-".$f[1]."-".$f[0];
	        echo $fixed;
					?>							
				</td>
				<td>
					<?php 
					$x2 = $row['dtf'];
	        $f2 = explode('-', $x2);
	        $fixed2 = $f2[2]."-".$f2[1]."-".$f2[0];
	        echo $fixed2;
					?>	
				</td>
				<td>
					<button class="btn btn-small blue waves-effect" id="moar" value="<?php echo $row['id'] ?>">Extender</button>
					<button class="btn btn-small red waves-effect" id="setF" value="<?php echo $row['nr'] ?>">Desocupar</button>
				</td>
			</tr>
		<?php
		endwhile;
		$squery = "SELECT rooms.nr, rooms.sts, rooms.dtf, rooms.htf, rooms.dat AS rodat, rooms.who, ANY_VALUE(users.ci) AS ci, ANY_VALUE(users.nom) AS nom, ANY_VALUE(users.ape) AS ape, ANY_VALUE(users.he) AS he, ANY_VALUE(users.hs) AS hs FROM rooms INNER JOIN users ON rooms.who = users.ci WHERE rooms.sts = 'bs' AND rooms.dat = users.dat GROUP BY rooms.nr";
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
          	No hay habitaciones ocupadas, proceda al listado general si necesita consultar
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
<div id="content"></div>