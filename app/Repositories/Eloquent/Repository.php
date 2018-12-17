<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/9/2018
 * Time: 6:33 PM
 */

namespace Garnet\Repositories\Eloquent;

use Garnet\Repositories\Contracts\CriteriaInterface;
use Garnet\Repositories\Contracts\RepositoryInterface;
use Garnet\Repositories\Criteria\Criteria;
use Garnet\Repositories\Exceptions\MistypeOfModelException;
use Illuminate\Container as App;

abstract class Repository implements RepositoryInterface, CriteriaInterface
{
    private $app;

    protected $model;

    protected $criteria;

    protected $usingCriteria;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    public abstract function getModelPath();

    public function makeModel()
    {
        if($this->model == null)
        {
            $this->model = $this->app->make($this->getModelPath());

            if(!$this->model instanceof Model)
                throw new MistypeOfModelException();
        }

        return $this->model;
    }

    public function all($columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->get($columns);
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->paginate($perPage, $columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $attribute = 'id', $value = 0)
    {
        return $this->model->where($attribute, 'LIKE', $value)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id, $columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->find($id, $columns);
    }

    public function findBy($attribute, $value, $columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->where($attribute, 'LIKE', $value)->get($columns);
    }

    public function getCriteria()
    {
        return $this->criteria;
    }

    public function addCriteria(Criteria $criteria)
    {
        return $this->criteria->push($criteria);
    }

    public function resetCriteria()
    {
        unset($this->criteria);
        return $this->criteria = array();
    }

    public function usingCriteria($status = true)
    {
        return $this->usingCriteria = $status;
    }

    public function applyCriteria()
    {
        if($this->usingCriteria)
            foreach ($this->criteria as $criterion)
                $this->model = $criterion->apply($this->model);

        return $this->model;
    }
}