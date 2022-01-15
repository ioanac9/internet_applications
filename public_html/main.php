<html>
<head>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<title>TVTIME</title>

<link rel="stylesheet" type="text/css" href="styling/styles.css">
</head>
<body>

<div class = "Title">
<h1>TVTime</h1>
</div>

<div class="botones">
<?php
        if (isset($_COOKIE['session'])) {
                echo "<h2><a href='myAccount.php'><button>My account</button></a></h2>";
                echo "<form action='exit.php' method='GET'>";
                echo"<h2><input type='submit' name='exit' value='Logout' style='background-color:lightyellow'></Input></h2>";
  }else
        {
                echo "<h2><a href='index.html'><button>Login</button></a></h2>";
        }
?>
</div>
<div><h1 align='center'>Movies</h1></div>


        <?php
        try {
                $pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
        }catch (PDOException $e) {
                 echo 'Connection failed: ' . $e->getMessage();
                  };
                         $query = "SELECT * FROM movie";
                         $result = $pdo->query($query);
                         ?>
                         <div class="container-1" style="margin-top: 10px;padding: 5px">
                         <?php
                         echo "<div id='tablax' class='table table-striped table-bordered' style='width:100%' border='1'>";
 $queryPonderada = "SELECT score FROM user_score";
        $resultPond = $pdo->query($queryPonderada);
        $suma2=0;
        $cnt2 = 0;
        while ($lll=$resultPond->fetch(PDO::FETCH_ASSOC)){
                $suma2 = $suma2 + $lll['score'];
                $cnt2 = $cnt2 + 1;
        }
        $media2 = $suma2/$cnt2;
                        while ($l=$result->fetch(PDO::FETCH_ASSOC)){
                        $url_pic = $l["url_pic"];
                            if (strpos($url_pic, 'MV') !== false) {
                                echo "<div class='container'>";
                                echo "<div><img src= 'images/".$l["url_pic"]."'></div>";
                                echo "<div class='back-card'><a href='searchInfo.php?id=".$l['id']."'>".$l["title"]."</a>";
                                $queryScore = "SELECT score FROM user_score WHERE user_score.id_movie= ".$l['id'];
                                $resultScore = $pdo->query($queryScore);
                                $suma = 0;
                                $cnt = 0;
                                        while ($ll=$resultScore->fetch(PDO::FETCH_ASSOC)){
                                        $suma = $suma + $ll['score'];
                                        $cnt = $cnt + 1;
                                        }
                                $media = $suma/$cnt;
                                echo $media;
                                echo "<span>Total ratings: ".$cnt."</span>";
                                echo "<span>".$l["date"]."</span>";
                                echo "</div>";
                                echo "</div>";
                                }
        }
        ?>
        </div>
</body>
</html>
