<?php

namespace CodeDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\GeoRepository;
use CodeDelivery\Models\Geo;
use CodeDelivery\Validators\GeoValidator;

/**
 * Class GeoRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class GeoRepositoryEloquent extends BaseRepository implements GeoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Geo::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
