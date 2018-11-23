<?php

namespace Aastech\MultiAuth\Commands;

use Aastech\Core\Commands\InstallFilesCommand;
use Aastech\MultiAuth\Commands\Traits\OverridesCanReplaceKeywords;
use Aastech\MultiAuth\Commands\Traits\OverridesGetArguments;
use Aastech\MultiAuth\Commands\Traits\ParsesServiceInput;
use Symfony\Component\Console\Input\InputOption;


class AuthModelInstallCommand extends InstallFilesCommand
{
    use OverridesCanReplaceKeywords, OverridesGetArguments,ParsesServiceInput;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'multi-auth:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Authenticatable Model';

    /**
     * Get the console command options.
     *
     * @return array
     */
    public function getOptions()
    {
        $parentOptions = parent::getOptions();
        return array_merge($parentOptions, [
            ['lucid', false, InputOption::VALUE_NONE, 'Lucid architecture'],
        ]);
    }

    /**
     * Get the destination path.
     *
     * @return string
     */
    public function getFiles()
    {
        $name = $this->getParsedNameInput();
        $lucid = $this->option('lucid');

        return [
            'model' => [
                'path' => ! $lucid
                    ? '/app/' . ucfirst($name) .'.php'
                    : '/src/Data/' . ucfirst($name) . '.php',
                'stub' => ! $lucid
                    ? __DIR__ . '/../stubs/Model/Model.stub'
                    : __DIR__ . '/../stubs/Lucid/Model/Model.stub',
            ],
        ];
    }
}
