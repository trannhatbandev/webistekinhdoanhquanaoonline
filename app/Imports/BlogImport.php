<?php

namespace App\Imports;

use App\Models\Blog;
use Maatwebsite\Excel\Concerns\ToModel;

class BlogImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Blog([
            'blog_title' => $row[0],
            'blog_slug' => $row[1],
            'blog_description' => $row[2],
            'blog_content' => $row[3],
            'blog_status' => $row[4]
        ]);
    }
}
