<?php if((int) $printedly_user_id): ?>
<printedly-quote shop="<?= (int) $printedly_user_id ?>" product="">loading</printedly-quote>
<? else: ?>
<a href="<?php echo admin_url() ?>admin.php?page=printedly">Error your store is not connected yet. Please click here to connect<a/>
<? endif; ?>
