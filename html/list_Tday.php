<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="robots" content="index, follow">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta autor="Manuel Ramirez">
  <title>Hotel Doña Elba</title>
  <?php include '../html/files.html'; ?>
</head>
<body>
  <header>
    <?php include '../html/navbar.php'; ?>
  </header>
  <main>
    <script>
      $(document).ready(function(){
        $('main').load('../php/data_Tday.php')
      })

      $(document).on('click', '#go', function(){
        let vls = $('#search').val()
        $('main').load('../php/data_Tday.php', {val:vls})
      })

      $(document).on('click', '#link', function(e){
        e.preventDefault()
        var vls = $('#search').val()
        var idp = $(this).attr("data-page")
        console.log()
        if(idp === 'NaN'){
          return false;
        }
        $('main').load('../php/data_Tday.php',{val:vls, idp:idp})
      })
    </script>
  </main>

</body>
</html>