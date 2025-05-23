<?php

namespace App\Services;

use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class QrCodeService
{
    /**
     * Generate a QR code and save it to the specified path
     *
     * @param string $data The data to encode in the QR code
     * @param string $path The path where the QR code should be saved
     * @return string The path to the generated QR code
     */
    public function generate($data, $path)
    {
        // Create directory if it doesn't exist
        $directory = dirname($path);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Create QR code renderer
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new SvgImageBackEnd()
        );
        
        // Create QR code writer
        $writer = new Writer($renderer);
        
        // Generate and save QR code
        $writer->writeFile($data, $path);
        
        return $path;
    }
    /**
     * Generate a QR code for a card
     *
     * @param string $url The URL to encode in the QR code
     * @param int $cardId The ID of the card
     * @return string The path to the generated QR code
     */
    public function generateQrCode($url, $cardId)
    {
        $path = 'qrcodes/' . $cardId . '.svg';
        return $this->generate($url, public_path($path));
    }
}