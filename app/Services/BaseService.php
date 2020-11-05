<?php

namespace App\Services;

class BaseService
{
    /**
     * @param $object - Collection/Model to transform
     * @param string $transormerClass - Transformer class
     *
     * @return array - The transform data
     */
    public function transform($object, string $transformerClass, ...$data): array
    {
        $transformer = new $transformerClass();

        if ($object instanceof \Illuminate\Support\Collection) {
            return $object->map(function ($item) use ($transformer, $data) {
                $params = array_merge([$item], $data);

                return call_user_func_array([$transformer, 'transform'], $params);
            })->toArray();
        } else {
            $params = array_merge([$object], $data);

            return call_user_func_array([$transformer, 'transform'], $params);
        }
    }
}