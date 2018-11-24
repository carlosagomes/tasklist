<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	public $timestamps = false;
    /**
     * Funcao responsavel por fazer a juncao de Task Status com Task com seus IDS. Fazendo com que toda Task tenha seu obejto taskStatus.
     *
     */	
    public function taskStatus(){
    	return $this->hasOne(TaskStatus::class,'id','task_status_id');
    }
}
