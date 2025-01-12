<?php

namespace App\Validation;

class Validator {
    private $data;
    private $errors;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function validate(array $rules): ?array {
        foreach($rules as $name => $rulesArray){
            if(array_key_exists($name, $this->data)){
                foreach($rulesArray as $rule){
                    switch($rule){
                        case 'required':
                            $this->required($name, $this->data[$name]);
                            break;
                        case 'notTwoDots':
                            $this->notTwoDots($name, $this->data[$name]);
                            break;
                        case substr($rule, 0, 3) === 'min':
                            $this->min($name, $this->data[$name], $rule);
                            break;
                        case substr($rule, 0, 6) === 'equals':
                            $this->equalsTo($name, $this->data[$name], $rule);
                            break; 
                        default:
                            break;
                    }
                }
            }
        }
        return $this->getErrors();
    }

    private function required(string $name, string $value){
        $value = trim($value);
        
        if(!isset($value) || is_null($value) || empty($value)){
            $this->errors['name'][] = "Le {$name} est requis.";
        }
    }

    private function notTwoDots(string $name, string $value){
        if(mb_strrchr($value, ':')){
            $this->errors['name'][] = "Le {$name} ne doit pas comprendre le caractere ' : '";
        }
    }

    private function equalsTo(string $name, string $value, string $rule){
        $value = trim($value);
        $string_equal = explode(":", $rule, 2)[1];
        
        if($value !== $string_equal){
            $this->errors['name'][] = "Les {$name} doivent être identiques.";
        }
    }

    private function min(string $name, string $value, string $rule){
        preg_match_all('/(\d+)/', $rule, $matches);
        $limit = (int)$matches[0][0];

        if(strlen($value) < $limit){
            $this->errors['name'][] = "Le {$name} doit comprendre un minimum de {$limit} caractères.";
        }
    }

    private function getErrors(): ?array {
        return $this->errors;
    }
}