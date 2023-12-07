<?php
namespace OpenAdmin\LargeFileUpload;

use OpenAdmin\Admin\Form\Field;

class LargeFileField extends Field
{

    protected $group = 'file';
    public $view = 'large-file-field::large_file_upload';

    public function group($group)
    {
        $this->group = $group;
        return $this;
    }
    // .setSavedPathField('#aetherupload-savedpath').setPreprocessRoute('/aetherupload/preprocess').setUploadingRoute('/aetherupload/uploading').setLaxMode(false)
    public function render()
    {

        $this->addVariables([
            'subdir'    => date("Ym")
        ]);

        $name = str_replace('[', '\\\[', str_replace(']', '\\\]', $this->formatName($this->column)));

        $this->script = <<<SRC

        $('#{$name}-file').bootstrapFileInput();
        $('#{$name}-file').change(function(){
             aetherupload(this, '{$name}').setGroup('$this->group').success(showResult).upload('{$name}');
        });

        showResult = function () {
            $('#result-{$name}').append(
                '<small>Source：<span >' + this.resourceName + '</span> | Size：<span >' + parseFloat(this.resourceSize / (1000 * 1000)).toFixed(2) + ' MB ' + '</span> | File：<span >' + this.savedPath.substr(this.savedPath.lastIndexOf('_') + 1) + '</span></small>'
            );
        }

SRC;
        return parent::render();
    }
}

