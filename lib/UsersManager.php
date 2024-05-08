<?php

/**
 * UsersManager, handles users
 *
 * @author Peter Donders
 * @version 0.0.1
 *
 * Changelog
 * 0.0.1
 *      First Version
 */
class UsersManager {

    protected $table = 'users';


    public function getUser($id) {

        $id = (int) $id;


        $db = DB::loadDb();

        $sql = "SELECT `id`, `username`, `email`  FROM `$this->table` WHERE id = $id";
        return $db->selectObject($sql, "User");

    }

}