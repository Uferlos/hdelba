<?php
include '../config/config.php';

class Customer{

	private $ci, $id_ced, $nom, $ape, $room, $he, $hs, $adtime, $tt, $db, $match;

	public function __construct($ci, $id_ced, $nom, $ape, $room, $he, $hs, $tt, $adtime, $db, $match){
		$this->ci = $ci;
		$this->id_ced = $id_ced;
		$this->nom = $nom;
		$this->ape = $ape;
		$this->room = $room;
		$this->he = $he;
		$this->hs = $hs;
		$this->tt = $tt;
		$this->adtime = $adtime;
		$this->db = $db;
		$this->match = $match;
	}

	public function Reg(){
		date_default_timezone_set('America/Caracas');
		$f = date('Y-m-d');
		$ttt = $this->tt;
		if($ttt == '3'){
			$nf = date('Y-m-d');
		}
		elseif($ttt == '2d'){
			$nf = date('Y-m-d', strtotime($f .' +2 day'));
		}
		elseif($ttt == '3d'){
			$nf = date('Y-m-d', strtotime($f .' +3 day'));
		}
		elseif($ttt == '4d'){
			$nf = date('Y-m-d', strtotime($f .' +4 day'));
		}
		elseif($ttt == '5d'){
			$nf = date('Y-m-d', strtotime($f .' +5 day'));
		}
		elseif($ttt == '6d'){
			$nf = date('Y-m-d', strtotime($f .' +6 day'));
		}
		elseif($ttt == '7d'){
			$nf = date('Y-m-d', strtotime($f .' +7 day'));
		}
		else{
			$nf = date('Y-m-d', strtotime($f .' +1 day'));
		}
		
		$fna = $this->nom.' '.$this->ape;

		$query = "INSERT INTO users VALUES(
			null, '$this->ci', '$this->id_ced', '$this->nom', '$this->ape', '$fna',
			'".implode(' - ', $this->room)."' , '$this->he', '$this->hs', '$this->tt', '$f', '$nf')";

		if($this->db->query($query)): ?>
			<script>
				alert('¡Registrado con exito!')
			</script><?php
			for($p = 0; $p < count($this->room); $p++):
				$val = $this->room[$p];
				$qr = "UPDATE rooms SET sts = 'bs', dtf = '$nf', htf = '$this->hs', who = '$this->ci', dat = '$f' WHERE nr = '$val'";
				$this->db->query($qr);
			endfor;
		else: ?>
			<script>
				alert("Error al registrar <?php echo $this->db->error ?>")
			</script><?php
		endif;
	}

	public function SetFree(){
		$query = "UPDATE rooms SET sts = 'fr', who = null, htf = null, dtf = null, dat = null WHERE nr = '$this->match'";
		if($this->db->query($query)): ?>
			<script>
				alert('Habitación Desocupada')
			</script><?php
		else: ?>
			<script>
				alert("Error al procesar <?php echo $this->db->error ?>")
			</script><?php
		endif;
	}

	public function Extend(){
		$query = "SELECT ci, dexit FROM users WHERE id = $this->match";
		if(!$re = $this->db->query($query)){
			echo $this->db->error;
			exit();
		}
		$ro = $re->fetch_assoc();
		
		date_default_timezone_set('America/Caracas');
		$ad = date('Y-m-d', strtotime($ro['dexit'].' +'.$this->adtime.' day'));

		$qup = "UPDATE users SET dexit = '$ad' WHERE id = '$this->match'";
		$qur = "UPDATE rooms SET dtf = '$ad' WHERE who = '$ro[ci]'";
		
		if($this->db->query($qup) && $this->db->query($qur)): ?>
			<script>
				alert('Tiempo de estadia extendido <?php echo $this->adtime ?> días')
			</script><?php
		else: ?>
			<script>
				alert("Error al procesar <?php echo $this->db->error ?>")
			</script><?php
		endif;
	}
}

$db = new mysqli(host, usr, pssw, db);
$db->set_charset('utf8');

$ci = isset($_REQUEST['ci']) ? $_REQUEST['ci'] : '';
$id_ced = isset($_REQUEST['id_ced']) ? $_REQUEST['id_ced'] : 'ced.png';
$nom = isset($_REQUEST['nom']) ? $_REQUEST['nom'] : '';
$ape = isset($_REQUEST['ape']) ? $_REQUEST['ape'] : '';
$room = isset($_REQUEST['room']) ? $_REQUEST['room'] : '';
$he = isset($_REQUEST['he']) ? $_REQUEST['he'] : '';
$hs = isset($_REQUEST['hs']) ? $_REQUEST['hs'] : '';
$tt = isset($_REQUEST['tt']) ? $_REQUEST['tt'] : '';
$adtime = isset($_REQUEST['adtime']) ? $_REQUEST['adtime'] : '';
$match = isset($_REQUEST['match']) ? $_REQUEST['match'] : '';
$quest = isset($_REQUEST['quest']) ? $_REQUEST['quest'] : '';

$obj = new Customer($ci, $id_ced, $nom, $ape, $room, $he, $hs, $tt, $adtime, $db, $match);

switch ($quest) {
	case 'reg':
		$obj->Reg();
		break;
	case 'setF':
		$obj->SetFree();
		break;
	case 'ext':
		$obj->Extend();
		break;
	default:
		header('location: ../../');
		break;
}
?>