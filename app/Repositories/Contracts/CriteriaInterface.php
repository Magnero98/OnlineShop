<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/9/2018
 * Time: 6:29 PM
 */

namespace Garnet\Repositories\Contracts;


use Garnet\Repositories\Criteria\Criteria;

Interface CriteriaInterface
{
    public function getCriteria();

    public function addCriteria(Criteria $criteria);

    public function resetCriteria();

    public function usingCriteria($status = true);

    public function applyCriteria();
}