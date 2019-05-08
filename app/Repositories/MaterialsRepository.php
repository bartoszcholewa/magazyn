<?php

namespace App\Repositories;
use App\Material;

class MaterialsRepository
{
    CONST CACHE_KEY = 'MATERIALS';

    public function all($orderBy)
    {
        $key = "all.{$orderBy}";
        $cachedKey = $this->getCacheKey($key);
        
        return cache()->remember($cachedKey, 60, function() use($orderBy){
            return Material::with('supplier')->orderBy($orderBy)->get();
        });
        //return $materials = Material::with('supplier')->orderBy($orderBy)->get();
    }

    public function get($id)
    {
        $key = "get.{$id}";
        $cachedKey = $this->getCacheKey($key);
        
        
        return cache()->remember($cachedKey, 60, function() use($id){
            return Material::with(['supplier', 'creator', 'editor'])->find($id);
        });
    }

    public function getCacheKey($key)
    {
        $key = strtoupper($key);
        return self::CACHE_KEY .".$key";
    }

    public function flush()
    {

        //cache()->forget($key);
        cache()->flush();
    }

    public function forgetCache()
    {
        $key = "get.{$id}";
        $cachedKey = $this->getCacheKey($key);
        cache()->forget($cachedKey);

    }
}