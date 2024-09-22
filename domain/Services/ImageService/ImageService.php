<?php

namespace domain\Services\ImageService;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

/**
 * ImageService
 * php version 8.2.15
 *
 * @category Service
 * @author   CyberElysium <contact@cyberelysium.com>
 * @license  https://cyberelysium.com Config
 * @link     https://cyberelysium.com
 * */

class ImageService
{
    protected $image;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->image = new Image();
    }

    /**
     * Store
     * store image data
     *
     * @param  mixed $image
     * @return Image 
     */
    public function store($image): Image
    {
        if (isset($image)) {
            $filePath = Storage::disk('do')->putFile(config('filesystems.disks.do.folder'), $image, 'public');
            $data['name'] = config('filesystems.disks.do.public_url') . '/' . $filePath;
            return $this->image->create($data);
        }
    }

    public function update($image, $imageId)
    {         
        $existingImage = $this->image->findOrFail($imageId);
        if (isset($image)) {
            $filePath = Storage::disk('do')->putFile(config('filesystems.disks.do.folder'), $image, 'public');
            $data['name'] = config('filesystems.disks.do.public_url') . '/' . $filePath;
            $existingImage->fill($data)->save();
            return $existingImage;
        }
    }



    /**
     * Delete
     * delete image data
     *
     * @param  mixed $image
     * @return void
     */
    public function delete($imageId, $filePath)
    {
        $image = $this->image->findOrFail($imageId);
        Storage::disk('do')->delete($filePath);
        $image->delete();
    }

}
