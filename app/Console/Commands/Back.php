<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Back extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'back:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'backup your databases';

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
        $tables = $this->getTables();


        $this->toFiles($tables);
    }


    protected function getTables() : array
    {
        return DB::select('show tables');
    }

    protected function toFiles(array $tables){
        $config = config('database.connections.'. DB::getDefaultConnection());

        foreach ($tables as $table){
            $tableName = $table->{'Tables_in_' . $config['database']};
            $columns = DB::selectOne('show columns from `'.$tableName.'`');
            DB::table($tableName)->orderBy($columns->Field)->chunk(100,
            function (Collection $results, int $page) use ($tableName){
                $json = $results->toJson();
                $this->saveFile($tableName, $page, $json);
            });
        }
    }

    protected function saveFile($table, int $page, string $json){
        $dir = database_path('back-up/' . $_SERVER['REQUEST_TIME'] . '/' . $table);
        if(!is_dir($dir)){
            mkdir($dir, 0755, true);
        }

        file_put_contents($dir.'/'.$page . '.json', $json);
    }
}
