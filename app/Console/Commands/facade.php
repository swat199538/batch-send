<?php

namespace App\Console\Commands;

use Config;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;

class MakeFacadeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:facade {facade}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Facade';

    protected $facade;
    protected $model;
    /**
     * Create a new command instance.
     *
     * @param Filesystem $filesystem
     * @param Composer $composer
     */
    public function __construct(Filesystem $filesystem, Composer $composer)
    {
        parent::__construct();

        $this->files = $filesystem;
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //获取facade和model两个参数
       $argument = $this->arguments('facade');
       $option = $this->options('model');
       //自动生成facade的文件
       $this->writeFacade($argument,$option);
       //重新生成autoload.php文件
       $this->composer->dumpAutoloads();
    }

    private function writeFacade($facade,$model)
    {
        if($this->createFacade($facade,$model)){
            $this->info('Success to make a'.ucfirst($facade).'Facate');
        }
    }

    private function createFacade($facade,$model)
    {
        //赋予成员变量值
        $this->setRepository($facade);
        $this->setModel($model);
        //创建存放的路径
        $this->createDirectory();
        //生成文件
        return $this->createClass();
    }

    private function createDirectory(){
        $directory = $this->getDirectory();
        if(!$this->files->isDirectory($directory)){
            return $this->files->makeDirectory($directory,0755,true);
        }
    }

    private function getDirectory()
    {
        return Config::get('facade.directory_path');
    }

    private function createClass()
    {
        $templates = $this->templateStub();
        $class = null;
        foreach($templates as $key =>$template){
            $class = $this->files->put($this->getPath($key),$template);
        }
        return $class;
    }

    private function templateStub()
    {
        //获取facade的模板
        $stubs = $this->getStub();
        // 获取需要替换的模板中的变量
        $templateData = $this->getTemplateData();
        $renderStubs = [];
        foreach($stubs as $key => $stub){
            $renderStubs[$key] = $this->getRenderStub($templateData,$stub);
        }
        return $renderStubs;
    }

    private function getStub()
    {
        $stubs = [
            'Eloquent' => $this->files->get(resource_path('stubs/Fcade').DIRECTORY_SEPARATOR.'Facade.stub')
        ];
        return $stubs;
    }

    private function getTemplateData()
    {
        $facadeNamespace          = Config::get('facade.facates_namespace');
        $modelNamespace     = 'App\\'.$this->getModelName();
        $className                    = $this->getFacadeName();
        $modelName                    = $this->getModelName();

        $templateVar = [
            'facade_namespace' =>$facadeNamespace,
            'model_namespace'=>$modelNamespace,
            'class_name' => $className,
            'model_name' => $modelName,
        ];

        return $templateVar;
    }

    private function getRenderStub($templateData,$stub)
    {
        foreach($templateData as $search => $replace){
            $stub = str_replace('$'.$search,$replace,$stub);
        }
        return $stub;
    }

    private function getFacadeName()
    {
        // 根据输入的facade变量参数,是否需要加上'Facade'
        $facadeName = $this->getFacade();
        if((strlen($facadeName) < strlen('Facade')) || strrpos($facadeName, 'Facade', -11)){
            $facadeName .= 'Facade';
        }
        return $facadeName;
    }

    private function getModelName()
    {
        $modelName = $this->getModel();
        if(isset($modelName) && !empty($modelName)){
            $modelName = ucfirst($modelName);
        }else{
            // 若option选项没写,则根据repository来生成Model Name
            $modelName = $this->getModelFromRepository();
        }

        return $modelName;
    }

    private function getModelFromRepository()
    {
        $repository = strtolower($this->getRepository());
        $repository = str_replace('repository', '', $repository);
        return ucfirst($repository);
    }

    /**
     * @return mixed
     */
    public function getFacade()
    {
        return $this->Facade;
    }
}
