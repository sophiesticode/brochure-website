<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Ouvrage;
use App\Models\Categorie;
use App\Models\Theme;
use App\Models\ItemOuvrage;

class OuvrageController extends Controller {
    public function index(){
        $this->isAdmin();

        $ouvrage = new Ouvrage($this->getDB());
        $ouvrages = $ouvrage->all();
        return $this->view('admin.ouvrage.index', compact('ouvrages'));
    }

    public function galerie(){
        $this->isAdmin();

        $ouvrage = new Ouvrage($this->getDB());
        $ouvrages = $ouvrage->all();
        return $this->view('admin.ouvrage.galerie', compact('ouvrages'));
    }

    public function categories(){
        $this->isAdmin();

        $categories = (new Categorie($this->getDB()))->all();
        return $this->view('admin.ouvrage.form', compact('categories', 'themes'));
    }

    public function add(){
        $this->isAdmin();

        $categories = (new Categorie($this->getDB()))->all();
        $themes = (new Theme($this->getDB()))->all();
        return $this->view('admin.ouvrage.form', compact('categories', 'themes'));
    }

    public function addOuvrage(){
        $this->isAdmin();

        $ouvrage = new Ouvrage($this->getDB());

        $new_labelsItems = array_pop($_POST);
        $categories = array_pop($_POST);

        $this->uploadFile($_FILES);

        try {
            $result = $ouvrage->add($_POST, $categories, $_FILES, $new_labelsItems);
            if($result){
                return header("Location: ../ouvrages");
            } 
        } catch(\Exception $e){
            echo $e->getMessage('update failed');
        }
    }

    public function edit(int $id){
        $this->isAdmin();

        $ouvrage = (new Ouvrage($this->getDB()))->findById($id);
        $categories = (new Categorie($this->getDB()))->all();
        $themes = (new Theme($this->getDB()))->all();
        return $this->view('admin.ouvrage.form', compact('ouvrage', 'categories', 'themes'));
    }

    public function update(int $id){
        $this->isAdmin();

        $ouvrage = new Ouvrage($this->getDB());
        $itemOuvrage = new ItemOuvrage($this->getDB());

        if(isset($_POST['new_labels'])){
            $new_labelsItems = array_pop($_POST);
        }
        if(isset($_POST['labels'])){
            $labelsItems = array_pop($_POST);
            $result = $itemOuvrage->updateLabels($id, $labelsItems);
        }
        $categories = array_pop($_POST);

        $result = $itemOuvrage->addItems($id, $_FILES, $new_labelsItems);

        $this->uploadFile($_FILES);

        try {
            $result = $ouvrage->update($id, $_POST, $categories);
            if($result){
                return header("Location: ../");
            } 
        } catch(\Exception $e){
            echo $e->getMessage('update failed');
        }
    }

    private function uploadFile(array $files){
        $uploads_dir ='./images/uploads';
        foreach ($files as $file) {
            $tmp_name = $file["tmp_name"];
            $name = basename($file["name"]);
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
        }
    }

    public function destroy(int $id){
        $this->isAdmin();
        
        $ouvrage = new Ouvrage($this->getDB());
        $result = $ouvrage->destroy($id);
        if($result){
            return header("Location: ../");
        }
    }


}