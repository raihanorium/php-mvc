<?php
namespace core;

require_once 'lib/DocBlockReader/Reader.php';

use \DocBlockReader\Reader;

abstract class Security {
    private static function getClassAnnotations($class) {
        $doc = new \ReflectionClass($class);
        $doc = $doc->getDocComment();
        preg_match_all('#@(.*?)\n#s', $doc, $annotations);
        return $annotations[1];
    }

    private static function getMethodAnnotations($class, $method) {
        $doc = new \ReflectionMethod($class, $method);
        $doc = $doc->getDocComment();
        preg_match_all('#@(.*?)\n#s', $doc, $annotations);
        return $annotations[1];
    }

    private static function getRolesByHasAnyRole($text){
        if($text) {
            $re = '/hasAnyRole\(([^)]+)\)/';
            preg_match($re, $text, $matches);
            $roleArray = explode(',', $matches[1]);
            return array_map('trim', $roleArray);
        }
        return array();
    }

    private static function getUserRoles(){
        $userRoles = array();
        if(isset($_SESSION['LOGGED_IN_USER'])){
            $userRoles = $_SESSION['LOGGED_IN_USER']['roles'];
        }else{
            throw new \Exception('User not logged in');
        }

        return $userRoles;
    }

    public static function getRolesInController($controllerClass){
        $ann = array();
        $ann = Security::getClassAnnotations($controllerClass);
        if($ann){
            return Security::getRolesByHasAnyRole($ann[0]);
        }
        return $ann;
    }

    public static function getRolesInAction($controllerClass, $actionMethod){
        $ann = array();
        $ann = Security::getMethodAnnotations($controllerClass, $actionMethod);
        if($ann){
            return Security::getRolesByHasAnyRole($ann[0]);
        }
        return $ann;
    }

    public static function checkPermission($controllerClass, $action){
        $matchedRoles = array();
        $actionRoles = self::getRolesInAction($controllerClass, $action);
        var_export($actionRoles);
        if ($actionRoles) {
            $userRoles = self::getUserRoles();
            $matchedRoles = array_intersect($actionRoles, $userRoles);
        } else {
            $controllerRoles = self::getRolesInController($controllerClass);
            if($controllerRoles){
                $userRoles = self::getUserRoles();
                $matchedRoles = array_intersect($controllerRoles, $userRoles);
            } else{
                return true;
            }
        }

        return $matchedRoles;
    }

    public static function login($email, $password){
        $user = array(
            'email' => $email,
            'password' => $password,
            'roles' => array('user')
        );
        $_SESSION['LOGGED_IN_USER'] = $user;
    }

    public static function logout(){
        $_SESSION['LOGGED_IN_USER'] = null;
        session_destroy();
    }
}