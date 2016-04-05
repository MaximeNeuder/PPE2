<?php

namespace RallyeLecture\ctrl;

class EnseignantsControleur implements IControleur{
    
        /** @var $niveaux  \RallyeLecture\Model\Niveaux */
    private $enseignants;  // @var array Niveau
    private $dao;
    private $app;     // @var Application
    private $actions; // @var string[]
    private $name;    // @var string 

    // private $viewTwig
    // niveaux ModeleContainer             

    public function __construct($name, $select, array $actions, \RallyeLecture\ctrl\Application $app) {
        $this->dao = new \RallyeLecture\Dao\BaseDao($select);
        $this->name = $name;
        $this->app = $app;
        if ($actions[0] == 'all') {
            $actions = array('Index', 'Create', 'Store', 'Show', 'Edit', 'Update', 'Delete');
        }
        $this->actions = $actions;
        $this->enseignants = new \RallyeLecture\Model\Enseignants($this->dao->GetAll());
        $this->MapCrudRoutes();
    }

    // routes :     
    public function MapCrudRoutes() {
        /* @var $value str */
        $uri = '/' . $this->name;
        foreach ($this->actions as $value) {
            switch ($value) {
                case 'Index':
                    $this->app->get($uri.'/index', array($this, $value));
                    break;
                case 'Create':
                    $this->app->post($uri . '/create', array($this, $value));
                    break;
                case 'Store':
                    $this->app->post($uri, array($this, $value));
                    break;
                case 'Show':
                    $this->app->get($uri . '/:id', array($this, $value));
                    break;
                case 'Edit':
                    $this->app->get($uri . '/edit/:id', array($this, $value));
                    break;
                case 'Update':
                    $this->app->post($uri . '/update', array($this, $value));
                    break;
                case 'Delete':
                    $this->app->get($uri . '/delete/:id', array($this, $value));
                    break;
                default: throw new \Exception("Action non prévue dans un controleur");
            }
        }
    }

    // get /niveaux
    public function Index() {
        $this->app->render('enseignants.twig', array('enseignants' => $this->enseignants));
    }
    public function Create() {
        $enseignant = new \RallyeLecture\Model\Enseignant(array('nom' => $_POST['nom'],'prenom' => $_POST['prenom'],
            'login' => $_POST['login'], 'password' => md5($_POST['password'])));
        // todo ajouter au modele
        $this->dao->Insert($enseignant);
        $this->app->redirect('/enseignants/index');
    }

    public function Delete($id) {
                $enseignant = $this->enseignants->GetEnseignant($id);
        $this->dao->Delete($id);
        $this->app->redirect('/enseignants/index');
        
    }

    public function Edit($id) {
                $enseignant = $this->enseignants->GetEnseignant($id);
        $this->app->render('enseignants.Edit.twig', array('enseignant' => $enseignant));
    }

    public function Show($id) {
        
    }

    public function Store() {
        
    }

    public function Update() {
        $enseignant = new \RallyeLecture\Model\Enseignant(array('id' => $_POST['id'], 
        'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'login' => $_POST['login'], 'password' => md5($_POST['password'])));
        $this->dao->update($enseignant);
        $this->app->redirect('/enseignants/index');
    }

//put your code here
}
