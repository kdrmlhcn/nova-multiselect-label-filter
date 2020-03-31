<?php declare(strict_types=1);

namespace Kdrmlhcn\NovaMultiselectFilter;

use InvalidArgumentException;
use Kdrmlhcn\NovaMultiselectFilter\Enums\Config;
use Laravel\Nova\Filters\Filter;

abstract class NovaMultiselectFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'nova-multiselect-label-filter';

    public function __construct(array $configuration = [])
    {
        $this->configure($configuration);
    }

    protected function configure(array $configuration): void
    {
        if (empty($configuration)) {
            return;
        }

        foreach ($configuration as $property => $value) {
            if (!in_array($property, Config::getProperties(), true)) {
                throw new InvalidArgumentException('Invalid property: ' . $property);
            }

            $this->withMeta([$property => $value]);
        }
    }
}
