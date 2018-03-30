<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 20:52
 */

namespace Model;


abstract class EntityManager
{
    protected $conn; //variable de connexion

    protected $table;

    public function __construct($table)
    {
        $db = new Connection();
        $this->conn = $db->getPdo();
        $this->table = $table;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->conn->query('SELECT * FROM ' . $this->table, \PDO::FETCH_ASSOC)->fetchAll();
    }

    /**
     * @param $id
     * @return array
     */
    public function findOneById(int $id)
    {
        // prepared request
        $statement = $this->conn->prepare("SELECT * FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     *
     */
    public function delete($ID)
    {
      $statement = $this->conn->prepare("DELETE FROM contact WHERE ID = :ID;");
  //  $statement = $this->conn->prepare("INSERT INTO civility VALUES (civility=:civility");

      $statement->bindValue(':ID', $ID, \PDO::PARAM_INT);
      $statement->execute();
      header('Location:/');
    }

    /**
     *
     */
    public function insert($lastname, $firstname, $civility)
    {

        $statement = $this->conn->prepare("INSERT INTO contact(lastname, firstname, civility_id) VALUES (:lastname,:firstname,:civility);");
    //  $statement = $this->conn->prepare("INSERT INTO civility VALUES (civility=:civility");

        $statement->bindValue(':civility', $civility, \PDO::PARAM_INT);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);

        $statement->execute();
        header('Location:/');
    //    return $statement->fetch(\PDO::FETCH_ASSOC);




    }


    /**
     *
     */
    public function update($id, $data)
    {
        //TODO : Implements SQL UPDATE request
    }


}
