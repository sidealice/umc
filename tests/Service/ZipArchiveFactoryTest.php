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

namespace App\Tests\Service;

use App\Service\ZipArchiveFactory;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class ZipArchiveFactoryTest extends TestCase
{
    /**
     * @covers \App\Service\ZipArchiveFactory::create()
     */
    public function testCreate()
    {
        $factory = new ZipArchiveFactory();
        $this->assertInstanceOf(\ZipArchive::class, $factory->create());
    }
}
