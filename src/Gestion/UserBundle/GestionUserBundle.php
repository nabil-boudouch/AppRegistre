<?php

namespace Gestion\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GestionUserBundle extends Bundle

{
     public function getParent()
    {
        return 'FOSUserBundle';
    }
}
