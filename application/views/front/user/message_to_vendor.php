<div id="window">
    <div class="information-title">
        <?php echo translate('support_ticket');?>
    </div>
    <div class="details-wrap">
        <div class="row">
            <div class="col-md-12">
                <div class="tabs-wrapper content-tabs">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab">
                                <?php echo translate('all_messages');?>
                            </a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab">
                                <?php echo translate('create_new_meassage');?>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1">
                            <div class="wishlist tickets">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo translate('ticket_subject');?></th>
                                            <th><?php echo translate('options');?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="result6">
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" id="page_num6" value="0" />

                            <div class="pagination_box">

                            </div>

                            <script>
                                function message_to_seller_listed(page){
                                    if(page == 'no'){
                                        page = $('#page_num6').val();
                                    } else {
                                        $('#page_num6').val(page);
                                    }
                                    var alerta = $('#result6');
                                    alerta.load('<?php echo base_url();?>home/message_to_seller_listed/'+page,
                                        function(){
                                            //set_switchery();
                                        }
                                    );
                                }
                                $(document).ready(function() {
                                    message_to_seller_listed('0');
                                });

                            </script>
                        </div>
                        <div class="tab-pane fade" id="tab2">
                            <div class="row">
								<?php
                                    echo form_open(base_url() . 'home/new_message_to_seller/', array(
                                        'class' => 'form-login',
                                        'method' => 'post',
                                        'id' => 'add_new_message_to_seller',
                                        'enctype' => 'multipart/form-data'
                                    ));
                                ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="form-control selectpicker" name="seller_id" data-placeholder="<?php echo translate('Choose a Seller') ?>" required>
                                                <option value=""><?php echo translate('Choose a Seller') ?></option>
                                                <?php
                                                    $sellers = $this->db->get_where('vendor', array('status' => 'approved'))->result_array();
                                                    foreach ($sellers as $seller) {
                                                        if(isset($seller_id)){ ?>
                                                            <option value="<?php echo $seller['vendor_id']; ?>" <?php if($seller_id == $seller['vendor_id']) { echo "selected"; }  ?>><?php echo $seller['display_name']; ?></option>
                                                        <?php } else {?>
                                                            <option value="<?php echo $seller['vendor_id']; ?>"><?php echo $seller['display_name']; ?></option>

                                                        <?php }?>
                                                    <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        	<input class="form-control" name="sub" type="text" placeholder="<?php echo translate('subject');?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="sr-only">
											<?php echo translate('comment');?> *
                                        </label>
                                        <textarea maxlength="5000" rows="10" class="form-control" name="reply" id="comment" style="height: 138px;" placeholder="<?php echo translate('message');?> *" required></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <span class="btn btn-theme-dark btn-icon-right pull-right submit_button enterer" onclick="form_submit('add_new_message_to_seller');" data-ing="<?php echo translate('creating...'); ?>" data-success="<?php echo translate('ticket_created_successfully'); ?>!" data-unsuccessful="<?php echo translate('ticket_creation_unsuccessful'); ?>!" data-redirectclick="#ticket" >
                                        	<?php echo translate('create'); ?>
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$('body').on('click','.message_to_vendor_view',function(){
		var id = $(this).data('id');
		$("#window").load("<?php echo base_url()?>home/profile/message_to_vendor_view/"+id);
	});

</script>
