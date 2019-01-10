/* ########## Initialize ########## */
function take() {
  $('#video-container').attr('hidden', false);
  var width = 400;
  var height = 240;
  var consts = {audio: false, video: {width: width, height: height}};

  var vid, canvas, photo, btn, getStream;
  
  vid = document.getElementById('video');
  canvas = document.getElementById('canvas');
  photo = document.getElementById('img');
  btn = document.getElementById('take');

  navigator.mediaDevices.getUserMedia(consts)

  .then(function(stream){
    if ("srcObject" in vid){
      getStream = stream.getTracks()[0];
      vid.srcObject = stream;
    }else{
      vid.src = window.URL.createObjectURL(stream);
    }
    video.onloadedmetadata = function(e){
      vid.play();
    };
  })
  .catch(function(err) {
    console.log(err.name + ": " + err.message);
  });

  function clearphoto() {
    var context = canvas.getContext('2d');
    context.fillStyle = "#CCC";
    context.fillRect(0, 0, canvas.width, canvas.height);

    var filePng = canvas.toDataURL('image/png;base64');
    photo.setAttribute('src', filePng);
  }

  function takepicture(){
    var context = canvas.getContext('2d');
    
    if(width && height){
      canvas.width = width;
      canvas.height = height;
      context.drawImage(vid, 0, 0, width, height);
      
      var filePng = canvas.toDataURL('image/png');
      photo.setAttribute('src', filePng);
    }else{
      clearphoto();
    }
  }

  function savePicture(){
     filePng = canvas.toDataURL('image/png');
    
    function fileToBlob(base64, mime){
      mime = mime || '';
      let sliceSize = 1024;
      let byteChars = window.atob(base64);
      let byteArr = [];
      
      for(let offset = 0, len = byteChars.length; offset < len; offset += sliceSize){
        var slice = byteChars.slice(offset, offset + sliceSize);

        var byteNumbers = new Array(slice.length);
        for(let i = 0; i < slice.length; i++){
          byteNumbers[i] = slice.charCodeAt(i);
        }
        var bytAr = new Uint8Array(byteNumbers);
        byteArr.push(bytAr);
      }
      return new Blob(byteArr, {type:mime});
    }

    var file64 = filePng.replace(/^data:image\/(png|jpeg);base64,/, "");
    var pngBlob = fileToBlob(file64, 'image/png');
    var fm = new FormData();

    fm.append('file', pngBlob);
    $.ajax({
      url: "../php/upload/user.php",
      type: 'post',
      data: fm,
      contentType: false,
      cache: false,
      processData:false
    })
    .done(function(data) {
      $('#id_ced').val(data).addClass('valid');
      $('#video-container').attr('hidden', true);
    });
  }

  btn.addEventListener('click', function(e){
    takepicture();
    e.preventDefault();
  }, false);

  clearphoto();

  $(document).on('click', '#reset', function(){
    clearphoto();
  })

  $(document).on('click', '#load', function(e){
    e.preventDefault();
    getStream.stop();
    savePicture();
  })
};
/* ########## End ########## */

$(document).on('click', '#openC', function(e){
  e.preventDefault();
  take();
})