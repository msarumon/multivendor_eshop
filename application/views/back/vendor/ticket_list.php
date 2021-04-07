    <div class="panel-body" id="demo_s">
        <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,2" data-show-toggle="true" data-show-columns="false" data-search="true" >

            <thead>
                <tr>
                    <th><?php echo translate('no');?></th>
                    <th><?php echo translate('from');?></th>
                    <th><?php echo translate('subject');?></th>
                    <th><?php echo translate('date');?></th>
                    <th class="text-right"><?php echo translate('options');?></th>
                </tr>
            </thead>

            <tbody >
            <?php
                $i = 0;
                foreach($message_threads as $row){
                    $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
					<?php
						$from = json_decode($row['sender'],true);
						if($from['type'] == 'user'){
					?>
                    <a class="btn btn-mint btn-xs btn-labeled fa fa-location-arrow" data-toggle="tooltip"
                    onclick="ajax_modal('view_user','<?php echo translate('view_profile'); ?>','<?php echo translate('successfully_viewed!'); ?>','user_view','<?php echo $from['id']; ?>')" data-original-title="View" data-container="body">
                    	<?php echo $this->db->get_where('user',array('user_id'=>$from['id']))->row()->username; ?>
                    </a>
                    <?php
						} else {
					?>
            			<?php echo translate('vendor');?>
                    <?php
						}
					?>
                </td>
                <td>
					<?php echo $row['subject'] .'    '; ?>
                    <?php
						$num = $this->crud_model->message_to_vendor_unread_messages($row['message_thread_id'],'seller');
						if($num > 0){
					?>
					<span class="btn btn-mint btn-xs btn-labeled " style="margin:2px; margin-left:10px;"><?php echo translate('new').' '.'('.' ';
					echo $num .' '.')'; ?></span>
					<?php
						}
					?>
                </td>
                <td><?php echo date('d M,Y h:i:s',$row['time']); ?></td>
                <td class="text-right">
                    <a class="btn btn-info btn-xs btn-labeled fa fa-location-arrow" data-toggle="tooltip"
                        onclick="ajax_set_full('view','<?php echo translate('view_contact_ticket'); ?>','<?php echo translate('successfully_viewed!'); ?>','contact_ticket_view','<?php echo $row['message_thread_id']; ?>'); proceed('to_list');"
                            data-original-title="Edit" data-container="body">
                                <?php echo translate('view_ticket');?>
                    </a>
                    <a onclick="delete_confirm('<?php echo $row['message_thread_id']; ?>','<?php echo translate('really_want_to_delete_this?'); ?>')" class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip"
                        data-original-title="Delete" data-container="body">
                            <?php echo translate('delete');?>
                    </a>
                </td>
            </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
    </div>

    <div id='export-div'>
        <h1 style="display:none;"><?php echo translate('ticket'); ?></h1>
        <table id="export-table" data-name='ticket' data-orientation='l' style="display:none;">
                <thead>
                    <tr>
                        <th><?php echo translate('no');?></th>
                    	<th><?php echo translate('from');?></th>
                    	<th><?php echo translate('subject');?></th>
                    	<th><?php echo translate('date');?></th>
                    	<th class="text-right"><?php echo translate('options');?></th>
                    </tr>
                </thead>

                <tbody >
                <?php
                    $i = 0;
                    foreach($message_threads as $row){
                        $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                <td><?php echo $row['sender']; ?></td>
                <td><?php echo $row['subject']; ?></td>
                <td><?php echo date('d M,Y h:i:s',$row['time']); ?></td>
                </tr>
                <?php
                    }
                ?>
                </tbody>
        </table>
    </div>
