<?php

namespace Farzai\NovaMedia\Fields;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;

class Media extends File
{
    /**
     * The name of the preview conversion.
     *
     * @var string
     */
    public $previewConversionName = 'preview';

    /**
     * The name of the thumbnail conversion.
     *
     * @var string
     */
    public $thumbnailConversionName = 'thumb';

    /**
     * Create a new field.
     *
     * @param  string  $name
     * @param  string|callable|null  $attribute
     * @param  string|null  $disk
     * @return void
     */
    public function __construct($name, $attribute = null, $disk = null)
    {
        parent::__construct($name, $attribute, $disk ?: $this->getMediaDisk());

        $this
            ->store(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                /** @var \Spatie\MediaLibrary\HasMedia|mixed $model */

                // Clear old media
                $model->clearMediaCollection($attribute);

                $model
                    ->addMediaFromRequest($requestAttribute)
                    ->toMediaCollection($attribute);

                return [];
            })
            ->thumbnail(function ($value, $disk, Model $model) {
                /** @var \Spatie\MediaLibrary\HasMedia|mixed $model */
                return $model->getFirstMedia($this->attribute)?->getFullUrl($this->thumbnailConversionName);
            })->preview(function ($value, $disk, Model $model) {
                /** @var \Spatie\MediaLibrary\HasMedia|mixed $model */
                return $model->getFirstMedia($this->attribute)?->getFullUrl($this->previewConversionName);
            })
            ->displayUsing(function ($value, $resource, $attribute) {
                /** @var \Spatie\MediaLibrary\HasMedia|mixed $resource */
                return $resource->getFirstMedia($attribute)?->getFullUrl($this->previewConversionName);
            })
            ->resolveUsing(function ($value, $resource, $attribute) {
                /** @var \Spatie\MediaLibrary\HasMedia|mixed $resource */
                return $resource->getFirstMedia($attribute)?->getFullUrl();
            });
    }

    /**
     * Set the preview conversion name.
     *
     * @return $this
     */
    public function previewConversionName(string $name)
    {
        $this->previewConversionName = $name;

        return $this;
    }

    /**
     * Set the thumbnail conversion name.
     *
     * @return $this
     */
    public function thumbnailConversionName(string $name)
    {
        $this->thumbnailConversionName = $name;

        return $this;
    }

    /**
     * Get the disk that should be used to store the file.
     */
    protected function getMediaDisk(): string
    {
        return config('media-library.disk_name', $this->getStorageDisk());
    }
}
