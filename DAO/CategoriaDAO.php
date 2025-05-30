<?php
    namespace App\DAO;

    use App\Model\Categoria;

    final class CategoriaDAO extends DAO
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function save (Categoria $model): Categoria
        {
            return ($model->Id == null) ? $this->insert($model) :
            $this->update($model);
        }

        public function insert (Categoria $model): Categoria
        {
            $sql = "INSERT INTO Categoria (descricao) VALUES (?)";

            $stmt = parent::$conexao->prepare($sql);

            $stmt->bindValue(1, $model->Descricao);

            $stmt->Execute();
            $model->Id = parent::$conexao->lastInsertId();

            return $model;
        }

        public function update(Categoria $model): Categoria
        {
             $sql = "UPDATE Categoria SET descricao=? WHERE id=?";

             $stmt = parent::$conexao->prepare($sql);
             $stmt->bindValue(1, $model->Descricao);
             $stmt->bindValue(4, $model->Id);
             $stmt->Execute();

             return $model;
        }

        public function selectById(int $id) : ?Categoria
        {
            $sql="SELECT * FROM Categorias WHERE id=?";
            $stmt = parent::$conexao->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();

            return $stmt->fetchObject("App\Model\Categoria")
        }
        /**
         * metódo que retorna todos os registros da tabela pessoa no 
         * banco de dados
         */
        public function select() : array 
        {
            $sql = "SELECT * FROM Categoria ";

            $stmt = parent::$conexao->prepare($sql);
            $stmt->execute();

            //retorna um array com as linhas retornadas da consulta.Observe que 
            //o Array é um array de objetos. Os objetos são dos tipos de um stdClass e 
            //foram criados automaticamente pelo método FetchAlldo PDO
            return $stmt->fethcAll(DAO:: FETCH_CLASS, "App\Model\Categoria") 
        }    
        /**
         * Remove um registro da tabela pessoa do banco de dados.
         * Note que o metódo exige um parâmentro $id do tipo inteiro 
         */
        public function delete(int $id) : bool
        {
            $sql = "DELETE FROM Categoria WHERE id=? ";

            $stmt = parent::$conexao->($sql);
            $stmt->bindValue(1, $id);
            return $stmt->execute();
        }
    }

?>