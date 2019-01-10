<?php
$who = $_POST['id'];
?>
<div id="modal1" class="modal bottom-sheet">
  <div class="modal-content">
  	<h4>Extensión del Tiempo de estadia</h4>
    <ul class="collection">
      <li class="collection-item avatar">
        <i class="material-icons circle blue accent-4">timelapse</i>
        <span class="title">Tiempo a Extender</span>
        <br>
        <br>
        <p>
        	<div class="row">
        		<div class="col s12">
        			<div class="row">
        				<div class="col">
        					<button class="btn btn-small light-blue darken-2 waves-effect send_moar" value="1,<?php echo $who ?>">1 Día</button>
        				</div>
        				<div class="col">
        					<button class="btn btn-small light-blue darken-2 waves-effect send_moar" value="2,<?php echo $who ?>">2 Días</button>
        				</div>
        				<div class="col">
        					<button class="btn btn-small light-blue darken-2 waves-effect send_moar" value="3,<?php echo $who ?>">3 Días</button>
        				</div>
        				<div class="col">
        					<button class="btn btn-small light-blue darken-2 waves-effect send_moar" value="4,<?php echo $who ?>">4 Días</button>
        				</div>
        				<div class="col">
        					<button class="btn btn-small light-blue darken-2 waves-effect send_moar" value="5,<?php echo $who ?>">5 Días</button>
        				</div>
        				<div class="col">
        					<button class="btn btn-small light-blue darken-2 waves-effect send_moar" value="6,<?php echo $who ?>">6 Días</button>
        				</div>
        				<div class="col">
        					<button class="btn btn-small light-blue darken-2 waves-effect send_moar" value="7,<?php echo $who ?>">7 Días</button>
        				</div>
        			</div>
        		</div>
        </p>
      </li>
    </ul>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect grey darken-4 btn">Cerrar</a>
  </div>
</div>

<script>
	$(document).ready(function(){
    $('.modal').modal()
    $('.modal').modal('open')
  });
</script>