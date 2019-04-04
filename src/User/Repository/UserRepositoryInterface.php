<?php


namespace App\User\Repository;

interface UserRepositoryInterface
{
    public function findAll();
    public function findByUser($id);
}
