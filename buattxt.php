<?php



	for($indextxt = 1; $indextxt <= 100; $indextxt++) {
		$nilair=array();
		$nilaig=array();
		$nilaib=array();
		$index=0;
		$im = imagecreatefromjpeg("hasilresize/".$indextxt.".jpg");
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

		 $myfile = fopen("data/".$indextxt.".txt", "w") or die("Unable to open file!");
		 
		 for($y = 0; $y < count($nilaiakhir); $y++) {
		 	
		 	if($y!=count($nilaiakhir)-1)
		 	{
		 		$txt=$nilaiakhir[$y]."\r\n";
		 	}
		 	else
		 	{
		 		$txt=$nilaiakhir[$y];
		 	}
		 	fwrite($myfile, $txt);
		 }
		 
		 fclose($myfile);
	}
		

?>