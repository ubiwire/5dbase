
<div class="well well-small">
    <?php echo $data->contents; ?>
    <?php if (isset($date->file_path)): ?>
        <div claa="image">
            <?php CHtml::image($data->file_path,'image',array("width"=>220,"height"=>150)) ?>
        </div>
    <?php endif ?>
    <div>
        <p class="right">
            <?php echo Yii::t('post', 'post favorite') . "(" . $data->favorite_count . ")" ?>
            <?php echo Yii::t('post', 'post like') . "(" . $data->like_count . ")" ?>
            <?php echo Yii::t('post', 'post comments') . "(" . $data->comments_count . ")" ?>
        </p>
        <div class="clear"></div>
    </div>
</div>
