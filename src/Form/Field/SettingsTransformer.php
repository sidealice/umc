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

namespace App\Form\Field;

class SettingsTransformer implements TransformerInterface
{
    /**
     * @param array $fieldConfig
     * @return bool
     */
    public function transform(array $fieldConfig) : ?array
    {
        if (isset($fieldConfig['has_default']) && $fieldConfig['has_default']) {
            $fieldConfig['options']['required'] = false;
            return $fieldConfig;
        }
        return null;
    }
}
