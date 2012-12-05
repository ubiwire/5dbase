
 <div class="well well-small">
            <?php echo $data->contents; ?>
            <div>
                <p class="right">
                    <?php echo Yii::t('post', 'post favorite')."(" . $data->favorite_count . ")" ?>
                    <?php echo Yii::t('post', 'post like')."(" . $data->like_count . ")" ?>
                    <?php echo Yii::t('post', 'post comments')."(" . $data->comments_count . ")" ?>
                </p>
                <div class="clear"></div>
            </div>
        </div>
