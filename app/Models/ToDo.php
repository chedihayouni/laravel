<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'title',
        'description',
        'date',
        'status',
        'user_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function getTitle()
    {
        return $this->attributes['title'];
    }

    public function getDescription()
    {
        return $this->attributes['description'];
    }

    public function getStatus()
    {
        return $this->attributes['status'];
    }

    public function getDate()
    {
        return $this->attributes['date'];
    }

    /**
     * Dynamically set attributes on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }
}
