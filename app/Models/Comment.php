<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // table
    protected $table = "comment";

    // required fields
    protected $guarded = ["post_id", "content", "author"];
}
