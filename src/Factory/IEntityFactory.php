<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2022-08-09
 * Time: 20:09
 */

namespace JoseChan\Entity\Factory;


interface IEntityFactory
{
    public function make($className, $parameters);
}
