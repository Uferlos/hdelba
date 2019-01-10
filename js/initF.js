$('.ced').mask('A-00.000.000',{
  'translation':{
    A:{pattern: /[VE,ve]/}
  }
});

function mascara(){
  var size = $('#ci').val();
  if(size.length == 0){
    $('.ced').mask('A-00.000.000',{
      'translation':{
        A:{pattern: /[VE,ve]/}
      }
    });
  }
  else if(size.length != 12){
    $('#ci').mask('A-0.000.000',{
      'translation':{
        A:{pattern: /[VE,ve]/}
      }
    });
  }else{
    $('#ci').mask('A-00.000.000',{
      'translation':{
        A:{pattern: /[VE,ve]/}
      }
    });
  }
}
$('.text-only').keydown(function(v){
  if ((v.keyCode > 47 && v.keyCode < 58)){
    v.preventDefault();
  }
});

$(function(){
  $.ajax({
    dataType: 'json',
    url: '../php/json/autoC.php',
  })
  .done(function(res){
    var arr = {};
    for(let i = 0; i < res.length; i++){
      arr[res[i]] = null;
    }
    $('.autocomplete').autocomplete({
      data: arr,
      limit: 5
    })
  })
})

$(document).on('change', '#ci', function(){
  var ced = this.value;
  if(ced === ''){
    return false;
  }
  $.ajax({
    type: 'post',
    data: {ci: ced},
    dataType: 'json',
    url: '../php/json/nomC.php'
  })
  .done(function(res){
    if(res.length < 1){
      return false
    }else{
      $('#nom').val(res.nom).addClass('valid')
      $('#nom').next('#lnom').addClass('active')
      $('#ape').val(res.ape).addClass('valid')
      $('#ape').next('#lape').addClass('active')
      $('#openC').attr('disabled', true)
      $('#id_ced').val(res.picure).addClass('valid')
    }
  })
})
