<?php 
$conn=mysqli_connect("HOST", "USERNAME", "PASSWORD", "DATABASE");
if (!$conn) {
  die('<script>alert("Connection failed")</script>');
}
if (isset($_POST["send"])) {
  $name=htmlspecialchars($_POST["name"]);
  $date=date("l, d F Y");
  $message=htmlspecialchars($_POST["message"]);
  $query=mysqli_query($conn, "INSERT INTO tb_wcichatbox (name, date, message) VALUES ('$name', '$date', '$message')");
  if ($query) {
    
  } else {
    echo '<script>alert("Failed")</script>';
  }
}
?>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="og:image" content="assets/img/favicon.jpg">
    <meta name="og:description" content="Simple Chat Box By White Cyber Illusion.">
    <link rel="icon" href="assets/img/favicon.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>WCI Chat Box</title>
  </head>
  <body>
    <div class="card bg-dark text-light content">
      <div class="card-header text-center">
        <h5><b>WCI Chat <span class="text-danger">Box</span></b></h5>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="message p-4 bg-light">
            <?php 
              $query2=mysqli_query($conn, "SELECT * FROM tb_wcichatbox");
              if (mysqli_num_rows($query2)>0) {
                while ($row=mysqli_fetch_assoc($query2)) {
            ?>
            <div id="<?= $row["id"] ?>" class="alert alert-success"><?= $row["name"] ?> &nbsp;- &nbsp;<?= $row["date"] ?><br>
              <code><?= $row["message"] ?></code>
            </div>
            <script>
              window.location.href="#<?= $row["id"] ?>";
            </script>
            <?php
              }
            }
            ?>
          </div>
          <div class="input mt-3">              
            <input type="text" class="form-control form_data" name="name" id="name" placeholder="your name" autocomplete="off" value="<?= $name ?>" required>
            <input type="text" class="msg-input mt-3 form-control form_data" name="message" placeholder="enter your message.." autocomplete="off" required/>
            <button name="send" type="submit" class="btn btn-danger" id="button"><i class="text-center fab fa-telegram"></i></button>
          </div>
        </form>
      </div>
    </div>
    <script src="https://kit.fontawesome.com/fe3af44ea5.js" crossorigin="anonymous"></script>
  </body>
</html>