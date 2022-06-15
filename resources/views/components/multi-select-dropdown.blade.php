@props(['placeholder'=>'','name'=>''])
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<select class="select" name="{{ $name }}" placeholder="{{ $placeholder }}" multiple>
    {{ $slot }}
</select>
<script>
    $(document).ready(function() {
    $('.select').select2({
        placeholder: '{!! $placeholder !!}',
        width: '100%',
    });
});
</script>
<style>
    .select2-container {
        margin-top: 4px;
        font-size: 14px;
        line-height: 20px;
    }

    .select2-container--default .select2-selection--multiple {
        border: 1px solid rgb(209, 213, 219, 1);
        padding-bottom: 7px;
        padding-top: 2px;
        padding-left: 8px;
        border-radius: 6px;
        min-height: 37px;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border: solid rgb(180, 198, 252, 1) 1px;
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
        --tw-ring-color: rgb(205, 219, 254,.5);
        border-radius: 6px;
    }
</style>