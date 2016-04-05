<?php

namespace RallyeLecture\ctrl;

class NiveauxControleur implements IControleur {
    /** @var $dao  \RallyeLecture\dao\BaseDao */

    /** @var $niveaux  \RallyeLecture\Model\Niveaux */
    private $niveaux;  // @var array Niveau
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
        $this->niveaux = new \RallyeLecture\Model\Niveaux($this->dao->GetAll());
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
        $this->app->render('niveaux.twig', array('niveaux' => $this->niveaux));
    }

    // post /niveaux/create
    public function Create() {
        /* @var $dao \RallyeLecture\dao\BaseDao */
        $niveau = new \RallyeLecture\Model\Niveau(array('niveauScolaire' => $_POST['niveauScolaire']));
        // todo ajouter au modele
        $this->dao->Insert($niveau);
        $this->app->redirect('/niveaux/index');
    }

    // get niveaux/delete/:id
    public function Delete($id) {
        $niveau = $this->niveaux->GetNiveau($id);
        $this->dao->Delete($id);
        $this->app->redirect('/niveaux/index');
    }

    // get /niveaux/edit/:id
    public function Edit($id) {
        /* @var $niveaux \RallyeLecture\Model\Niveaux */
        /* @var $niveau \RallyeLecture\Model\Model */
        $niveau = $this->niveaux->GetNiveau($id);
        $this->app->render('niveaux.Edit.twig', array('niveau' => $niveau));
    }

    public function Show($id) {
        // pas mis en oeuvre
    }

    public function Store() {
        // pas mis en oeuvre
    }

    // post niveaux/update
    public function Update() {
        /* @var $dao \RallyeLecture\dao\BaseDao */
        $niveau = new \RallyeLecture\Model\Niveau(array('id' => $_POST['id'], 
            'niveauScolaire' => $_POST['niveauScolaire']));
        $this->dao->update($niveau);
        $this->app->redirect('/niveaux/index');
    }

}
