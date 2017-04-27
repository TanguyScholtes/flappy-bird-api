<?php

namespace Controllers;
use Models\Score as ScoreModel;

class Score extends Controller {

    protected $model = null;

    function __construct () {
        $this -> model = new ScoreModel();
    }

    public function index () {
        $data = $this -> model -> getScores();
        if ( $data ) {
            return $data;
        } else {
            return [ 'error' => 'Couldn\'t display scores.' ];
        }
    }

    public function save () {
        if ( isset( $_POST[ 'score' ] ) ) {
            if ( ctype_digit( $_POST[ 'score' ] ) ) {
                $data = $this -> model -> saveScore( $_POST[ 'score' ] );
                if ( $data ) {
                    return [ 'success' => 'Le score a bien été enregistré.' ];
                } else {
                    return [ 'error' => 'Le score n\'a pas pu être enregistré.' ];
                }
            } else {
                return [ 'error' => 'Le score fourni n\'est pas valide.' ];
            }
        } else {
            return [ 'error' => 'Aucun score fourni.' ];
        }
    }
}
