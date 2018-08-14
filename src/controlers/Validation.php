<?php
class Validation{
    public static function Valid_news($titre,$description,$lien):bool{
        if(!( self::Valid_titre($titre) && self::Valid_description($description) &&  self::Valid_lien($lien) )){
            throw new Exception('Un ou plusieurs champs invalides.');}
        else return true;
    }


    public static function Valid_titre($t):bool{
        if(isset($t)) {
            if (strlen($t) < 150) {
                if (preg_match("/^[A-Z \d]'?[- \? \! \. \w ' \" \d]*$/", $t))
                    return true;
                else{
                    throw new Exception('Le titre comporte des caractères invalides');

                }
            }
            else{
                throw new Exception('Le titre comporte trop de caractères (max 150)');

            }
        }
        else {
            throw new Exception('Le titre n\'est pas rempli');

        }

    }

    public static function Valid_description($t):bool{
        if(isset($t)) {
            if (strlen($t) < 500){
                if (filter_var($t,FILTER_SANITIZE_STRING))
                    return true;
                else {
                    throw new Exception('La description comporte des caractères invalides');

                }

        }
            else {
                throw new Exception('La description comporte trop de caractères (max 500)');

            }
        }
        else {
            throw new Exception('La description n\'est pas remplie');

        }

    }

    public static function Valid_lien($l):bool{
        if(isset($l)){
            if (filter_var($l, FILTER_SANITIZE_URL)){
                return true;
            }
            else{
                throw new Exception('Le lien n\'est pas valide');

            }
        }
        else {
            throw new Exception('Le lien n\'est pas défini');

        }

    }

    public static function Valid_site($s):bool{
        if(isset($s)) {
            if (strlen($s) < 100)
                if (preg_match("/^[A-Z a-z\. A-Z a-z]*\.[A-Z a-z]*$/",$s)){
                    return true;
                }
                else{
                    throw new Exception('Le site comportes des caractères invalides');

                }
            else{
                throw new Exception('Le nom du site comporte trop de caractères');

            }
        }
        else{
            throw new Exception('Le nom du site n\'est pas défini');

        }
    }

    public static function Valid_categorie($c):bool{
        if(strlen($c)>50)
            throw new Exception('La catégorie comporte trop de caractères');
        else{
                return true;
            }
    }


    public static function Valid_identification($l,$p){

            if (self::Valid_login($l) && self::Valid_password($p)) {
                return true;
            }


    }

    public static function Valid_login($l):bool{
        if(isset($l)){
            if (preg_match('`^([a-zA-Z0-9-_]{2,30})$`', $l)){
                return true;
            }
        }
       throw new Exception("Le login ne doit pas contenir d'espaces, d'apostrophes et doit faire entre 2 et 30 caractères");
    }
    public static function Valid_password($p):bool{
        if(isset($p)){
            if (strlen($p)>=8 && strlen($p)<=40){

                return true;

            }
        }
        throw new Exception("Le mot de passe doit faire entre 8 et 40 caractères");
    }

    public static function Valid_nb_pages($nb):bool{
        if(isset($nb)){
            if (filter_var($nb,FILTER_SANITIZE_NUMBER_INT)){
                if($nb<=20 && $nb>=2){
                    return true;
                }
                else{
                    throw new Exception("Le nombre de page doit être compris entre 2 et 20");
                }

            }
            else{
                throw new Exception("Le nombre de page n'est pas un INT");
            }
        }
        throw new Exception("Le nombre de page n'est pas défini");
    }

    public static function Valid_hash($h):bool{
        if(isset($h)){
            return true;
        }
        throw new Exception("Le hash n'est pas défini");
    }



}

?>