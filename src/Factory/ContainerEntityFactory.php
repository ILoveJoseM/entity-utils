<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2022-08-09
 * Time: 20:09
 */

namespace JoseChan\Entity\Factory;


use Illuminate\Foundation\Application;

class ContainerEntityFactory implements IEntityFactory
{
    /** @var Application $container */
    protected $container;

    /**
     * @param Application $container
     */
    public function __construct(Application $container)
    {
        $this->container = $container;
    }

    /**
     * 创建对象
     * @param $className
     * @param $parameters
     * @return mixed
     * @author 陈煜 <chenyu33@shein.com> 2022/8/9 10:10
     */
    public function make($className, $parameters)
    {
        return $this->container->make($className, $parameters);
    }

}
