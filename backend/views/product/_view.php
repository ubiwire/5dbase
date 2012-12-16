
<div class="thumbnail" style="height: 320px;float: left;line-height: 1;width: 23%;min-height: 28px;box-sizing: border-box;margin: 5px;">
    <?php echo CHtml::image(Yii::app()->baseUrl . '/assets/uploads/products/' . $data->original_pic_path, '', array('style' => "width:140px;")) ?>
    <div class="caption">
        <h5> <?php echo CHtml::encode($data->name); ?></h5>
        <p class="small-font" >
            <?php
            mb_internal_encoding("UTF-8");
            $str = $data->descriptor;
            if (strlen($str) > 40) {
                echo mb_substr($str, 0, 40) . "...";
            } else {
                echo $str;
            }
            ?>
        </p>
        <p>
        <?php echo CHtml::link(Yii::t('default', 'Detail'), array('view', 'id' => $data->id), array('class' => 'btn btn-primary btn-small')); ?>
        </p>
    </div>
</div>
