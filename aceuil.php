<!DOCTYPE html>
   <?php 
    include("connect.php");
  ?>    
<html lang="en">
<head>
  
    <meta charset="UTF-8">
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>buvette </title>
    <link href="css/bootstrap.css">
       <style>
    .img{
                float: left;
            }
            #h{
                width: 70px;
                height: 70px;
            }
            .titre{
                color:  Navy;
                margin-left: 100px;
            }
            h5{
                color:  LightBlue;
            }
            ul li{
                float:left;
                margin: 20px;
                
            }
            .list{
                color: white;
                background-color:  Navy;
                height: 50px;
                text-align: center;
            }
            ul li a{
                text-decoration: none;
                color: white;
            }
            ul{
                margin-left: 200px;
                list-style: none;
                font-size: 20px;
            }
            .list ul li:hover{
                opacity: 0.6;
                color: red;
                background-color:  Navy;
                width:200px;
                
            
            }
            .pied{
                width: 100%;
                height: 70px;
                color: white;
                background-color: Navy;
            }
            .y{
                 background-color:#E5E7E9;
                height: 400px;
            }
            #table{
                float:left;
                width: 50%;
                height: 50%;
                color:black;
                
            }
    
    </style>    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="img"><img src="material_projet/img/logo.jpg" id="h"></div>
            <div class="titre"><h1>EUROBuvettes </h1>
            <h5>Le Site de Gestien de Buvette de l'EURO 2016 !!</h5></div>
        
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="list">
              <ul>
                  <li><a href="#">Accueil.php</a></li>
                  <li><a href="#">Statistiqye.php</a></li>
                  <li><a href="#">Recherchemembrres.php</a></li>
                  <li><a href="#">Affectations.php</a></li>
                  <li><a href="#">Prive.php</a></li>
                </ul>
                <section name="container" class="container">
                        <?php 
                              $req = "SELECT m.idM as mid, m.date, m.scoreA, m.scoreB, a.pays as paysA, a.drapeau as drapeauA, b.pays as paysB,b.drapeau as drapeauB ,m.scoreB, scoreA, scoreB, count(*) as buvetteOuvrant
                                           FROM `Match` m,`Equipe` a,`Equipe` b, est_ouverte o
                                           WHERE m.eqA=a.idE 
                                           AND m.eqB=b.idE
                                           and m.idM=o.idM
                                           group by m.idM
                               ";
                               $result= mysqli_query($idConnexion,$req);
                               ?>
                <table border="1" width="80%" align="center" id="table">
                    <tbody>
                        <th>date du match</th>
                        <th>equipe a</th>
                        <th>equipe b</th>
                        <th>score</th>
                        <th>buvettes ouvertes</th>
                        <th>volontaires</th>
            
                               <?php
                               while($row=mysqli_fetch_array($result))
                               {
                                   $req="SELECT COUNT(*) as nbVolontaire from `match` m, `est_present` ep
                                   where m.idM=ep.idM
                                   AND m.idM=".$row['mid'];
                                   $res=mysqli_query($idConnexion,$req);
                                   $nbv=mysqli_fetch_array($result); 
                                   echo"
                                   <tr>
                                       <td>".
                                       $row['date'].
                                       "</td>
                                       <td><img src=\"".$row['drapeauA']."\" alt=\"".$row['paysA']."\" height=\"50px\"/></td>
                                       <td><img src=\"".$row['drapeauB']."\" alt=\"".$row['paysB']."\" height=\"50px\"/></td>
                                       <td>".$row['scoreA']." - " .$row['scoreB']."</td>
                                       <td>".$row['buvetteOuvrant']."</td>
                                       <td>".$nbv[0]."</td>
                                       </tr>
                                       ";
                               }
                               ?>
                    </tbody>
                    
                </table>
            </div>
            
            <div class="y"></div>
            <div class="pied"><br> pied de page</div>
            
        
        </div>
    </div>
  
    
 
     <script src="bootstrap.js"></script>
    <script src="jquery-3.5.1.min.js"></script>
</body>
</html>