<?php
    namespace Aula_Web\DAO;

    use Aula_Web\Model\Emprestimo;
    use Exception;

    final class Categoria extends Model
    {
        public ?int $Id = null;

        private ?string $descricao = null;
        public ?string $Descricao
        {
            set
            {
                if(strlen($value) < 3)
                    throw new Exception("Descrição da categoria deve ter no mínimo 3 caracteres.");

                $this->descricao = $value;
            }

            get => $this->descricao;
        }

        public function save() : Categoria
        {
            return (new CategoriaDAO())->save($this);
        }

        public function getById(int $id) : ?Categoria
        {
            return (new CategoriaDAO())->selectById($id);
        }

        public function getAllRows() : array
        {
            $this->rows = (new CategoriaDAO())->select();
            return $this->rows;
        }

        public function delete(int $id) : bool
        {
            return (new CategoriaDAO())->delete($id);
        }
    }
?>