<?php
    namespace App\DAO;

    use App\Model\Aluno;

    final class AlunoDAO extends DAO
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function save (Aluno $model): Aluno
        {
            return ($model->Id == null) ? $this->insert($model) :
            $this->update($model);
        }

        public function insert (Aluno $model): Aluno
        {
            $sql = "INSERT INTO aluno (nome, ra, curso) VALUES (?, ?, ?)";

            $stmt = parent::$conexao->prepare($sql);

            $stmt->bindValue(1, $model->Nome);
            $stmt->bindValue(2, $model->RA);
            $stmt->bindValue(3, $model->Curso);
            $stmt->Execute();
            $model->Id = parent::$conexao->lastInsertId();

            return $model;
        }

        public function update(Aluno $model): Aluno
        {
             $sql = "UPDATE aluno SET nome=?, ra=?, curso=? WHERE id=?";

             $stmt = parent::$conexao->prepare($sql);
             $stmt->bindValue(1, $model->Nome);
             $stmt->bindValue(2, $model->RA);
             $stmt->bindValue(3, $model->Curso);
             $stmt->bindValue(4, $model->Id);
             $stmt->Execute();

             return $model;
        }

        public function selectById(int $id) : ?Aluno
        {
            $sql="SELECT * FROM alunos WHERE id=?";
            $stmt = parent::$conexao->prepare($sql);
            $stmt->bindValue(1, $id);

        }
    }
    //quem nasceu pra ser patrao
?>