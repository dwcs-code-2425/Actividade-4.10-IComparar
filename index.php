<?php
use \clases\items\{Academia, Baile};
use \clases\people\{Profesor, Alumno};
use \exceptions\NotProfesorException;

// require_once "Persoa.php";
// require_once 'Profesor.php';
// require_once 'Alumno.php';
// require_once 'Academia.php';
// require_once 'Baile.php';
require_once 'autoload.php';
require_once "util.php";



$academia = new Academia();
echo "<h1>Academia de baile: ". $academia::ACADEMIA_NOME ."</h1>";
$profe1 = new Profesor("Profe1", "López López", "666777888", "12345678D");

$salsa = new Baile("Salsa");
$bachata = new Baile("Bachata", 12);
$tango = new Baile("Tango", 16);
//Mesmo nome, diferente idade
$afro = new Baile("AFRO", 18);
$afro2 = new Baile("AFRO", 8);

$profe1->engadir($salsa);
$profe1->engadir($bachata);
$profe1->engadir($tango);
$profe1->engadir($afro);
$profe1->engadir($afro2);

//Para probar o segundo método: 
// $profe1->engadirSoDiferenteNome($salsa);
// $profe1->engadirSoDiferenteNome($bachata);
// $profe1->engadirSoDiferenteNome($tango);
// $profe1->engadirSoDiferenteNome($afro);
// $profe1->engadirSoDiferenteNome($afro2);

$alumno1 = new Alumno("Juan", "Antas Ulla", "650650650");
$alumno1->setDataNacemento(\DateTimeImmutable::createFromFormat("Y-m-d", "2000-01-01"));
echo "<h2>\$alumno1->verInformacion()</h2>";
$alumno1->verInformacion();

$alumno2 = new Alumno("Rita", "Román Rueda", "652652652");
$alumno2->setDataNacemento(\DateTimeImmutable::createFromFormat("Y-m-d", "2015-01-01"));
echo "<h2>\$alumno2->verInformacion()</h2>";
$alumno2->verInformacion();

$alumno1->setNumClases(0);
$alumno2->setNumClases(4);

$academia->engadirAlumno($alumno1);
$academia->engadirAlumno($alumno2);

$academia->engadirProfe($profe1);

echo "<h2>{$profe1->getNome()}->verInformacion()</h2>";
$profe1->verInformacion();

echo "<h2>{$profe1->getNome()}->calcularSoldo(2)</h2>";
$soldo = $profe1->calcularSoldo(2);
echo "O soldo do profe é: " . $soldo . "<br/>";

echo $profe1->getNome() . " imparte os seguintes bailes: <br/>";
$profe1->mostrarBailes();

echo "<h2>{$alumno1->getNome()} aPagar</h2>";
mostrarImporte($alumno1);
echo "<h2>{$alumno2->getNome()} aPagar</h2>";
mostrarImporte($alumno2);


echo "<h2>{$profe1->getNome()}->eliminar baile...</h2>";
$profe1->eliminar(new Baile("AFRO"));
$profe1->mostrarBailes();

echo "<p>Probando serialización...</p>";

$persoa_json = json_encode($profe1, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

echo "<pre>";
echo $persoa_json;
echo "</pre>";

$alumno_json = json_encode($alumno1, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

echo "<pre>";
echo $alumno_json;
echo "</pre>";



$profe1->setDataNacemento(\DateTimeImmutable::createFromFormat("Y-m-d", "2000-01-02"));
$profe1->verInformacion();

$profe2 = new Profesor("Profe2", "ABC DEF", "600123123", "99999999F");
$profe2->setDataNacemento(\DateTimeImmutable::createFromFormat("Y-m-d", "2000-01-01"));
$profe2->verInformacion();

try {
   
   $resultado = $profe2->comparar($profe1);
   echo "<p>El resultado de comparar profe2 y profe1 es $resultado: </p>";

   $resultado = $profe2->comparar($alumno1);
   echo "<p>El resultado de comparar profe2 y alumno1 es $resultado: </p>";

}
catch(NotProfesorException $e){
    error_log("Ha ocurrido una exception: " . $e->getMessage());
    echo ("No se ha podido comparar los profes. " 
 .$e->getMessage());
}


