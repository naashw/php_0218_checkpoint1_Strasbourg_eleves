<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 */

namespace Model;


class ContactManager extends EntityManager
{
    const TABLE = 'contact';


    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

}
