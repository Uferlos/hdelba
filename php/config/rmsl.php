<script>
var rsf = []; //rooms free
var rsb = []; //rooms busy
/* -------///////////---------- */
/* -------///////////---------- */
var htf = []; //hour to free
var dtf = []; //day to free
/* -------///////////---------- */
/* -------///////////---------- */
var h = 0;
var g = 0;
var btt;
</script>

<?php
for($i = 0; $i < count($roomsF); $i++): ?>
  <script>
    h = <?php echo $i ?>;
    rsf[h] = '<?php echo $roomsF[$i] ?>';
    
    btt = document.getElementById(''+rsf[h]+'').value;

    if(rsf[h] === btt){
      $('#'+rsf[h]+'').addClass('green accent-4 fr');
    }
  </script>
<?php endfor;

for($j = 0; $j < count($roomsB); $j++): ?>
  <script>
    g = <?php echo $j ?>;
    rsb[g] = '<?php echo $roomsB[$j] ?>';
    htf[g] = '<?php echo $roomsBtF[$j] ?>';
    dtf[g] = '<?php echo $roomsBdF[$j] ?>';
    
    btt = document.getElementById(''+rsb[g]+'').value;

    if(rsb[g] === btt){
      $('#'+rsb[g]+'').addClass('red accent-4 bs').attr('id', 'setF');
    }
  </script>
<?php endfor; ?>