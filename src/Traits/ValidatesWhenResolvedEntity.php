<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2022-08-09
 * Time: 20:06
 */

namespace JoseChan\Entity\Traits;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidatesWhenResolvedTrait;

trait ValidatesWhenResolvedEntity
{
    use ValidatesWhenResolvedTrait;

    protected abstract function validator(): Validator;
}
