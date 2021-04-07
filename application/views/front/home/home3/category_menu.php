<!-- PAGE -->
<section class="page-section category_menu">
    <div class="container">
        <div class="row main-slider-row flex-no-gutters">
            <div class="col-lg-3 col-xs-12 mt0-sm hidden-md hidden-sm hidden-xs">
                <!-- side bar menu -->
                <div class="sidebar-menu-left">
                    <div class="responsive sidebar-megamenu">
                        <div class="vertical-menu no-gutter">       
                            <nav class="navbar-default">
                                <div class="container-megamenu vertical ">
                                    <div class="vertical-wrapper">
                                        <span id="remove-verticalmenu" class="fa fa-times"></span>
                                        <div class="megamenu-pattern">
                                            <ul class="megamenu">
                                                <?php
                                                    $selected =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 35))->row()->value,true);
                                                    $this->db->where_in('category_id',$selected);
                                                    $categories=$this->db->get('category')->result_array();
                                                    // echo '<br>'.count($categories).'<br>';
                                                    $count = 1;
                                                    foreach($categories as $row){
                                                        if ($count <= 10) {
                                                            if($this->crud_model->if_publishable_category($row['category_id'])){
                                                ?>
                                                <li class="item-vertical style1 with-sub-menu hover category_side_set">
                                                    <p class="close-menu"></p>
                                                    <a href="<?php echo base_url(); ?>home/category/<?php echo $row['category_id']; ?>" class="clearfix ">
                                                        <span>
                                                            <strong> 
                                                                <i class="icon icon1"></i>
                                                                <?php echo $row['category_name']; ?>
                                                             </strong>
                                                         </span> 
                                                         <span class="label"> </span> 
                                                    </a>
                                                    <div class="sub-menu" data-subwidth="100" style="width: 690px; display: none; right: 0px;">
                                                        <div class="content" style="display: none;">
                                                            <div class="row">
                                                                <?php
                                                                    $sub_categories = json_decode($row['data_subdets'],true);
                                                                    if($sub_categories!=NULL){
                                                                ?>
                                                                <div class="col-sm-8">
                                                                    <div class="categories ">
                                                                        <?php
                                                                            $i=0;
                                                                            foreach($sub_categories as $row1){
                                                                                if($i%3==0){
                                                                        ?>
                                                                        <div class="row">
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                            <div class="col-sm-4 static-menu">
                                                                                <?php
                                                                                if($row['digital']!=='ok'){
                                                                                ?>
                                                                                <div class="menu">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <a href="<?php echo base_url(); ?>home/category/<?php echo $row['category_id']; ?>/<?php echo $row1['sub_id']; ?>" class="main-menu">
                                                                                                <?php echo $row1['sub_name'];?>
                                                                                            </a>
                                                                                            <ul>
                                                                                                <?php
                                                                                                $brands=explode(';;;;;;',$row1['brands']);
                                                                                                    foreach($brands as $row2){
                                                                                                        if($row2 !== ''){
                                                                                                            $brand = explode(':::',$row2);
                                                                                                ?>
                                                                                                <li>
                                                                                                    <a href="<?php echo base_url(); ?>home/category/<?php echo $row['category_id']; ?>/<?php echo $row1['sub_id']; ?>-<?php echo $brand[0]; ?>">
                                                                                                        <?php echo $brand[1];?>
                                                                                                    </a>
                                                                                                </li>
                                                                                                <?php
                                                                                                        }
                                                                                                    }
                                                                                                ?>
                                                                                            </ul>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <?php
                                                                                }else{
                                                                                ?>
                                                                                <ul>
                                                                                    <li>
                                                                                        <a href="<?php echo base_url(); ?>home/category/<?php echo $row['category_id']; ?>/<?php echo $row1['sub_id']; ?>" class="main-menu">
                                                                                            <?php echo $row1['sub_name'];?>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                           </div>
                                                                            <?php
                                                                                $i++;
                                                                                if($i%3==0){
                                                                            ?>
                                                                        </div>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        if($i%3!==0){
                                                                            echo '</div>';
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                    }
                                                                ?>
                                                                <div class="col-sm-4 padding-r-0-md">
                                                                    <div class="img-banner">
                                                                        <a href="<?php echo base_url(); ?>home/category/<?php echo $row['category_id']; ?>">
                                                                            <?php
                                                                            if(file_exists('uploads/category_image/'.$row['banner'])){
                                                                            ?>
                                                                            <img class="img-responsive image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/category_image/<?php echo $row['banner']; ?>" alt="banner"/> 
                                                                            <?php
                                                                                } else {
                                                                            ?>
                                                                            <img  class="image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url(); ?>uploads/category_image/default.jpg" />
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                                            }
                                                        }
                                                        $count++;
                                                    }
                                                ?>
                                                <li class="loadmore">
                                                    <a href="<?php echo base_url(); ?>home/all_category">
                                                        <i class="fa fa-plus-square-o"></i>
                                                        <span class="more-view"> 
                                                            <?php echo translate('more_categories');?>
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </nav>  
                        </div>
                    </div>
                </div>
                <!-- /side bar menu -->
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="main-slider">
                    <div class="owl-carousel" id="main-slider">
                        <?php
                        $this->db->order_by("slides_id", "desc");
                        $this->db->where("uploaded_by", "admin");
                        $this->db->where("status", "ok");
                        $slides=$this->db->get('slides')->result_array();
                        $i=1;
                        foreach($slides as $row){
                        ?>
                        <div class="item slide<?php echo $i; ?> alt">
                            <img class="slide-img image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo $this->crud_model->file_view('slides',$row['slides_id'],'100','','no','src','','','.jpg') ?>" alt="" />
                            <div class="caption">
                                <div class="div-table">
                                    <div class="div-cell">
                                        <div class="caption-content">
                                            <p class="caption-text">
                                                <?php if($row['button_text']!=NULL){ ?>
                                                <a class="btn pull-right" style="background:<?php echo $row['button_color']; ?>; color:<?php echo $row['text_color']; ?>" href="<?php echo $row['button_link']; ?>">
                                                    <?php echo $row['button_text']; ?>
                                                </a>
                                                <?php } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            $i++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->

<script>
    $(document).ready(function(){
        $('.category_side_set').each(function(){
            var obj = $(this);
            var childPos = obj.offset();
            var parentPos = obj.parent().offset();
            var reduce_top = childPos.top - parentPos.top;
            obj.find('.sub-menu').css('top','-'+reduce_top+'px');
        });
    });
</script>
