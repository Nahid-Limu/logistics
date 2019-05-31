<?php
function checkPermission($permissions){
    $userAccess = getMyPermission(auth()->user()->is_permission);
    foreach ($permissions as $key => $value) {
        if($value == $userAccess){
            return true;
        }
    }
    return false;
}

function getMyPermission($id)
{
    switch ($id) {
        case 1:
            return 'super';
            break;
        case 2:
            return 'admin';
            break;
        case 3:
            return 'employees';
            break;

        case 4:
            return 'vendor';
            break;

        case 5:
            return 'executive';
            break;

        case 6:
            return 'driver';
            break;
        case 7:
            return 'others';
            break;
    }
}


