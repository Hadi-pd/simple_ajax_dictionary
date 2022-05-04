<? require_once('main.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="base.css">
  <script type="text/javascript" src="jquery-3.5.1.min.js"></script>
  <title>Ajax Dictionary</title>
</head>
<body>
<div id="header-wrapper">

</div>

<div id="content" class="ltr">
  <ul class="cols">
    <li class="w50"><input style="width: 300px;" id="search" placeholder="Type keywords Here" value="" autocomplete="off"></li>
    <li class="w50"><div id="preview"></div></li>
  </ul>
</div>
</body>
</html>

<script>
  $(function(){
    $('#search').on('keyup', function(){
      var value = $(this).val();
      $.ajax(
        'feed.php',{
          type: 'post',
          dataType: 'json',
          data:{
            keyword: value
          },
          success: function(data){
//            $("#preview").html(data.html);
            var records = data.raw;
            var html = '';

              for (i in records){
                var record = records[i];
                html += '<strong>' + record.word + '</strong><br><span>' + record.meaning + '</span><br>'
              }

            $("#preview").html(html);
          }
        }
      );
    });
  });
</script>