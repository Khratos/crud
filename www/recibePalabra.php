<!DOCTYPE html>
<html>
<body>

<?php

#se obtiene la palabra del formulario
#$w = "anita lava la tina";
$w = $_POST['word'];
echo "palabra: ".$w."</br>";

#se divide la palabra por espacios
$ss = explode(" ", $s);

#se concatena la palabra sin espacios
$cwe = '';
for($i=0; $i<count($ss);$i++){	
	$cwe .= $ss[$i];
}
echo "palabra sin espacios: ".$cwe."</br>";


#se invierte la palabra
$invertida = '';
for($i=strlen($cwe)-1; $i>=0; $i--){	
	$invertida .= $cwe[$i];    
}
echo "palabra invertida: ".$invertida."</br>";

# si son iguales, entonces es un palindromo
echo "</br>";
if($cwe == $invertida){
	echo "Es una palabra palindromo!"."</br>";
}
else{
	echo "NO es una palabra palindromo!"."</br>";
}


?>

</body>
</html>

