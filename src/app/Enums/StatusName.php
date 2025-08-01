<?php 

namespace App\Enums;

enum StatusName: string {
    case Completed = 'Completed';
    case InProgress = 'In Progress';
    case Abandoned = 'Abandoned';
}
?>