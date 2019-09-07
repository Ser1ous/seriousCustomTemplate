<?php

namespace EvolutionCMS\SeriousCustom\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SeriousCustomTemplateCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'sct:install';

    /**
     * @var string
     */
    protected $description = 'Configure after install/update';

    /**
     * @var
     */
    protected $evo;

    /**
     * @var string
     */
    public $directory = EVO_CORE_PATH . 'custom/config/cms/settings/';

    /**
     * @var string
     */
    public $fileName = 'seriousTemplateNamespace.php';

    /**
     * SeriousCustomTemplateCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->evo = EvolutionCMS();
        $this->fileName = $this->directory . $this->fileName;
    }

    /**
     *
     */
    public function handle()
    {
        if (File::isFile($this->fileName)) {
            $name = $this->askRewrite();
        } else {
            $name = 'y';
        }
        if (strtolower($name) == 'y') {
            $namespace = $this->ask('Please enter u namespace? (Like: Serious\\\\Controllers\\\\)');
            if (!File::isDirectory($this->directory)) {
                File::makeDirectory($this->directory, 0755, true);
            }
            File::put($this->fileName, '<?php return "' . $namespace . '";');
        }
    }

    /**
     * @return mixed
     */
    public function askRewrite()
    {
        $answer = $this->ask('Config namespace already exist, do you wish rewrite? (Y/N)');
        if (strtolower($answer) != 'y' && strtolower($answer) != 'n') {
            return $this->askRewrite();
        } else {
            return $answer;
        }
    }

}
