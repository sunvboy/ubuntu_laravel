<div class="form-check form-switch form-switch-lg">
    <input <?php echo ($v->$title == 0) ? 'checked=""' : ''; ?> class="form-check-input publish-ajax" type="checkbox" data-module="{{$module}}" data-id="<?php echo $v->id; ?>" data-title="{{$title}}" id="{{$title}}-<?php echo $v->id; ?>">
</div>