$(document).ready(function(){
	let time = new Date()
	let hh = time.getHours()
	let mm = time.getMinutes()
	let ss = time.getSeconds()
	
	if (hh > 11 ) {
  	var mr = 'PM';
  }else{
    var mr = 'AM';
  }

  if(hh === 1){hh = '01';}
  else if(hh === 2){hh = '02';}
  else if(hh === 3){hh = '03';}
  else if(hh === 4){hh = '04';}
  else if(hh === 5){hh = '05';}
  else if(hh === 6){hh = '06';}
  else if(hh === 7){hh = '07';}
  else if(hh === 8){hh = '08';}
  else if(hh === 9){hh = '09';}

  if(hh === 13){hh = '01';}
  else if(hh === 14){hh = '02';}
  else if(hh === 15){hh = '03';}
  else if(hh === 16){hh = '04';}
  else if(hh === 17){hh = '05';}
  else if(hh === 18){hh = '06';}
  else if(hh === 19){hh = '07';}
  else if(hh === 20){hh = '08';}
  else if(hh === 21){hh = '09';}
  else if(hh === 22){hh = 10;}
  else if(hh === 23){hh = 11;}
  else if(hh === 24){hh = 12;}

  if(mm === 0){mm = '00';}
  else if(mm === 1){mm = '01';}
  else if(mm === 2){mm = '02';}
  else if(mm === 3){mm = '03';}
  else if(mm === 4){mm = '04';}
  else if(mm === 5){mm = '05';}
  else if(mm === 6){mm = '06';}
  else if(mm === 7){mm = '07';}
  else if(mm === 8){mm = '08';}
  else if(mm === 9){mm = '09';}

  if(ss === 0){ss = '00';}
  else if(ss === 1){ss = '01';}
  else if(ss === 2){ss = '02';}
  else if(ss === 3){ss = '03';}
  else if(ss === 4){ss = '04';}
  else if(ss === 5){ss = '05';}
  else if(ss === 6){ss = '06';}
  else if(ss === 7){ss = '07';}
  else if(ss === 8){ss = '08';}
  else if(ss === 9){ss = '09';}

	$('#he').val(hh+':'+mm+':'+ss+' '+mr).addClass('valid')
	$('#he').next('#lhe').addClass('active')

	$('#tt').change(function(){
    let te = this.value
    let tt = parseInt(this.value)
    let hs
    hh = time.getHours()

    function hsfu(){
      if(hs === 1){hs = '01';}
      else if(hs === 2){hs = '02';}
      else if(hs === 3){hs = '03';}
      else if(hs === 4){hs = '04';}
      else if(hs === 5){hs = '05';}
      else if(hs === 6){hs = '06';}
      else if(hs === 7){hs = '07';}
      else if(hs === 8){hs = '08';}
      else if(hs === 9){hs = '09';}
      else if(hs === 13){hs = '01';}
      else if(hs === 14){hs = '02';}
      else if(hs === 15){hs = '03';}
      else if(hs === 16){hs = '04';}
      else if(hs === 17){hs = '05';}
      else if(hs === 18){hs = '06';}
      else if(hs === 19){hs = '07';}
      else if(hs === 20){hs = '08';}
      else if(hs === 21){hs = '09';}
      else if(hs === 22){hs = 10;}
      else if(hs === 23){hs = 11;}
      else if(hs === 24){hs = 12;}
      else if(hs === 25){hs = '01'; mr = 'AM';}
      else if(hs === 26){hs = '02'; mr = 'AM';}
      else if(hs === 27){hs = '03'; mr = 'AM';}
    }

    if(te == '24' || te == '2d' || te == '3d' || te == '4d' || te == '5d' || te == '6d' || te == '7d'){
      /*hs = hh;
      if (hh > 11 ) {mr = 'PM';}
      else{mr = 'AM';}

      hsfu()
      */
      
      $('#hs').val('01:00:00 PM').addClass('valid')
      $('#hs').next('#lhs').addClass('active')
    
    }else{
  		if (hh > 11 ) {mr = 'PM';}
  		else{mr = 'AM';}

  		if(tt < 12){hs = tt + hh;}
  		else if(tt === 12 && mr === 'AM'){hs = hh; mr = 'PM'}
  		else if(tt === 12 && mr === 'PM'){hs = hh; mr = 'AM'}
  		else if(tt === 24){hs = hh;}

      if(tt < 12 && hs < 12){mr = 'AM';}
      else if(tt < 12 && hs > 11){mr = 'PM';}

      hsfu()

  		$('#hs').val(hs+':'+mm+':'+ss+' '+mr).addClass('valid')
  		$('#hs').next('#lhs').addClass('active')
    }
	})
})