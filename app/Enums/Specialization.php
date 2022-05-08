<?php

namespace App\Enums;

enum Specialization: string
{
    case None = 'none';
    case Software = 'software';
    case Communication = 'communications and networking';
    case AI = "artificial intelligence";
    case Security = "security";
}
