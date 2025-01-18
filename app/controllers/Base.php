<?php 
namespace app\controllers;
use app\views\Viewer;
abstract class Base extends Viewer{
    protected function model($model) {
        $class_model = 'app\\models\\'.$model;
        if(class_exists($class_model)) {
            return new $class_model();
        }
        return false;
    }
}