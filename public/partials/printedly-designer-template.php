<?php if((int) $printedly_user_id): ?>
<div id="printedly" style="text-align:center; min-height: 740px;"></div>
<script>var printedly = printedly_embed('printedly', <?= (int) $printedly_user_id ?>);</script>
<? else: ?>
<a href="<?php echo admin_url() ?>admin.php?page=printedly">Error your store is not connected yet. Please click here to connect<a/>
<? endif; ?>
