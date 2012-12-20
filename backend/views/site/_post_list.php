
<div class="well well-small">
    <?php echo $data->contents; ?>
    <?php if (isset($data->file_path)): ?>
        <div class="image">
            <?php echo CHtml::image(Yii::app()->baseUrl . '/assets/uploads/posts/' . $data->file_path,'image',array("width"=>120)) ?>
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
