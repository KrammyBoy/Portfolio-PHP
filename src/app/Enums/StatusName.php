<?php 

namespace App\Enums;

/**
 * StatusName based on the status id.
 */
enum StatusName: string {
    case Completed = 'completed';
    case InProgress = 'in-progress';
    case Abandoned = 'abandoned';

    // Get the status name based on the id
    public static function getStatusName(int $statusID): ?self {

        return match ($statusID) {
            1 => self::Completed,
            2 => self::InProgress,
            3 => self::Abandoned,
            default => null,
        };
    }
}
?>