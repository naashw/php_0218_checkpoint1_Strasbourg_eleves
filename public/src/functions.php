<?php

function fullname($lastname,$firstname)
{
    return strtoupper($lastname)." ".ucwords(strtolower($firstname));
}
