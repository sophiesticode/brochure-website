<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Theme;

class ThemeController extends Controller {

    public function themes(){
        $this->isAdmin();

        $themes = (new Theme($this->getDB()))->all();
        return $this->view('admin.theme.form', compact('themes'));
    }

    public function update(){
        $this->isAdmin();

        $id_theme_selected = isset($_POST['theme_id'])?$_POST['theme_id']:null;

        $theme = new Theme($this->getDB());

        $result = $theme->updateTheme($id_theme_selected);
        
        if($result){
            return header("Location: ../ouvrages");
        } 

    }

    public function add(){
        $this->isAdmin();

        $theme = new Theme($this->getDB());

        $result = $theme->addTheme($_POST);
        if($result){
            return header("Location: ../themes");
        } 
    }

    public function delete(){
        $this->isAdmin();
        
        $theme = new Theme($this->getDB());
        $result = $theme->deleteTheme($_POST['theme_id']);

        if($result){
            return header("Location: ../themes");
        } 
    }

}