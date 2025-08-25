<?php 
namespace App\Enums;
enum FileType: string {
    case jpeg = 'image/jpeg';
    case jpg = 'image/jpg';
    case png = 'image/png';
    case pdf = 'application/pdf';

    public static function getFileType(string $fileType): string {
        return match ($fileType){
            self::jpeg->value => '.jpeg',
            self::jpg->value => '.jpg',
            self::png->value => '.png',
            self::pdf->value => '.pdf',
            default => null
        };
    }

    public static function checkValidType(string $fileType): bool {

        return in_array($fileType, array_column(self::cases(), 'value'), true);
    }
}
?>