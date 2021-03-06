<?php

use Illuminate\Database\Schema\Blueprint;
use LaravelRocket\Foundation\Database\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('url')->default('');
            $table->text('title')->nullable();

            $table->string('entity_type')->default('');
            $table->bigInteger('entity_id')->default(0);

            $table->string('storage_type')->default(false);

            $table->string('file_type')->default('');
            $table->string('file_category_type')->default('');

            $table->string('s3_key')->default('');
            $table->string('s3_bucket')->default('');
            $table->string('s3_region')->default('');
            $table->string('s3_extension')->default('');

            $table->string('media_type')->default('');
            $table->string('format')->default('');
            $table->string('original_file_name')->default('');

            $table->unsignedBigInteger('file_size')->default(0);
            $table->unsignedInteger('width')->default(0);
            $table->unsignedInteger('height')->default(0);

            $table->text('thumbnails')->nullable();

            $table->boolean('is_enabled')->default(true);

            $table->softDeletes();
            $table->timestamps();

            $table->index(['file_type', 'id', 'deleted_at']);
            $table->index(['file_category_type', 'id', 'deleted_at']);
            $table->index(['id', 'deleted_at']);
            $table->index(['url', 'deleted_at']);
            $table->index(['entity_type', 'entity_id', 'deleted_at']);
        });

        $this->updateTimestampDefaultValue('files', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
