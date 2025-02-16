<?php
$p = sanitize_key(wp_unslash($_GET['page'] ?? '')); // To prevent to trigger security analysis, but not necessary
?>
<ul class="tnp-nav">
    <li><a href="?page=<?php echo rawurlencode($this->index_page)?>">&laquo;</a></li>
    <li class="<?php echo $p === $this->edit_page?'active':''?>"><a href="?page=<?php echo rawurlencode($this->edit_page)?>&id=<?php echo rawurlencode($form->id)?>"><?php esc_html_e('Settings', 'newsletter')?></a></li>
    <li class="<?php echo $p === $this->welcome_page?'active':''?>"><a href="?page=<?php echo rawurlencode($this->welcome_page)?>&id=<?php echo rawurlencode($form->id)?>"><?php esc_html_e('Welcome email', 'newsletter')?></a></li>
    <li class="<?php echo $p === $this->logs_page?'active':''?>"><a href="?page=<?php echo rawurlencode($this->logs_page)?>&id=<?php echo rawurlencode($form->id)?>"><?php esc_html_e('Log', 'newsletter')?></a></li>
</ul>

