<?php if($properties->count()): ?>
    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

        <?php echo $__env->make('home.partials.property', ['class' => 'col-md-6 col-sm-12 items-grid'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
<?php endif; ?>
<?php if($markers): ?>
    <script type="text/javascript">
        var markers = [<?php $__currentLoopData = $markers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marker): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>[<?php echo e($marker['geo_lon']); ?>, <?php echo e($marker['geo_lat']); ?>], <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>],
                infoWindowContent = [<?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>[{"id" : "<?php echo e($property->id); ?>","alias":"<?php echo e($property->alias); ?>","name":<?php echo json_encode($property->contentload->name); ?>,"address":"<?php echo e($property->location['address']); ?>" ,"city":"<?php echo e($property->location['city']); ?>" ,"country":"<?php echo e($property->location['country']); ?>" ,"phone":"<?php echo e($property->contact['tel1']); ?>", "icon":"<?php echo e($property->category->map_icon); ?>", "featured":"<?php echo e($property->featured); ?>", "image":<?php if(count($property->images)): ?>"<?php echo e($property->images[0]->image); ?>" <?php else: ?> "no_image.jpg" <?php endif; ?>}], <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>];
        for(var i = 0; i < markers.length; i++ ) {
            addMarkerToMap(markers[i][0], markers[i][1], infoWindowContent[i], 'property');
        }
    </script>
    <?php endif; ?>
