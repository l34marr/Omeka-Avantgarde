<?php
$collectionTitle = strip_formatting(metadata('collection', array('Dublin Core', 'Title')));
$totalItems = metadata('collection', 'total_items');
?>

<?php echo head(array('title'=> $collectionTitle, 'bodyclass' => 'collections show')); ?>

<h1><?php echo $collectionTitle; ?></h1>

<section id="collection-items-primary">
<?php echo all_element_texts('collection'); ?>
</section>

<section id="collection-items-secondary">
    <?php if (metadata('collection', 'total_items') > 0): ?>
        <?php foreach (loop('items') as $item): ?>
    <div class="collection-items-puce">
        <?php $itemTitle = strip_formatting(metadata('item', array('Dublin Core', 'Title'))); ?>
            <?php if (metadata('item', 'has thumbnail')): ?>
            <div class="collection-items-img">
                <?php echo link_to_item(item_image('square_thumbnail', array('alt' => $itemTitle, 'width' => '100px'))); ?>
            </div>
            <?php endif; ?>

        <div class="collection-items-data">
            <h3><?php echo link_to_item($itemTitle, array('class'=>'permalink')); ?></h3>

            <?php if ($text = metadata('item', array('Item Type Metadata', 'Text'), array('snippet'=>250))): ?>
            <div class="item-description">
                <p><?php echo $text; ?></p>
            </div>
            <?php elseif ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
            <div class="item-description">
                <?php echo $description; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p><?php echo __("There are currently no items within this collection."); ?></p>
    <?php endif; ?>
<!-- end collection-items -->
    <div id="collection-items-link"><?php echo link_to_items_browse(__('檢視所有合集單件', $collectionTitle), array('collection' => metadata('collection', 'id'))); ?> <?php echo __('(%s total)', $totalItems); ?></div>
</section>

<?php fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>

<?php echo foot(); ?>
