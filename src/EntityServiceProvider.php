<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2022-08-09
 * Time: 20:13
 */

namespace JoseChan\Entity;


use JoseChan\Entity\Factory\ContainerEntityFactory;
use JoseChan\Entity\Factory\IEntityFactory;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Support\ServiceProvider;

class EntityServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(IEntityFactory::class, ContainerEntityFactory::class);
        $this->app->resolving(ValidateEntity::class, function (ValidateEntity $entity, $app) {
            $entity->setValidatorFactory($app->make(ValidationFactory::class));
        });
    }
}
