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
namespace App\Tests\Controller;

use App\Controller\Save;
use App\Model\Module;
use App\Service\Builder;
use App\Service\ModuleLoader;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Router;

class SaveTest extends TestCase
{
    /**
     * @var RequestStack | MockObject
     */
    private $requestStack;
    /**
     * @var Request | MockObject
     */
    private $request;
    /**
     * @var Builder | MockObject
     */
    private $builder;
    /**
     * @var ModuleLoader | MockObject
     */
    private $moduleLoader;
    /**
     * @var Router | MockObject
     */
    private $router;
    /**
     * @var Save
     */
    private $save;

    /**
     * setup tests
     */
    protected function setUp()
    {
        $this->requestStack = $this->createMock(RequestStack::class);
        $this->request = $this->createMock(Request::class);
        $this->requestStack->method('getCurrentRequest')->willReturn($this->request);
        $this->builder = $this->createMock(Builder::class);
        $this->moduleLoader = $this->createMock(ModuleLoader::class);
        $this->router = $this->createMock(Router::class);
        $this->save = new Save($this->requestStack, $this->builder, $this->moduleLoader);
        /** @var ContainerInterface | MockObject $container */
        $container = $this->createMock(ContainerInterface::class);
        $container->method('has')->willReturnMap([
            ['router', true]
        ]);
        $container->method('get')->willReturnMap([
            ['router', $this->router]
        ]);
        $this->save->setContainer($container);
    }

    /**
     * @covers \App\Controller\Save::run
     * @covers \App\Controller\Save::__construct
     */
    public function testRun()
    {
        $this->request->method('get')->willReturn([
            'module' => [
                'namespace' => 'namespace',
                'module_name' => 'moduleName',
            ],
            'entity' => [
                [
                    'name_singular' => 'entityOne',
                    'is_name' => 0
                ]
            ],
            'attribute' => [
                0 => [
                    [
                        'code' => 'attr1'
                    ]
                ]
            ]
        ]);
        $this->moduleLoader->expects($this->once())->method('loadModule')
            ->willReturn($this->createMock(Module::class));
        $this->router->expects($this->once())->method('generate')->willReturn('url');
        $this->assertInstanceOf(JsonResponse::class, $this->save->run());
    }

    /**
     * @covers \App\Controller\Save::run
     * @covers \App\Controller\Save::__construct
     */
    public function testRunWithException()
    {
        $this->request->method('get')->willReturn([]);
        $this->moduleLoader->expects($this->once())->method('loadModule')
            ->willReturn($this->createMock(Module::class));
        $this->moduleLoader->method('loadModule')->willThrowException(new \Exception(''));
        $this->assertInstanceOf(JsonResponse::class, $this->save->run());
    }
}
