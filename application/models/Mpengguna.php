<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Mpengguna extends Eloquent{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_u';
}
