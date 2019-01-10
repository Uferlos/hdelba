/* ########## Initialize Materialize ########## */
$(document).ready(function(){
  $('.sidenav').sidenav()
  $('select').formSelect()

  //links
  $('#main').click(function(){
    location.href = '../html/'
  })
  $('#nReg').click(function(){
    location.href = '../html/'
  })
  $('#list_acr').click(function(){
    location.href = '../html/list_Tday.php'
  })
  $('#list_fh').click(function(){
    location.href = '../html/list_Aday.php'
  })
  $('#list_bsr').click(function(){
    location.href = '../html/list_Ro.php'
  })
  $('#nRegMv').click(function(){
    location.href = '../html/'
  })
  $('#list_acrMv').click(function(){
    location.href = '../html/list_Tday.php'
  })
  $('#list_fhMv').click(function(){
    location.href = '../html/list_Aday.php'
  })
  $('#list_bsrMv').click(function(){
    location.href = '../html/list_Ro.php'
  })
});
/* ########## End ########## */


var rms = [];
var k = 0;

$(document).on('click', '.fr', function(e){
  rms[k] = this.value
  k++
  e.preventDefault()
  $(this).removeClass('green accent-4 fr')
  $(this).addClass('orange darken-2 vl')
})

$(document).on('click', '.vl', function(e){
  let vlb = this.value
  for (let z = 0; z < rms.length; z++) {
    if(rms[z] === vlb){
      delete rms[z];
      rms.sort();
      rms.pop()
    }
  }
  Array.prototype.clean = function(deleteValue) {
    for (let i = 0; i < this.length; i++) {
      if (this[i] == deleteValue) {         
        this.splice(i, 1);
        i--;
      }
    }
    return this;
  }
  rms.clean(undefined);
  //console.log(rms)
  e.preventDefault()
  $(this).removeClass('orange darken-2 vl')
  $(this).addClass('green accent-4 fr')
})

$(document).on('click', '.bs', function(e){
  e.preventDefault()
  return false
})

/* ####### Register ####### */
$(document).on('submit', '#reg', function(e){
  e.preventDefault()

  let nom = $('#nom').val()
  let ape = $('#ape').val()
  let ci = $('#ci').val()
  let tt = $('#tt').val()
  let he = $('#he').val()
  let hs = $('#hs').val()
  let fln = $('#id_ced').val()
  
  $.ajax({
    type: 'post',
    data: {
      nom: nom,
      ape: ape,
      ci: ci,
      tt: tt,
      he: he,
      hs: hs,
      id_ced: fln,
      room:rms,
      quest: 'reg'
    },
    dataType: 'html',
    url: '../php/class/customer.php'
  })
  .done(function(response){
    $('#content').html(response)
    location.href = '../html/'
  })
})

$(document).on('click', '#setF', function(){
  let nr = this.value
  let conf = confirm('¿Desocupar la habitación?')
  if(conf){
    $.ajax({
      type: 'post',
      data:{
        match: nr,
        quest: 'setF'
      },
      dataType: 'html',
      url: '../php/class/customer.php'
    })
    .done(function(response){
      $('#content').html(response)
      location.reload()
    })
  }
})

$(document).on('click', '#moar', function(){
  let id = this.value
  $.ajax({
    type: 'post',
    data: {'id':id},
    dataType: 'html',
    url: '../php/extend.php'
  })
  .done(function(response){
    $('#content').html(response)
  })
})


$(document).on('click', '.send_moar', function(){
  let ardat = this.value.split(',')
  let fdat = ardat[0]
  let sdat = ardat[1]
  
  $.ajax({
    type: 'post',
    data: {
      adtime:fdat,
      match:sdat,
      quest:'ext'
    },
    dataType: 'html',
    url: '../php/class/customer.php'
  })
  .done(function(response){
    $('#content').html(response)
    location.reload()
  })
})

$(document).on('click', '#bk', function(){
  $.getJSON('../php/class/backup.php', function(response){
    if(response[0].info == 1){
      alert('Se Creo El Respaldo Exitosamente');
    }else{
      alert('Error al Crear el Respaldo');
    }
  });
});