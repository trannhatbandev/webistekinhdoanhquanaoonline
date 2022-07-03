<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CommentController extends Controller
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
     public function showComment(Request $request)
    {

        $product_id = $request->product_id;

        $comment = Comment::where('product_id',$product_id)->where('comment_status','1')->get();

        $html = '';

        foreach($comment as $value){
            if($value->rep_comment == 0){
                $html .= '<div>
                <span>Ngày giờ: '.$value->comment_date.'</span></div>
                <div class="review-title">
                Tên:<span> '.$value->comment_name.'</span>
                <span> - Bình luận: '.$value->comment.'</span></div>';
            }
            foreach($comment as $repComment){
                if($repComment->rep_comment == $value->comment_id){
                    $html .=  '<div style="margin-left:10px; background:aqua">
                    <span>Ngày giờ: '.$repComment->comment_date.'</span></div>
                    <div class="review-title" style="margin-left:10px">
                    Admin:<span> '.$repComment->comment_name.'</span>
                    <span> - Bình luận: '.$repComment->comment.'</span></div>';
                }
            }
        }
        echo $html;
    }
    public function addComment(Request $request){
        $this->isLogin();
        $product_id = $request->product_id;
        $comment_area = $request->comment_area;

        $comment = new Comment();

        $comment->comment = $comment_area;
        $comment->comment_name = session()->get('customer_name');
        $comment->product_id = $product_id;
        $comment->customer_id = session()->get('customer_id');
        $comment->comment_status = 1;
        $comment->rep_comment = 0;
        $comment->save();

    }
    public function showListComment(){
        $this->isLogin();
        $comment = Comment::orderBy('comment_id','DESC')->get();
        return view('admin.comment.show_list_comment')->with(compact('comment'));
    }
    public function noAcceptComment($id)
    {
        $this->isLogin();
        Comment::where('comment_id',$id)->update(['comment_status'=>0]);
        Toastr::success("Không duyệt bình luận này","Thành công");
        return \redirect()->back();
    }
    public function acceptComment($id)
    {
        $this->isLogin();
        Comment::where('comment_id',$id)->update(['comment_status'=>1]);
        Toastr::success("Duyệt bình luận này","Thành công");
        return \redirect()->back();
    }
    public function replyComment(Request $request)
    {
        $this->isLogin();
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->product_id = $data['product_id'];
        $comment->customer_id = session()->get('admin_id');
        $comment->comment_status = 1;
        $comment->comment_name = 'SHOP TNB';
        $comment->rep_comment = $data['comment_id'];

        $comment->save();
    }

}
