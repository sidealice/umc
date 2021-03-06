<?php
/**
 *
 * UMC
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @copyright Marius Strajeru
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 * @author    Marius Strajeru <ultimate.module.creator@gmail.com>
 *
 */
declare(strict_types=1);

namespace App\Tests\Model;

use App\Model\Module;
use App\Model\ModuleFactory;
use App\Util\StringUtil;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class ModuleFactoryTest extends TestCase
{
    /**
     * @covers \App\Model\ModuleFactory::create
     * @covers \App\Model\ModuleFactory::__construct
     */
    public function testCreate()
    {
        /** @var StringUtil | MockObject $stringUtils */
        $stringUtils = $this->createMock(StringUtil::class);
        $factory = new ModuleFactory($stringUtils, [], []);
        $module1 = $factory->create(['namespace' => 'Namespace']);
        $module2 = $factory->create();
        $this->assertNotSame($module1, $module2);
        $this->assertInstanceOf(Module::class, $module1);
        $this->assertInstanceOf(Module::class, $module2);
        $this->assertEquals('Namespace', $module1->getNamespace());
    }
}
