var t = new Date()
var h, m, acm, f, d, mn, y;
var alerta = []
//time
h = t.getHours()
m = t.getMinutes()
//date
d = t.getDate()
mn = t.getMonth() + 1
y = t.getFullYear()

if (h > 11 ) {acm = 'PM';}
else{acm = 'AM';}

if(h === 13){h = '01';}
else if(h === 14){h = '02';}
else if(h === 15){h = '03';}
else if(h === 16){h = '04';}
else if(h === 17){h = '05';}
else if(h === 18){h = '06';}
else if(h === 19){h = '07';}
else if(h === 20){h = '08';}
else if(h === 21){h = '09';}
else if(h === 22){h = 10;}
else if(h === 23){h = 11;}
else if(h === 24){h = 12;}

if(h === 1){h = '01';}
else if(h === 2){h = '02';}
else if(h === 3){h = '03';}
else if(h === 4){h = '04';}
else if(h === 5){h = '05';}
else if(h === 6){h = '06';}
else if(h === 7){h = '07';}
else if(h === 8){h = '08';}
else if(h === 9){h = '09';}

if(m === 0){m = '00';}
else if(m === 1){m = '01';}
else if(m === 2){m = '02';}
else if(m === 3){m = '03';}
else if(m === 4){m = '04';}
else if(m === 5){m = '05';}
else if(m === 6){m = '06';}
else if(m === 7){m = '07';}
else if(m === 8){m = '08';}
else if(m === 9){m = '09';}

if(mn === 1){mn = '01';}
else if(mn === 2){mn = '02';}
else if(mn === 3){mn = '03';}
else if(mn === 4){mn = '04';}
else if(mn === 5){mn = '05';}
else if(mn === 6){mn = '06';}
else if(mn === 7){mn = '07';}
else if(mn === 8){mn = '08';}
else if(mn === 9){mn = '09';}

let ach = h+':'+m //actual hour

let acd = y+'-'+mn+'-'+d //actual day
let d2 = new Date(acd) //create a date object from actual date

let dln = dtf.length
let cna = 0

if(dln > 0){
  for(let i = 0; i < dln; i++){
    let d1 = new Date(dtf[i]) //create a date object from exit day
    let bm = htf[i].substring(9, 11) //exit meridian
    let hb = htf[i].substring(0, 5) //exit hour
    var pas
    
    if((ach < hb) && (acm === bm)){ 
      pas = false;
    }
    else if((ach > hb) && (acm === bm)){
      pas = true; 
    }
    else if((ach === hb) && (acm === bm)){ 
      pas = true;
    }
    else if((ach < hb) && (acm < bm)){
      pas = false;
    }
    else if((ach === hb) && (acm < bm)){
      pas = false;
    }
    else if((ach < hb) && (acm < bm)){
      pas = false;
    }
    else if((ach < hb) && (acm > bm)){
      pas = true;
    }
    else if((ach > hb) && (acm > bm)){
      pas = true;
    }
    else if((ach === hb) && (acm > bm)){ 
      pas = true;
    }
    
    if((d2.getTime() >= d1.getTime()) && pas){
      alerta[cna] = rsb[i];
      cna++;
    }
  }
}
if(alerta.length > 0){
  alert('Tiempo de la Habitación '+alerta.join(' - ')+' ha transcurrido');
}