<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Exports\BlogExport;
use App\Http\Controllers\Controller;
use App\Imports\BlogImport;
use App\Models\Blog;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BlogController extends Controller
{
    public function isLogin()
        {
            $admin = session()->get('admin_id');

            if($admin){
                return redirect()->to('/admin/dashboard');
            }else{
                return redirect()->to(route('login'))->send();
            }
        }
    public function showListBlog()
    {
        $this->isLogin();
        $blog = Blog::orderBy('blog_id','DESC')->get();
        return view('admin.blog.show_list_blog')->with(compact('blog'));
    }
    public function createBlog(Request $request)
    {
        $this->isLogin();
        $data = $request->validate(
            [
                'blog_title' => 'required|unique:blog|max:255',
                'blog_slug' => 'required|unique:blog|max:255',
                'blog_description' => 'required',
                'blog_content' => 'required',
                'blog_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'blog_status' => 'required',
            ],
            [
                'blog_title.unique' => 'Tên bài viết đã có xin điền tên khác',
                'blog_slug.unique' => 'Slug bài viết đã có xin điền tên khác',
                'blog_title.required' => 'Tên bài viết phải có',
                'blog_slug.required' => 'Slug bài viết phải có',
                'blog_image.required' => 'Hình ảnh phải có',
                'blog_image.image' => 'Phải là file hình ảnh',
                'blog_image.mimes' => 'Phải sử dụng những định dạng sau: jpg, png, jpeg, gif, svg',
                'blog_description.required' => 'Mô tả bài viết phải có',
                'blog_content.required' => 'Nội dung bài viết phải có',
                'blog_status.required' => 'Trạng thái bài viết phải có',
            ]
        );

        $blog = new Blog();

        $blog->blog_title = $data['blog_title'];
        $blog->blog_slug = $data['blog_slug'];
        $blog->blog_description = $data['blog_description'];
        $blog->blog_content = $data['blog_content'];
        $blog->blog_status = $data['blog_status'];

        $get_image = $request->blog_image;
        $path = 'public/uploads/blogs/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $blog->blog_image = $new_image;

        $blog->save();

        Toastr::success("Thêm bài viết thành công", "Thành công");
        return redirect()->back();
    }

    public function updateBlog(Request $request, $id){
        $this->isLogin();
        $data = $request->validate(
            ['blog_title' => 'required|max:255',
            'blog_slug' => 'required|max:255',
            'blog_description' => 'required',
            'blog_content' => 'required',
            'blog_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'blog_status' => 'required',
            ],
            [

                'blog_title.unique' => 'Tên bài viết đã có xin điền tên khác',
                'blog_slug.unique' => 'Slug bài viết đã có xin điền tên khác',
                'blog_title.required' => 'Tên bài viết phải có',
                'blog_slug.required' => 'Slug bài viết phải có',
                'blog_image.required' => 'Hình ảnh phải có',
                'blog_image.image' => 'Phải là file hình ảnh',
                'blog_image.mimes' => 'Phải sử dụng những định dạng sau: jpg, png, jpeg, gif, svg',
                'blog_description.required' => 'Mô tả bài viết phải có',
                'blog_content.required' => 'Nội dung bài viết phải có',
                'blog_status.required' => 'Trạng thái bài viết phải có',
            ]
        );
        $blog = Blog::find($id);

        $blog->blog_title = $data['blog_title'];
        $blog->blog_slug = $data['blog_slug'];
        $blog->blog_description = $data['blog_description'];
        $blog->blog_content = $data['blog_content'];
        $blog->blog_status = $data['blog_status'];

        $get_image = $request->blog_image;
        if ($get_image) {
            $path = 'public/uploads/blogs/' . $blog->blog_image;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/blogs/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $blog->blog_image = $new_image;
        }
        $blog->save();
        Toastr::success("Cập nhật bài viết thành công", "Thành công");
        return \redirect()->back();
    }
    public function deleteBlog($id)
    {
        $this->isLogin();
        $blog = Blog::find($id);
        $path = 'public/uploads/blogs/' . $blog->blog_image;
        if (file_exists($path)) {
            unlink($path);
        }
        $blog->delete();
        Toastr::success("Xóa bài viết thành công", "Thành công");
        return redirect()->back();
    }
    public function updateBlogStatusHide($id)
    {
        $this->isLogin();
        Blog::where('blog_id', $id)->update(['blog_status' => 0]);
        Toastr::success("Ẩn bài viết thành công", "Thành công");
        return \redirect()->back();
    }

    public function updateBlogStatusDisplay($id)
    {
        $this->isLogin();
        Blog::where('blog_id', $id)->update(['blog_status' => 1]);
        Toastr::success("Hiển thị bài viết thành công", "Thành công");
        return \redirect()->back();
    }
    public function importExcelBlog(Request $request){
        $this->isLogin();
        $path = $request->file('blog_file_import')->getRealPath();
        Excel::import(new BlogImport(), $path);
        Toastr::success('Import dữ liệu thành công', 'Thành công');
        return back();
    }
    public function exportExcelBlog(){
        $this->isLogin();
        return Excel::download(new BlogExport(), 'blog.xlsx');
    }
}
