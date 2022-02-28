<?php
namespace controllers;
use Ubiquity\attributes\items\router\Post;
 use models\Organization;
 use Ubiquity\attributes\items\router\Get;
 use Ubiquity\attributes\items\router\Route;
use Ubiquity\controllers\Router;
use Ubiquity\orm\DAO;
 use Ubiquity\orm\repositories\ViewRepository;
use Ubiquity\utils\http\URequest;

/**
  * Controller OrgaController
  */
 #[Route('orga')]
class OrgaController extends \controllers\ControllerBase{
     private ViewRepository $repo;

     public function initialize() {
         parent::initialize();
         $this->repo??=new ViewRepository($this,Organization::class);
     }

     private function frmOrga(Organization $orga,bool $toAdd=true){
         $routeName=$toAdd?Router::path('orga.add'):Router::path('orga.update',[$orga->getId()]);
         $this->loadView('OrgaController/frmAdd.html',compact('orga','routeName'));
     }

    #[Get(name: 'orga.index')]
	public function index(){
        $this->repo->all();
		$this->loadView("OrgaController/index.html");
	}

	#[Route(path: "getOne/{idOrga}",name: "orga.getOne")]
	public function getOne($idOrga){
        $this->repo->byId($idOrga,['users','groupes']);
		$this->loadView('OrgaController/getOne.html');
	}


	#[Get(path: "add",name: "orga.frmAdd")]
	public function frmAdd(){
		$this->frmOrga(new Organization());
	}

     #[Get(path: "update/{idOrga}",name: "orga.frmUpdate")]
     public function frmUpdate(int $idOrga){
         $orga=DAO::getById(Organization::class,$idOrga);
         $this->frmOrga($orga,false);
     }


	#[Post(path: "add",name: "orga.add")]
	public function add(){
        $orga=new Organization();
        URequest::setValuesToObject($orga);
        if(DAO::insert($orga)){
            $this->loadView('main/message.html',['msg'=>"$orga ajoutée"]);
            $this->index();//Redirection vers l'action index
        }
	}

}
