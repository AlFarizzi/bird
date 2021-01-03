<?php
namespace app\command;

class Commands {
    public $task;
    public function run($task) {
        $this->task = $task;
        var_dump($task);
        if($this->task[1] === "make:controller") {
            $old = "command/base_controller/Base.php";
            $new = "controllers/".$this->task[2].'.php';
            copy($old,$new);
        } else if($this->task[1] === "make:migration") {
            $old = "command/base_migration/Base.php";
            $new = "database/migrations/".$this->task[2].'.php';
            copy($old,$new);
        } else if($this->task[1] === "make:model") {
            $old = "command/base_model/Base.php";
            $new = "model/".$this->task[2].'.php';
            copy($old,$new);
        }
    }
}