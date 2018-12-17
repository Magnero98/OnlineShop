<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/9/2018
 * Time: 7:14 PM
 */

namespace Garnet\Repositories\Criteria;


abstract class Criteria
{
    public abstract function apply(Model $model);
}