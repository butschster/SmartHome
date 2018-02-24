<?php

namespace SmartHome\App\Helpers;

use Symfony\Component\OptionsResolver\OptionsResolver;

trait HasOptions
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    /**
     * @return array
     */
    public function options(): array
    {
        return $this->options;
    }

    /**
     * @param OptionsResolver $resolver
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}