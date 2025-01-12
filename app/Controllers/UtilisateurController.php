<?php

namespace App\Controllers;
use App\models\Utilisateur;
use App\Validation\Validator;

class UtilisateurController extends Controller {
    public function login(){
        return $this->view('auth.login');
    }

    public function loginPost(){
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'nom' => ['required', 'notTwoDots', 'min:3'],
            'mdp' => ['required', 'notTwoDots', 'min:3']
        ]);

        if($errors){
            $_SESSION['errors'][] = $errors;
            return header("Location: ./login");
        }

        $utilisateur = (new Utilisateur($this->getDB()))->getByUsername($_POST['nom']);

        if(password_verify($_POST['mdp'], $utilisateur->mdp)){
            $_SESSION['auth'] = (int)$utilisateur->admin;
            $_SESSION['nom_user'] = (string)$utilisateur->nom;
            return header("Location: ./admin/ouvrages?success=true");
        } else {
            return header("Location: ./login?success=false");
        }
    }

    public function updateMdp(){
        $this->isAdmin();

        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'mdp' => ['required', 'notTwoDots', 'min:3', ('equals:'.$_POST['mdp-confirm'])]
        ]);

        if($errors){
            $_SESSION['errors'][] = $errors;
            return header("Location: ./change-mdp");
        }

        $utilisateur = (new Utilisateur($this->getDB()))->getByUsername($_SESSION['nom_user']);

        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

        $result = $utilisateur->updateMdp($utilisateur->id, $mdp);
        
        if($result){
            return header("Location: ./change-mdp?success=true");
        } else {
            return header("Location: ./change-mdp");
        }
    }

    public function logout(){
        session_destroy();
        return header("Location: ./");
    }

    public function changeMdp(){
        $this->isAdmin();
        return $this->view('auth.changeMdp');
    }
}