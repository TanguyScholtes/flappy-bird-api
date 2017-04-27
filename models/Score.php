<?php

namespace Models;

class Score extends Model {
    public function getScores () {
        if ( $this -> connectDB ) {
            try {
                $sql = 'SELECT * FROM scores ORDER BY score DESC LIMIT 10';
                $pdoSt = $this -> connectDB -> query( $sql );
                return $pdoSt -> fetchAll();
            } catch ( \PDOException $e ) {
                return [ 'error' => $e -> getMessage() ];
            }
        } else {
            return false;
        }
    }

    public function saveScore ( $score ) {
        if ( $this -> connectDB ) {
            try {
                $sql = 'INSERT INTO scores(`score`) VALUES (:score)';
                $pdoSt = $this -> connectDB -> prepare( $sql );
                return $pdoSt -> execute( [ ':score' => $score ] );
            } catch ( \PDOException $e ) {
                return [ 'error' => $e -> getMessage() ];
            }
        } else {
            return false;
        }
    }
}
