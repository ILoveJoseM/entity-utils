<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2022-08-09
 * Time: 20:11
 */

namespace JoseChan\Entity\Factory;


class DefaultEntityFactory implements IEntityFactory
{
    public function make($className, $parameters)
    {
        return new $className($parameters['data'], $this);
    }

}
