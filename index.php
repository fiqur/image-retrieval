<style type="text/css">
	#hasil{
		float: left;
		margin-right: 20px;
		width: 300px;
		height: 200px;
	}

</style>

<form enctype="multipart/form-data" action="" method="post">
	
	<label>Pilih Gambar:</label>
	<input name="gambar" id="gambar" type="file"  /> 
	<input type="submit" id="btnSubmit" value="Cari"/>
	
</form>

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

		 $k=128;
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
		for($i=0;$i<31;$i++){
		 		$temp[$i][0]=0;
		 		$temp[$i][1]=($i+1);
		 }

		for($filetxtyangdiload=0;$filetxtyangdiload<31;$filetxtyangdiload++){
			 $datatxt=array();
			 $f = fopen("data/".($filetxtyangdiload+1).".txt", "r");
			 $indexdata=0; 
			 while(!feof($f)) { 
			 	
			 	$datatxt[$indexdata]=fgets($f);
			 	$indexdata++;
			 	
			 }
			 fclose($f);
			// print_r($datatxt);


			
			 
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
		 for($i=0;$i<10;$i++){
		 	echo "<img id='hasil' src='hasilresize/".$temp[$i][1].".jpg'>";
		 }
	
		
	}


			
			
			
		
?>