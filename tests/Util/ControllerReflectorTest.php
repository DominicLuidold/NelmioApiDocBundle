<?php

/*
 * This file is part of the NelmioApiDocBundle package.
 *
 * (c) Nelmio
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nelmio\ApiDocBundle\Tests\Util;

use Nelmio\ApiDocBundle\Tests\Functional\Controller\BazingaController;
use Nelmio\ApiDocBundle\Util\ControllerReflector;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;

class ControllerReflectorTest extends TestCase
{
    public function testGetReflectionMethod(): void
    {
        $controllerReflector = new ControllerReflector(new Container());
        $this->assertEquals(
            \ReflectionMethod::class,
            get_class($controllerReflector->getReflectionMethod([BazingaController::class, 'userAction']))
        );
        $this->assertEquals(
            \ReflectionMethod::class,
            get_class($controllerReflector->getReflectionMethod(BazingaController::class.'::userAction'))
        );
        $this->assertNull(
            $controllerReflector->getReflectionMethod('UnknownController::userAction')
        );
        $this->assertNull($controllerReflector->getReflectionMethod(null));
    }
}
