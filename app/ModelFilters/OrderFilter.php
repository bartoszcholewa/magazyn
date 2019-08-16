<?php namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class OrderFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function laminate($lam)
    {
        return $this->where('order_LAMINATE', $lam);
    }
    public function complaint($com)
    {
        return $this->where('order_STATUS', $com);
    }

    public function search($search)
    {
        $name = explode(' ', $search, 2);
        if (count($name) > 1)
        {
            return $this->where('order_CLIENT_NAME', 'LIKE', '%' . $name[0] . '%')->Where('order_CLIENT_SURNAME', 'LIKE', '%' . $name[1].'%');
        }
        if (str_contains($search, 'PW-'))
        {
            $new_search = (int)str_replace_first('PW-', '', $search);
            return $this->where('order_NAME', 'LIKE', '%' . $new_search . '%');
        }
        return $this->where('order_NAME', 'LIKE', '%' . $search . '%')->orWhere('order_CLIENT_NAME', 'LIKE', '%' . $search.'%')->orWhere('order_CLIENT_SURNAME', 'LIKE', '%' . $search.'%');

    }
}
