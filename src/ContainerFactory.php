<?php

/*
 * @copyright C UAB NFQ Technologies
 *
 * This Software is the property of NFQ Technologies
 * and is protected by copyright law – it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license key
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * Contact UAB NFQ Technologies:
 * E-mail: info@nfq.lt
 * http://www.nfq.lt
 */

namespace Parking;

use Parking\DependencyInjection\ParkingExtension;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;

class ContainerFactory
{
    /**
     * @return ContainerInterface
     */
    public function create($filename)
    {
        $containerBuilder = new ContainerBuilder();

        $extension = new ParkingExtension();

        $containerBuilder->registerExtension(new ParkingExtension());
        $containerBuilder->loadFromExtension($extension->getAlias());
        $containerBuilder->compile();

        $dumper = new PhpDumper($containerBuilder);
        file_put_contents($filename, $dumper->dump(['class' => 'ParkingContainer']));
        require_once $filename;

        return new \ParkingContainer();
    }
}
