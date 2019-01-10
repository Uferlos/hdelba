<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="120"/>
  <meta name="robots" content="index, follow">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta autor="Manuel Ramirez">
  <title>Hotel Doña Elba</title>

<?php 
  include 'files.html';
  include '../php/config/config.php';
  include '../php/config/getRoom.php';  
?>

</head>
<body>
  <header>
    <?php include 'navbar.php'; ?>
  </header>

  <main>
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center orange-text">Registro de Clientes</h1>
        <div class="row center">
          <h4 class="header col s12 light">Datos del Cliente</h4>
        </div>

        <div class="row" id="video-container" hidden>
          <div class="col s12">
            <div class="col s6">
              <video id="video" autoplay></video>
            </div>
            <div class="col s6">
              <img id="img" height="240" width="400">
            </div>
            <button class="btn btn-small col s4" id="take">Foto</button>
            <button class="btn btn-small col s4" id="reset">Resetear</button>
            <button class="btn btn-small col s4" id="load">Guardar</button>
          </div>
        </div>
        <canvas hidden="hidden" id="canvas"></canvas>

        <div class="row">
          <form class="col s12" autocomplete="off" id="reg">
            <div class="row">
              
              <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="ci" onchange="mascara()" type="text" name="ci" class="validate autocomplete ced cap" required>
                <label for="ci">Cedula de Identidad</label>
              </div>

              <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="nom" type="text" name="nom" class="validate text-only cap" required>
                <label id="lnom" for="nom">Nombres</label>
              </div>
              
              <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="ape" type="text" name="ape" class="validate text-only cap" required>
                <label id="lape" for="ape">Apellidos</label>
              </div>
              
              <div class="file-field input-field col s6s" style="width: 400px;">
                <div class="btn amber darken-4">
                  <span><i class="material-icons">camera_alt</i></span>
                  <input type="file" id="openC">
                </div>
                <div class="file-path-wrapper">
                  <input id="id_ced" name="id_ced" class="file-path validate" type="text" placeholder="Foto del documento">
                </div>
              </div>
              
              <div class="input-field col s4">
                <i class="material-icons prefix">timelapse</i>
                <select id="tt" name="tt" class="validate" required>
                  <option value="" selected>Seleccione una opción</option>
                  <option value="3">3 Horas</option>
                  <option value="24">1 Noche</option>
                  <option value="2d">2 Días</option>
                  <option value="3d">3 Días</option>
                  <option value="4d">4 Días</option>
                  <option value="5d">5 Días</option>
                  <option value="6d">6 Días</option>
                  <option value="7d">7 Días</option>
                </select>
                <label for="tt">Tiempo de Estadia</label>
              </div>
              
              <div class="input-field col s4">
                <i class="material-icons prefix">timer</i>
                <input id="he" type="text" name="he" readonly>
                <label id="lhe" for="he">Hora de Entrada</label>
              </div>
              
              <div class="input-field col s4">
                <i class="material-icons prefix">timer</i>
                <input id="hs" type="text" name="hs" readonly>
                <label id="lhs" for="hs">Hora de Salida</label>
              </div>
            
            </div>
            <div class="row center">
              <h4 class="header col s12 light">Habitación</h4>
            </div>
            <table class="centered responsive-table">
              <tbody>
                <tr>
                  <td>
                    <button type="button" class="btn btn-small" id="h1" value="h1">
                      H1
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-small" id="h2" value="h2">
                      H2
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-small" id="h3" value="h3">
                      H3
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-small" id="h4" value="h4">
                      H4
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn btn-small" id="h5" value="h5">
                      H5
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-small" id="h6" value="h6">
                      H6
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-small" id="h8" value="h8">
                      H8
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-small" id="h9" value="h9">
                      H9
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn btn-small" id="h10" value="h10">
                      H10
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-small" id="h11" value="h11">
                      H11
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-small" id="h12" value="h12">
                      H12
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-small" id="h13" value="h13">
                      H13
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn btn-small" id="h14" value="h14">
                      H14
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-small" id="h15" value="h15">
                      H15
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-small" id="h16" value="h16">
                      H16
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-small" id="h17" value="h17">
                      H17
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="button" class="btn btn-small" id="h18" value="h18">
                      H18
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-small" id="h19" value="h19">
                      H19
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-small" id="h20" value="h20">
                      H20
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-small" id="h21" value="h21">
                      H21
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div> 
        <div class="row center">
          <button class="btn waves-effect waves-dark light-blue accent-3" type="submit" form="reg">
            <i class="material-icons right">send</i>Registrar
          </button>
        </div>
      </div>
    </div>

    <?php include '../php/config/rmsl.php'; ?>
    <script src="../js/ttfr.js"></script>
    <script src="../js/initF.js"></script>
  </main>
  <div id="content"></div>
  <!--?php include 'footer.html'; ?-->
</body>
</html>