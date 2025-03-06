<?php

    
function getImageUrl($urlString): String{
    if($urlString == null || empty($urlString)){
        return "./images/profilepic.png";
} else{
    return "./actions/uploads/".$urlString;
}
}


function createPost($post, $userId, $firstname, $lastname, $profilePicture){
    $profilePicture = getImageUrl($profilePicture);
    $id = $post['postID']; 
    $postDate = $post['postDate'];
    $postContent = $post['postContent'];
    $postImage = $post['postImage'];
    $href ="profile.php?userId=".$userId."&firstname=".$firstname."&lastname=".$lastname."&profilePicture=".$profilePicture;
    $deletePostLink = "actions/deletepost.php?postId=".$id."&userId=".$userId;
    $startHtml = '<?php //ALL OF THE POST?>
                    <div class="container"> 
                        <?php //head of the post : user + profile pic ... ?>
                        <div class="post-head">
                    <a href="'.$href.'">
                        <img src="'.$profilePicture.'" alt="" class="logo">
                            </a>
                            <div class="post-infos">
                                <h4>'.$firstname.' '.$lastname.'</h4>
                                <h6>'.$postDate.'</h6>
                            </div>
            
                            <div class="post-param">
                                <img src="images/dots.png" alt="menu" class="inverted-colors">
                                <a href=""><img src="images/close.png" alt="" class="inverted-colors"></a>
                            </div>
                        </div>
                        <p>'.$postContent.'</p> ';

    $endHtml = '<?php //foot of the post : likes comments shares ... ?>
                        <div class="post-footer">
                            <div class="reactions">
                                <div class="likes">
                                   <img src="images/like-blue.png" alt="">
                                   <p></p>
                                </div>
                                <div>
                                  <p> Shares</p>
                                </div>
                            </div>
                            <hr>
                            <div class="button-stack">
                                <div class="post-button">
                                    <img src="images/like.png" alt="" >
                                    <p>Like</p>
                                </div>
                                <div class="post-button">
                                    <img src="images/comment.png" alt="">
                                    <p>Comment</p>
                                </div>
                                <div class="post-button">
                                    <img src="images/share.png" alt="">
                                    <p>Share</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php //ALL OF THE POST?>';

                  // Core of the post : image 
                     if(isset($post["postImage"]) && !empty($post["postImage"])){
                            $midHtml = '<img src=./actions/uploads/'.$postImage.' alt="" class="post-image">';
                            return $startHtml.$midHtml.$endHtml;
                     }else{
                        return $startHtml.$endHtml;
                     }

}