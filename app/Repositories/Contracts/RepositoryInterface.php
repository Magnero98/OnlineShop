<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/9/2018
 * Time: 6:02 PM
 */

namespace Garnet\Repositories\Contracts;


Interface RepositoryInterface
{
    public function all($columns = array('*'));

    public function paginate($perPage = 15, $columns = array('*'));

    public function create(array $data);

    public function update(array $data, $attribute = 'id', $value = 0);

    public function delete($id);

    public function find($id, $columns = array('*'));

    public function findBy($attibute, $value, $columns = array('*'));
}