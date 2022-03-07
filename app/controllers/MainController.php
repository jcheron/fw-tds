<?php
namespace controllers;
 use services\dao\OrgaRepository;
 use Ubiquity\attributes\items\di\Autowired;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\controllers\auth\AuthController;
 use Ubiquity\controllers\auth\WithAuthTrait;
 use Ubiquity\utils\http\USession;

 /**
  * Controller MainController
  */
class MainController extends \controllers\ControllerBase{
    use WithAuthTrait;
    #[Autowired]
    private OrgaRepository $repo;


    #[Route('_default',name: 'home')]
	public function index(){
        $user=$this->getAuthController()->_getActiveUser();
        $this->repo->byId(USession::get('idOrga'));
		$this->loadView("MainController/index.html",['user'=>$user]);
	}

    protected function getAuthController(): AuthController {
        return new MyAuth($this);
    }

    /**
     * @param OrgaRepository $repo
     */
    public function setRepo(OrgaRepository $repo): void{
        $this->repo = $repo;
    }
}
