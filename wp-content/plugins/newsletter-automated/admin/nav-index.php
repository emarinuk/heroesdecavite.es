<?php

?>
<ul class="tnp-nav">
    <li class="<?php echo $_GET['page'] === 'newsletter_automated_index'?'active':''?>"><a href="?page=newsletter_automated_index"><?php esc_html_e('Channels', 'newsletter')?></a></li>
    <li class="<?php echo $_GET['page'] === 'newsletter_automated_settings'?'active':''?>"><a href="?page=newsletter_automated_settings"><?php esc_html_e('Settings', 'newsletter')?></a></li>
</ul>
