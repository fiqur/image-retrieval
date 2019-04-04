<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Main Bola</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
     /* $("form").submit(function(){
          alert("Submitted");
      });*/
      $('input[type=file]').change(function() { 
      // select the form and submit
      $('form').submit(); 
  });
  });
  </script>
  <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">
  <style>
 

  /*#a2a2a2*/
  .fileContainer {
      overflow: hidden;
      position: relative;
      background: #a2a2a2;
      font-family: sans-serif;
      padding: 5px;
      color: white;
      font-size: 15px;
  }

  .fileContainer [type=file] {
      cursor: inherit;
      display: block;
      font-size: 10px;
      filter: alpha(opacity=0);
      min-height: 100%;
      min-width: 100%;
      opacity: 0;
      position: absolute;
      right: 0;
      text-align: right;
      top: 0;
      
  }

  #hasil{
    float: left;
    margin-right: 10px;
    margin-bottom: 10px;
    width: 285px;
    height: 200px;
  }

  </style>
</head>
<body>
  <header>
    <img class="blogtitle" src="icon.png"><br><br>
    <h5 class="subtitle">Web Pencarian Gambar Tentang Sepak Bola</h5>

    <form  method="post" action="" enctype="multipart/form-data">
        
            <label class="fileContainer">
               Pilih Gambar
               
                <input type="file" id="gambar" name="gambar"/>
               
            </label>
           <br>
           <br>

          
         
    </form>
  
  </header>
  <nav>
  </nav>
  <section class="mainpart">
    <main>
          <?php

            if($_FILES!=null){

            
              $nilair=array();
              $nilaig=array();
              $nilaib=array();
              $index=0;
              $im = imagecreatefromjpeg("hasilresize/".$_FILES['gambar']['name']);
              $w = imagesx($im);
              $h = imagesy($im);

              for($y = 0; $y < $h; $y++) {
                      for($x = 0; $x < $w; $x++) {
                          $rgb = imagecolorat($im, $x, $y);
                          $r = ($rgb >> 16) & 0xFF;
                          $g = ($rgb >> 8) & 0xFF;
                          $b = $rgb & 0xFF;
                          $nilair[$index]=$r;
                          $nilaig[$index]=$g;
                          $nilaib[$index]=$b;
                          $index++;
                      }

               }  

               $k=32;
               $warna=256/$k;
               //echo $warna;

               $nilaiakhir=array();
               

              // $jumlahtotal=($k*3);
              // echo "<br>jumlah total:".$jumlahtotal;

               for($y = 0; $y <= ($k*3)-1; $y++) {
                
                $nilaiakhir[$y]=0;
                

               }



               for($y = 0; $y < count($nilair); $y++) {

                $nilair[$y]=(int)($nilair[$y]/$warna);
                $nilaig[$y]=(int)($nilair[$y]/$warna);
                $nilaib[$y]=(int)($nilair[$y]/$warna);

               }

              // echo "<br>nilai pertama R:".$nilair[0];
               for($y = 0; $y < count($nilair); $y++) {

                  $nilaiakhir[$nilair[$y]]++;

               }
              // echo "<br><br>Nilai R:<br>";
              // print_r($nilaiakhir);

              for($y = 0; $y < count($nilaig); $y++) {

                  $nilaiakhir[$nilaig[$y]+$k]++;

               }

              // echo "<br><br>Nilai G:<br>";
              // print_r($nilaiakhir);



               for($y = 0; $y < count($nilaib); $y++) {

                  $nilaiakhir[$nilaib[$y]+2*$k]++;

               }

              // echo "<br><br>Nilai B:<br>";
              // print_r($nilaiakhir);

              $temp=array();
              for($i=0;$i<100;$i++){
                  $temp[$i][0]=0;
                  $temp[$i][1]=($i+1);
               }

             

              for($filetxtyangdiload=0;$filetxtyangdiload<100;$filetxtyangdiload++){
                 $datatxt=array();
                 $f = fopen("data/".($filetxtyangdiload+1).".txt", "r");
                 $indexdata=0; 
                 while(!feof($f)) { 
                  
                  $datatxt[$indexdata]=fgets($f);
                  $indexdata++;
                  
                 }
                 fclose($f);
                // print_r($datatxt);

                  /*$tempx=0;
                  $tempy=0;
                  for($hehe=0;$hehe<count($datatxt);$hehe++){

                    $tempx=$tempx+pow($datatxt[$hehe],2);
                    $tempy=$tempy+pow($nilaiakhir[$hehe],2);
                  }

                  $pembagicosine=sqrt($tempx)*sqrt($tempy);



                   for($hehe=0;$hehe<count($datatxt);$hehe++){

                    $temp[$filetxtyangdiload][0]=$temp[$filetxtyangdiload][0]+($datatxt[$hehe]*$nilaiakhir[$hehe]) ;
                   }
                    $temp[$filetxtyangdiload][0]=$temp[$filetxtyangdiload][0]/$pembagicosine;
               */
                 for($hehe=0;$hehe<count($datatxt);$hehe++){
                  $temp[$filetxtyangdiload][0]=$temp[$filetxtyangdiload][0]+pow(($datatxt[$hehe]-$nilaiakhir[$hehe]) , 2);
                 }
                 $temp[$filetxtyangdiload][0]=sqrt($temp[$filetxtyangdiload][0]);

                 //echo "HASIL AKHIR:".$temp[0];
              }

              foreach ($temp as $key => $row) {
                    $jumlah[]=$row[0];
              }
              array_multisort($jumlah, SORT_ASC, $temp);

              //print_r($temp);
               for($i=0;$i<12;$i++){
                echo "<img id='hasil' src='hasilresize/".$temp[$i][1].".jpg'>";
               }
            
              
            }


                
                
                
              
          ?>
   </main>
</section>
<div class="cls"></div>
<footer>
  <div class="mainpart">
    <p>
      &copy; 2016 Main Bola
    </p>
  </div>
</footer>
</body>
</html>