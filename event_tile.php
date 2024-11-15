
    <div class="event-tile">
        <div class="event-image" style="background-image: url('images/banners/<?php echo $currentrow['banner_img']?>');"></div>
        <div class="event-content">
            <div class="event-title"><?php echo $currentrow['event_name']?></div>
            <div class="event-details">
                <div>
                    <?php echo date('D, M j', strtotime($currentrow['event_date'])); ?> • <?php echo date('g:ia', strtotime($currentrow['start_time'])); ?>
                </div>

                <div><?php echo $currentrow['location'] ?></div>
            </div>
        </div>
    </div>