<?php

namespace OpenAdmin\LargeFileUpload;

use OpenAdmin\Admin\Admin;
use Illuminate\Support\ServiceProvider;

class LargeFileUploadServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(LargeFileUpload $extension)
    {
        if (! LargeFileUpload::boot()) {
            return ;
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/open-admin-ext/large-file-upload')],
                'large-file-upload'
            );
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'large-file-field');
        }

        Admin::booting(function (){
            Admin::js('vendor/open-admin-ext/large-file-upload/js/aetherupload.admin.js');
            Admin::js('vendor/open-admin-ext/large-file-upload/js/bootstrap.file-input.js');
            Admin::js('vendor/open-admin-ext/large-file-upload/js/spark-md5.min.js');
        });

    }

}
