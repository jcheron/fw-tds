<?php
namespace models;

use Ubiquity\attributes\items\Id;
use Ubiquity\attributes\items\Column;
use Ubiquity\attributes\items\Validator;
use Ubiquity\attributes\items\Transformer;
use Ubiquity\attributes\items\Table;
use Ubiquity\attributes\items\ManyToOne;
use Ubiquity\attributes\items\JoinColumn;
use Ubiquity\attributes\items\OneToMany;
use Ubiquity\attributes\items\ManyToMany;
use Ubiquity\attributes\items\JoinTable;

#[Table(name: "user")]
class User{
	
	#[Id()]
	#[Column(name: "id",dbType: "int(11)")]
	#[Validator(type: "id",constraints: ["autoinc"=>true])]
	private $id;

    private $login;
	
	#[Column(name: "firstname",dbType: "varchar(65)")]
	#[Validator(type: "length",constraints: ["max"=>65,"notNull"=>true])]
	private $firstname;

	
	#[Column(name: "lastname",dbType: "varchar(65)")]
	#[Validator(type: "length",constraints: ["max"=>65,"notNull"=>true])]
	private $lastname;

	
	#[Column(name: "email",dbType: "varchar(255)")]
	#[Validator(type: "email",constraints: ["notNull"=>true])]
	#[Validator(type: "length",constraints: ["max"=>255])]
	private $email;

	
	#[Column(name: "password",nullable: true,dbType: "varchar(255)")]
	#[Validator(type: "length",constraints: ["max"=>255])]
	#[Transformer(name: "password")]
	private $password;

	
	#[Column(name: "suspended",nullable: true,dbType: "tinyint(1)")]
	#[Validator(type: "isBool",constraints: [])]
	private $suspended;

	
	#[ManyToOne()]
	#[JoinColumn(className: "models\\Organization",name: "idOrganization")]
	private $organization;

	
	#[ManyToMany(targetEntity: "models\\Groupe",inversedBy: "users")]
	#[JoinTable(name: "groupeusers")]
	private $groupes;


	 public function __construct(){
		$this->groupes = [];
	}


	public function getId(){
		return $this->id;
	}


	public function setId($id){
		$this->id=$id;
	}


	public function getFirstname(){
		return $this->firstname;
	}


	public function setFirstname($firstname){
		$this->firstname=$firstname;
	}


	public function getLastname(){
		return $this->lastname;
	}


	public function setLastname($lastname){
		$this->lastname=$lastname;
	}


	public function getEmail(){
		return $this->email;
	}


	public function setEmail($email){
		$this->email=$email;
	}


	public function getPassword(){
		return $this->password;
	}


	public function setPassword($password){
		$this->password=$password;
	}


	public function getSuspended(){
		return $this->suspended;
	}


	public function setSuspended($suspended){
		$this->suspended=$suspended;
	}


	public function getOrganization(){
		return $this->organization;
	}


	public function setOrganization($organization){
		$this->organization=$organization;
	}


	public function getGroupes(){
		return $this->groupes;
	}


	public function setGroupes($groupes){
		$this->groupes=$groupes;
	}


	 public function addGroupe($groupe){
		$this->groupes[]=$groupe;
	}


	 public function __toString(){
		return ($this->email??'no value').'';
	}

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

}