<?php



namespace RallyeLecture\ctrl;

class loginControleur implements IControleur{

    private $login;
    private $password;
    private $daoEnseignant;
    private $enseignants;
    

    public function __construct($name, $selectEnseignant, array $actions, \RallyeLecture\ctrl\Application $app) {
        $this->daoEnseignant = new \RallyeLecture\Dao\BaseDao($selectEnseignant);
      //   $this->daoEleve = new \RallyeLecture\dao\BaseDao($selectEleve);

        $this->name = $name;
        $this->app = $app;
        if ($actions[0] == 'all') {
            $actions = array('Index', 'Verify');
        }
        $this->actions = $actions;
        $this->enseignants = new \RallyeLecture\Model\Enseignants($this->daoEnseignant->GetAll());
       // $this->eleves = new \RallyeLecture\Model\Eleve($this->daoNiveau->GetAll());
        $this->MapCrudRoutes();
    }
    
     public function MapCrudRoutes() {
        /* @var $value str */
        $uri = '/' . $this->name;
        foreach ($this->actions as $value) {
            switch ($value) {
                case 'Index':
                    $this->app->get($uri.'/index', array($this, $value));
                    break;
                case 'Verify':
                    $this->app->post($uri . '/verify', array($this, $value));
                    break;            
                default: throw new \Exception("Action non prévue dans un controleur");
            }
        }
    }
    
    public function Verify()
    {   
            $_SESSION['login'] = "";
            $_SESSION['password'] = "";
            $teach = "";
            $login = $_POST['login'] ;
            $password = $_POST['password'];
            foreach ($this->enseignants as $value) {
                if($value->GetLogin() == $login && $value->GetPassword() == md5($password))
                {
                    $teach = $value->GetId();
                    $_SESSION['login'] = $login;
                    $_SESSION['password'] = $password;
                    $_SESSION['idEns'] = $teach;
                    echo $_POST['login'];
                    echo $_POST['password'];
                    
                    echo $teach;
                    $this->app->redirect('/accueil');
                  //  $this->app->redirect('classes.twig',
                  //          array('id' => $teach));
                   
                }
                
               
                    
            }                     
                
}
                

            
            
           
    

    public function Create() {
        
    }

    public function Delete($id) {
        
    }

    public function Edit($id) {
        
    }

    public function Index() {
        $this->app->render('login.twig', array('enseignants' => $this->enseignants));
    }

    public function Show($id) {
        
    }

    public function Store() {
        
    }

    public function Update() {
        
    }

}

