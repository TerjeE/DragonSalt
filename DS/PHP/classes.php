<?php

class produkt
{
    public $navn;
    public $pid;
    public $tilbehor;
    public $pris;

    function produkt($navn, $pid, $tilbehor, $pris)
    {
        $this->navn = $navn;
        $this->pid = $pid;
        $this->tilbehor = $tilbehor;
        $this->pris = $pris;
    }
}
?>