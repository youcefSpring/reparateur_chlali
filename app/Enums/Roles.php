<?php

namespace App\Enums;

enum Roles: string
{
   case SUPERADMIN = 'Super admin';
   case ADMIN = 'Admin';
   case OWNER = 'Owner';
   case STORE = 'Store';
   case CUSTOMER = 'Customer';
}
