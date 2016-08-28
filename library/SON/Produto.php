<?php
namespace SON;


class Produto
{
    private $categoria;

    public function addCategoria(Categoria $categoria)
    {
        $this->categoria[] = $categoria;
        print_r($this->categoria);
    }


}