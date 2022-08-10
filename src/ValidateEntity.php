<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2022-08-08
 * Time: 20:48
 */

namespace JoseChan\Entity;


use JoseChan\Entity\Traits\ValidatesWhenResolvedEntity;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Factory;

/**
 * @ClassName ValidateEntity
 */
abstract class ValidateEntity extends Entity implements ValidatesWhenResolved
{
    use ValidatesWhenResolvedEntity;

    /** @var Factory $validatorFactory */
    protected $validatorFactory;

    protected function validator(): Validator
    {
        return $this->validatorFactory->make(
            $this->data, $this->rules(),
            $this->messages(), $this->attributes()
        );
    }

    /**
     * @param mixed $validatorFactory
     */
    public function setValidatorFactory(Factory $validatorFactory): void
    {
        $this->validatorFactory = $validatorFactory;
    }

    protected abstract function rules();

    protected function messages()
    {
        return [];
    }

    protected function attributes()
    {
        return [];
    }
}
