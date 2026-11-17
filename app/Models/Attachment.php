<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','mesasge','status'];

    public function attachmentFiles()
    {
        return $this->hasMany(AttachmentFile::class, 'atatchment_id', 'id');
    }
    
}
