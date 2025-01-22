<?php

namespace clases\people;

use DateTimeImmutable;
use traits\Logger;

/**
 * Description of Persoa
 *
 * @author maria
 */
abstract class Persoa implements \JsonSerializable
{
    use Logger;
    protected const MAIORIA_IDADE = 18;
    protected $nome;
    protected $apelidos;
    protected $mobil;

    protected ?DateTimeImmutable $dataNacemento = null;


    public function __construct(string $nome, string $apelidos, string $mobil)
    {
        $this->nome = $nome;
        $this->apelidos = $apelidos;
        $this->mobil = $mobil;
    }


    public function getNome(): string
    {
        return $this->nome;
    }

    public function getApelidos(): string
    {
        return $this->apelidos;
    }

    public function getMobil(): string
    {
        return $this->mobil;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setApelidos(string $apelidos): void
    {
        $this->apelidos = $apelidos;
    }

    public function setMobil(string $mobil): void
    {
        $this->mobil = $mobil;
    }

    public abstract function verInformacion();

    public function jsonSerialize(): mixed
    {
        $this->log("Serializando...");

        $info = [
            "__CLASS__" => __CLASS__,
            " get_class()" => get_class(),
            "get_called_class()" => get_called_class(),
            "get_class_methods()" => get_class_methods($this),
"get_class_vars()"=> get_class_vars(get_called_class()),
"get_declared_traits()" => get_declared_traits()

        ];

        echo "<pre>";
        print_r($info);
        echo "</pre>";

        $nome_apelidos = join(" ", [$this->nome, $this->apelidos]);
        return [
            "nome_apelidos" => $nome_apelidos,
            "mobil" => $this->mobil
        ];
    }

    /**
     * Get the value of dataNacemento
     *
     * @return DateTimeImmutable
     */
    public function getDataNacemento(): DateTimeImmutable {
        return $this->dataNacemento;
    }

    /**
     * Set the value of dataNacemento
     *
     * @param DateTimeImmutable $dataNacemento
     *
     * @return self
     */
    public function setDataNacemento(DateTimeImmutable $dataNacemento): self {
        $this->dataNacemento = $dataNacemento;
        return $this;
    }


    public function getIdade(){
        
        if (isset($this->dataNacemento)) {
            $now = new DateTimeImmutable();
            $intervalo = $now->diff($this->dataNacemento);
            return $intervalo->y;
        }
        else{
            return NAN;
        }

    }
}
