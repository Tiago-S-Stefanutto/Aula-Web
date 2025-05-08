<?php
    namespace  Aula_Web\Model;

    use Aula_Web\DAO\AlunoDAO;
    use Exception;

    final class Aluno extends Model
    {
        public ?int $Id = null;

        public ?string $Nome
        {
            set
            {
                if(strlen($value) < 4)
                    throw new Exception("Nome deve ter no mínimo 4 caracteres.");

                    $this->Nome = $value;
            }

            get => $this->Nome ?? null;
        }

        public ?string $RA
        {
            set
            {
                if(empty($value))
                    throw new Exception("Preencha o RA.");

                    $this->RA ?? null;
            }

            get => $this->RA ?? null;
        }

        public ?string $Curso
        {
            set
            {
                if(strlen($value) < 4)
                    throw new Exception("Curso deve ter no mínimo 4 caracteres.");

                    $this->Curso = $value;
            }

            get => $this->Curso ?? null;
        }

        function save() : Aluno
        {
            return new AlunoDAO()->save($this);
        }

        function getById(int $id) : ?Aluno
        {
            return new AlunoDAO()->selectById($this);
        }

        function getAllRows() : array
        {
            $this->rows = new AlunoDAO()->select();
        }

        function delete(int $id) : bool
        {
            return new AlunoDAO()->delete($id);
        }
    }
?>