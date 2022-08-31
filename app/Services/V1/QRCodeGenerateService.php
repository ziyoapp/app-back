<?php

namespace App\Services\V1;

use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeGenerateService
{
    const USER_ADD_BALL_PREFIX = 'user_ball_add_';

    public function generateForUser(int $userId)
    {
        if (! is_dir(storage_path('app/public/qrcodes'))) {
            Storage::makeDirectory('public/qrcodes');
        }

        $pathToFile = storage_path('app/public') . '/qrcodes/' . self::USER_ADD_BALL_PREFIX . $userId . '.svg';

        QrCode::encoding('UTF-8')
                ->size(300)
                ->format('svg')
                ->color(127, 66, 162)
                ->eyeColor(0, 84, 62, 168, 84, 62, 168)
                ->eyeColor(1, 84, 62, 168, 84, 62, 168)
                ->eyeColor(2, 84, 62, 168, 84, 62, 168)
                ->style('round', 0.6)
                ->margin(1)
                ->errorCorrection('M')
                ->generate(json_encode(['user_id' => $userId, 'type' => 'add_ball']), $pathToFile);
    }

    public function getUserQRCodeSrc(int $userId): string
    {
        return asset('storage/qrcodes/' . self::USER_ADD_BALL_PREFIX . $userId . '.svg');
    }
}
