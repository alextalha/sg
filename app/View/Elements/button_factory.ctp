<div id='<?php $id = (isset($id)?$id:''); echo $id; ?>' class='btn_box'><i class='fa fa-<?php echo $icon_name; ?> fa-stack-1x' style='position: relative; color: <?php $color_icon = (isset( $color_icon ) ? $color_icon:'#888888'); echo $color_icon; ?>; font-size: 14px;'></i><div class="btn-text" style='position: relative; width: 100%; color: <?php $color_text = (isset( $color_text ) ? $color_text:'#888888'); echo $color_icon; ?>; font-size: 12px; bottom: <?php $text_bottom = (isset($text_bottom) ? $text_bottom : 0); echo $text_bottom; ?>px;'><?php echo $text; ?></div></div>