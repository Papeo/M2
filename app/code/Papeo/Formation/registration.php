<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

use Magento\Framework\Component\ComponentRegistrar;

// la seule chose à adapter c'est le Component Name
ComponentRegistrar::register(ComponentRegistrar::MODULE, 'Papeo_Formation', __DIR__);

