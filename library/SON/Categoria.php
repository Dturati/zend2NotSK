<?php
namespace SON;

class Categoria implements CategoriaInterface
{
    private $id;
    private $nome;
    private $db;


    public function __construct(Db\Connection $db)
    {
        $this->db = $db;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $categoria
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function listar()
    {
        $query  = 'select * from categorias';
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $this->fetchAll(\PDO::FETCH_ASSOC);
    }

}