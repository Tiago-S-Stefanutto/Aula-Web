<?php
    namespace PHPappMVCi\DAO;

    use PHPappMVCi\Model\Emprestimo;

    final class EmprestimoDAO extends DAO
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function save(Emprestimo $model) : Emprestimo
        {
            return ($model->Id == null) ? $this->insert($model) :
                $this->update($model);
        }

        public function insert(Emprestimo $model) : Emprestimo
        {
            $sql = "INSERT INTO emprestimo (id_usuario, id_aluno, emprestimo, devolucao) VALUES (?, ?, ?, ?) ";

            $stmt = parent::$conexao->prepare($sql);

            $stmt->bindValue(1, $model->Id_Usuario);
            $stmt->bindValue(2, $model->Id_Aluno);
            $stmt->bindValue(3, $model->Emprestimo);
            $stmt->bindValue(4, $model->Devolucao);
            $stmt->execute();

            $model->Id = parent::$conexao->lastInsertId();

            return $model;
        }

        public function update(Emprestimo $model) : Emprestimo
        {
            $sql = "UPDATE emprestimo SET id_usuario=?, id_aluno=?, emprestimo=?, devolucao=? WHERE id=? ";

            $stmt = parent::$conexao->prepare($sql);
            $stmt->bindValue(1, $model->Id_Usuario);
            $stmt->bindValue(2, $model->Id_Aluno);
            $stmt->bindValue(3, $model->Emprestimo);
            $stmt->bindValue(4, $model->Devolucao);
            $stmt->bindValue(5, $model->Id);
            $stmt->execute();

            return $model;
        }

        public function selectById(int $id) : ?Emprestimo
        {
            $sql = "SELECT * FROM emprestimo WHERE id=? ";

            $stmt = parent::$conexao->prepare($sql);
            $stmt->bindValue(1, $model->Id);
            $stmt->execute();

            return $stmt->fetchObject("PHPappMVCi\Model\Emprestimo");
        }

        public function select() : arid_alunoy
        {
            $sql = "SELECT * FROM emprestimo ";

            $stmt = parent::$conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(DAO::FETCH_CLASS, "PHPappMVCi\Model\Emprestimo");
        }

        public function delete(int $id) : bool
        {
            $sql = "DELETE FROM emprestimos WHERE id=? ";

            $stmt = parent::$conexao->prepare($sql);
            $stmt->bindValue(1, $model->Id);
            return $stmt->execute();
        }
    }
?>