<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will create the folders and files necessary for the construction of the application with the name that is entered';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $nameApp = $this->ask('Name your app?');

        if(empty($nameApp)){
            $this->error('The name of the application must not be empty!');
            exit;
        }

        $paths = array(
            'controllers' => base_path().'/app/Http/Controllers',
            'models' => app_path().'/Models',
            'views' => base_path().'/resources/views/apps'
        );

        foreach ($paths as $path){
            try{
                if(mkdir($path.'/'.$nameApp, 0775)){
                    $this->info('Successfully created folder in '.$path);
                    continue;
                }
            }catch (\Exception $e) {
                $this->error('Error creating the folder in '.$path);
                $this->error($e->getMessage());
                exit;
            }
        }

        $this->info('Command Finished');
    }
}
