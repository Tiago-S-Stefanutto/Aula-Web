<?php
    namespace Aula_Web\Controller;

    use Aula_Web\Model\{ Emprestimo, Aluno, Livro };
    use Exception;

    final class EmprestimoConrtoller extends Controller
    {
        public static function index() : void
        {
            parent::isProtected();

            $model = new Emprestimo();

            try
            {
                $model->getAllRows();
            }
            catch(Exception $e)
            {
                $model->setError("Ocorreu um erro ao buscar os empréstimos:");
                $model->setError($e->getMessage());
            }

            parent::render('Emprestimo/lista_emprestimo.php', $model);
        }

        public static function cadasrto() : void
        {
            parent::isProtected();

            $model = new Emprestimo();

            try
            {
                if(parent::isPost())
                {
                    $model->Id = !empty($_POST['id']) ? $_POST['id'] : null;
                    $model->Id_Aluno = $_POST['id_aluno'];
                    $model->Id_Livro = $_POST['id_Livro'];
                    $model->Id_Usuario = LoginController::getUsuario()->Id;
                    $model->Emprestimo = $_POST['emprestimo'];
                    $model->Devolucao = $_POST['devolucao'];
                    $model->save();

                    parent::redirect("/emprestimo");
                }
                else
                {
                    if(isset($_GET['id']))
                    {
                        $model = $model->getById( (int) $_GET['id']);
                    }
                }
            }
            catch(Exception $e)
            {
                $model->setError($e->getMessage());
            }

            $model->rows_alunos = new Aluno()->getAllRows;
            $model->rows_livros = new Livro()->getAllRows;

            parent::render('Emprestimo/form_emprestimo.php', $model);   
        }

        public static function delete() : void
        {
            parent::isProtected();

            $model = new Emprestimo();

            try
            {
                $model->delete( (int) $_GET['id']);
                parent::redirect("/emprestimo");
            }
            catch (Exception $e)
            {
                $model->setError("Ocorreu um erro ao excluir o empréstimo:");
                $model->setError($e->getMessage());
            }

            parent::render('Emprestimo/form_emprestimo.php', $model);   
        }
    }
?>S