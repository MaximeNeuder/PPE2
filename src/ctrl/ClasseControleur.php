<?php

namespace RallyeLecture\ctrl;

class ClasseControleur implements IControleur{
    
    private $classes;  // @var array Niveau
    private $daoClasse;
    private $daoEnseignant;
    private $daoNiveau;
    private $app;     // @var Application
    private $actions; // @var string[]
    private $name;    // @var string 
    private $enseignants;
    private $niveaux;

    // private $viewTwig
    // niveaux ModeleContainer             

    public function __construct($name, $selectClasse,$selectEnseignant,$selectNiveau, array $actions, \RallyeLecture\ctrl\Application $app) {
        $this->daoClasse = new \RallyeLecture\Dao\BaseDao($selectClasse);
         $this->daoEnseignant = new \RallyeLecture\dao\BaseDao($selectEnseignant);
         $this->daoNiveau = new \RallyeLecture\dao\BaseDao($selectNiveau);
        $this->name = $name;
        $this->app = $app;
        if ($actions[0] == 'all') {
            $actions = array('Index', 'Create', 'Store', 'Show', 'Edit', 'Update', 'Delete');
        }
        $this->actions = $actions;
        $this->classes = new \RallyeLecture\Model\Classes($this->daoClasse->GetAll());
        $this->enseignants = new \RallyeLecture\Model\Enseignants($this->daoEnseignant->GetAll());
        $this->niveaux = new \RallyeLecture\Model\Niveaux($this->daoNiveau->GetAll());
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
        $this->app->render('classes.twig', array('classes' => $this->classes, 'enseignants' => $this->enseignants, 'niveaux' => $this->niveaux));
    }
    
    public function Create() {
                $classe = new \RallyeLecture\Model\Classe(array('idEnseignant' => $_POST['idEnseignant'],
                    'anneeScolaire' => $_POST['anneeScolaire'], 'idNiveau' => $_POST['idNiveau']));
        // todo ajouter au modele
        $this->daoClasse->Insert($classe);
        $this->app->redirect('/classes/index');
    }

    public function Delete($id) {
                     $classe = $this->classes->GetClasse($id);
        $this->daoClasse->Delete($id);
        $this->app->redirect('/classes/index');
    }

    public function Edit($id) {
        $classe = $this->classes->GetClasse($id);
        $this->app->render('classes.Edit.twig', array('classe' => $classe, 'enseignants' => $this->enseignants, 'niveaux' => $this->niveaux));
    }

    public function Show($id) {
        
    }

    public function Store() {
        
    }

    public function Update() {
                $classe = new \RallyeLecture\Model\Classe(array('id' => $_POST['id'],
        'idEnseignant' => $_POST['idEnseignant'], 'anneeScolaire' => $_POST['anneeScolaire'],
        'idNiveau' => $_POST['idNiveau']));
        $this->daoClasse->update($classe);
        $this->app->redirect('/classes/index');
    }

//put your code here
}
