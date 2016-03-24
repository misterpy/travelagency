<?php
/** 
  * Show the Member
  *   
  * @example
  * [member name="Your Name" role="Role" img="you image" twitter="your twitter account" facebook="your facebook account" google="your google account" tumblr="your tumblr account" mail="yourmail]your content[/member]
  *  
**/

function df_member_sc( $atts, $content = null) {
    extract( shortcode_atts( array(
        'styles'    => 'style1',
        'img'       => '',
        'name'      => '',
        'role'      => '',
        'twitter'   => '',
        'facebook'  => '',
        'google'    => '',
        'linkedin'  => '',
        'mail'      => '',
        'link'      => '',
    ), $atts));
 
      $output_img     = '';
      $output_img_el  = '';
      $img            = explode( ',', $img );
      $i              = -1;  

        foreach ( $img as $attach_id ) {
            $i++;
            $image_src  = wp_get_attachment_image_src( $attach_id, 'thumbnail-gallery-grid' );
            $output_img .= $image_src[0];
        }
      
        if( $output_img == '') {
            $return = "<a href='".$link."'><img src=".get_template_directory_uri().'/includes/images/presets/post-formats/big/image.jpg'." alt='image'></a>"; 
        } else {
            $return = "<a href='".$link."'><img src='".$output_img."' alt='image' /></a>";
        }
        if( $twitter != '' || $facebook != '' || $google != ''  || $mail != '' || $linkedin != '' ){
            $return7 = '<div class="member-social"><ul class="df-social-connect">';
            $return8 = '</ul></div>';
        
            if($twitter != '') {
                $return2 = '<li><a href="' .$twitter. ' " class="twitter" target="_blank" title="Twitter"><i class="fa-twitter fa"></i><i class="fa-twitter fa"></i></a></li>';
            } else {
                $return2 = ''; 
            }
            
            if($facebook != '') {
                $return3 = '<li><a href="' .$facebook. ' " target="_blank" class="facebook" title="Facebook"><i class="fa-facebook fa"></i><i class="fa-facebook fa"></i></a></li>';
            } else {
                $return3 = ''; 
            }
         
            if($google != '') {
                $return4 = '<li><a href="' .$google. ' " target="_blank" class="google-plus" title="Google+"><i class="fa-google-plus fa"></i><i class="fa-google-plus fa"></i></a></li>';
            } else {
                $return4 = ''; 
            }
            
            if($mail != '') {
                $return6 = '<li><a href="mailto:' .$mail. ' " class="mail-to" title="Mail"><i class="fa-envelope-o fa"></i><i class="fa-envelope-o fa"></i></a></li>';
            } else {
                $return6 = ''; 
            }

            if($linkedin != '') {
                $return9 = '<li><a href="' .$linkedin. ' " target="_blank" class="linkedin" title="Linkedin"><i class="fa fa-linkedin"></i><i class="fa fa-linkedin"></i></a></li>';
            } else {
                $return9 = ''; 
            }
        }  else {
          $return2 = $return3 = $return4 = $return6 = $return7 = $return8 = $return9 = '';
        }

        if ($styles == 'style1') {
            $class = ' style1';
            $member_content = ''. $return7. '' .$return2. '' .$return3. '' .$return4. '' .$return9. '' .$return6. '' .$return8.'';

        } else if($styles == 'style2') {
            $class = ' style2';
            $content_member = '';
            if (do_shortcode($content) != '') {
              $content_member = ' <p class="member-content">' . do_shortcode($content) . '</p>';
            }
            $member_content = $content_member .$return7. '' .$return2. '' .$return3. '' .$return4. '' .$return9. '' .$return6. '' .$return8.'';

        } else if($styles == 'style3') {
            $class = ' style3';
            $content_member = '';
            if (do_shortcode($content) != '') {
              $content_member = ' <p class="member-content">' . do_shortcode($content) . '</p>';
            }
            $member_content = $content_member .$return7. '' .$return2. '' .$return3. '' .$return4. '' .$return9. '' .$return6. '' .$return8.'';

        }

        $out = '<div class="member'.$class.'">
                  <div class="member-image">' .$return. '</div>
                  <div class="member-desc-inner"></div>
                  <div class="member-desc-warp">
                      <h3 class="title-sc member-name"><a href="'.$link.'">' .$name. '</a></h3>
                      <p class="member-role">' .$role. '</p>
                     '.$member_content.'
                  </div>
                </div>';

      return $out;
}
add_shortcode('member', 'df_member_sc');