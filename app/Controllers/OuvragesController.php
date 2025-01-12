<?php

namespace App\Controllers;
use App\Models\Ouvrage;
use App\Models\Categorie;
use App\Models\ItemOuvrage;
use App\Models\Theme;

class OuvragesController extends Controller {

    public function welcome(){
        return $this->view('ouvrage.welcome');
    }

    public function tradition(){
        return $this->view('ouvrage.tradition');
    }

    public function tarifs(){
        return $this->view('ouvrage.tarifs');
    }
    public function contact(){
        return $this->view('ouvrage.contact');
    }

    public function mentionsLegales(){
        return $this->view('ouvrage.mentionsLegales');
    }

    public function planDuSite(){
        return $this->view('ouvrage.planDuSite');
    }

    public function reliures(){
        $ouvrage = new Ouvrage($this->getDB());
        $ouvrages = $ouvrage->findByCategorie('reliures');
        $titre = 'Quelques unes de mes Reliures';
        $message = 'Tarifs en fonction du format et du type de reliure attendu. Contact par mail et devis gratuit.';
    
        return $this->view('ouvrage.ouvrages', compact('ouvrages', 'titre', 'message'));
    }

    public function restaurations(){
        $ouvrage = new Ouvrage($this->getDB());
        $ouvrages = $ouvrage->findByCategorie('restaurations');
        $titre = 'Restaurations du XVIe au XIXe';
        $message = 'Pour obtenir un devis gratuit, envoyez-moi des photographies par email';

        return $this->view('ouvrage.ouvrages', compact('ouvrages', 'titre', 'message'));
    }

    public function boites(){
        $ouvrage = new Ouvrage($this->getDB());
        $ouvrages = $ouvrage->findByCategorie('boites');
        $titre = 'Boîtes, Etuis et Albums';

        return $this->view('ouvrage.ouvrages', compact('ouvrages', 'titre'));
    }

    public function theme (){
        $ouvrage = new Ouvrage($this->getDB());
        $themeActivated = (new Theme($this->getDB()))->getThemeActivated();
        $ouvrages = $ouvrage->findByThemeActivated($themeActivated->id);

        $titre = 'Theme à la Une : '.$themeActivated->nom;

        return $this->view('ouvrage.ouvrages', compact('ouvrages', 'titre'));
    }

}