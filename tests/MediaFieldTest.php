<?php

use Farzai\NovaMedia\Fields\Media as MediaField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Laravel\Nova\Http\Requests\NovaRequest;

it('can be instantiated', function () {
    $field = new MediaField('Media');

    expect($field)->toBeInstanceOf(MediaField::class);
});

it('can be instantiated with a custom collection name', function () {
    $field = new MediaField('Media', 'new-collection-name');

    expect($field->attribute)->toBe('new-collection-name');
});

it('can be instantiated with a custom disk', function () {
    $field = new MediaField('Media', 'custom_attribute', 'custom_disk');

    expect($field->disk)->toBe('custom_disk');
});

it('can create a new media item', function () {
    $file = UploadedFile::fake()->image('test-file.jpg');

    $field = new MediaField('Media');

    $request = Mockery::mock(NovaRequest::class);
    $request->shouldReceive('file')->with('Media')->once()->andReturn($file);

    $model = Mockery::mock(Model::class);
    $model->shouldReceive('clearMediaCollection')->once();
    $model->shouldReceive('addMediaFromRequest')->with('Media')->once()->andReturn($model);
    $model->shouldReceive('toMediaCollection')->with('Media')->once();

    $field->fillInto($request, $model, 'Media', 'Media');
});
