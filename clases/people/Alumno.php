<?php

namespace clases\people;

/**
 * Description of Alumno
 *
 * @author maria
 */


final class Alumno extends Persoa
{

    const CUOTA_UNA_CLASE = 20;
    const CUOTA_DOS_CLASES = 32;
    const CUOTA_TRES_O_MAS_CLASES = 40;

    private $numClases;

    public function __construct(
        string $nome,
        string $apelidos,
        string $mobil,
        $numClases = 0
    ) {
        parent::__construct($nome, $apelidos, $mobil);
        $this->numClases = $numClases;
    }

    //Otra opción sería no añadir un constructor en esta clase
    //y cuando se llame a new Alumno($nome, $apelidos, $mobil) se llamaría
    //implícitamente al constructor de Persona

    public function setNumClases($numClases): void
    {
        $this->numClases = $numClases;
    }

    public function aPagar(): string
    {
        $importe = 0;

        if (($this->numClases != null) && ($this->numClases > 0)) {

            switch ($this->numClases) {
                case 1:
                    $importe = self::CUOTA_UNA_CLASE;
                    break;
                case 2:
                    $importe = self::CUOTA_DOS_CLASES;
                    break;
                default:
                    //asumimos números positivos
                    $importe = self::CUOTA_TRES_O_MAS_CLASES;
                    break;
            }
        } else {
            $importe = "Debe indicar previamente o número de clases";
        }
        return $importe;
    }


    public function jsonSerialize(): mixed
    {

        $array = parent::jsonSerialize();

        $array["num_clases"] = $this->numClases;

        return $array;
    }

    public function verInformacion()
    {
        $now = new \DateTimeImmutable();
        $intervalo = $now->diff($this->dataNacemento);

        $array_mostrar = [
            $this->nome,
            $this->apelidos,
        ];

        //echo "Idade: $intervalo->y";

        if ($intervalo->y >= self::MAIORIA_IDADE) {
            array_push($array_mostrar,  "(" . $this->mobil . ")<br/>");
        }

        $cadea = implode(" ", $array_mostrar);


        echo $cadea;
    }
}
