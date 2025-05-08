<?php
    namespace Aula_Web\DAO;

    use Aula_Web\Model\Emprestimo;
    use Exception;

    final class Autor extends Model
    {
        public ?int $Id = null;

        private ?string $nome = null;
        public ?string $Nome
        {
            set
            {
                if(strlen($value) < 3)
                    throw new Exception("Nome do autor deve ter no mínimo 3 caracteres.");

                $this->nome = $value;
            }

            get => $this->nome;
        }

        private ?string $nascimento = null;
        public ?string $Nascimento
        {
            set
            {
                if(empty($value))
                    throw new Exception("Data de nascimento deve ser preenchida.");

                $this->nascimento = $value;
            }

            get => $this->nascimento;
        }

        private ?string $cpf = null;
        public ?string $CPF
        {
            set
            {
                // Validação básica de CPF (apenas verifica se tem 11 dígitos)
                if(!empty($value) && strlen(preg_replace("/[^0-9]/", "", $value)) != 11)
                    throw new Exception("CPF inválido.");

                $this->cpf = $value;
            }

            get => $this->cpf;
        }

        public function save() : Autor
        {
            return (new AutorDAO())->save($this);
        }

        public function getById(int $id) : ?Autor
        {
            return (new AutorDAO())->selectById($id);
        }

        public function getAllRows() : array
        {
            $this->rows = (new AutorDAO())->select();
            return $this->rows;
        }

        public function delete(int $id) : bool
        {
            return (new AutorDAO())->delete($id);
        }
    }
?>