<?php

class produkt
{
    public $navn;
    public $pid;
    public $tilbehor;

    function produkt($navn, $pid, $tilbehor)
    {
        $this->navn = $navn;
        $this->pid = $pid;
        $this->tilbehor = $tilbehor;
    }
}
?>