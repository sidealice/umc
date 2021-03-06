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
namespace App\Service\License;

use App\Model\Module;

class Replacer
{
    /**
     * @param string $license
     * @param Module $module
     * @return string
     */
    public function replaceVars(string $license, Module $module) : string
    {
        $replace = [
            '{{Namespace}}' => $module->getNamespace(),
            '{{Module}}' => $module->getModuleName(),
            '{{Y}}' => date('Y')
        ];
        return str_replace(array_keys($replace), array_values($replace), $license);
    }
}
