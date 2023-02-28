<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

trait CacheHelper
{
    protected function cache($time, $data, $key)
    {
        if ($time === 'forever') {
            return Cache::rememberForever($key, fn() => $data);
        }

        Cache::put($key, $data, $time);
        return $data;
    }

    public function getCache($key = null)
    {
        $key = $key ?: $this->getCacheKey();
        return Cache::get($key) ?? collect([]);
    }

    public function rebuildCache($time = 'forever', $data = null, $key = null)
    {
        $key = $key ?: $this->getCacheKey();
        $data = $data ?: $this->getModelData();
        $this->forget($key);
        return $this->cache($time, $data, $key);
    }

    public function forget($key)
    {
        return Cache::forget($key);
    }

    protected function getClassBaseName()
    {
        return Str::of(class_basename($this))->before('Controller');
    }

    protected function getModelFullPath()
    {
        return $this->getClassBaseName()->prepend('App\\Models\\')->__toString();
    }

    protected function getCacheKey()
    {
        return $this->getClassBaseName()->lower()->plural()->__toString();
    }

    protected function getModelData()
    {
        $model = $this->getModelFullPath();
        return (new $model)->all();
    }

    protected function isCached()
    {
        return Cache::get($this->getCacheKey());
    }
}
