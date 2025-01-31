<style>
.img-thumbnail{
    width:100px;
    height:100px;
    cursor:pointer;
    object-fit: cover;
}
.file-icon{
    display: flex;
    font-size: 85px;
    justify-content: center;
}
.btn-light {
    color: #cccccc !important;
}
.btn-light:focus, .btn-light:hover {
    background-color: #EEE !important;
    box-shadow: 0 0px 0px 0px rgba(0,0,0,.1),0 0px 0px 0 rgba(0,0,0,.1),0 0px 0px 0px rgba(0,0,0,.1) !important;
    color: #9e9e9e !important;
}
.mc-ul li{
    position: relative;
}
.mc-ul li:hover .remove_media_display{
    display: block;
}
.mc-ul li:hover .tools{
    display: flex!important;
}
.remove_media_display{
    position: absolute;
    display: none;
    cursor: pointer;
    opacity: 0.9;
    border-radius: 0 0 0 5px;
    top: 0;
    z-index: 999;
    right: 0;
    background: red;
    color: #fff !important;
    padding: 2px 6px;
}
.tools{
    position: absolute;
    display: none !important;
    bottom: 0;
    width: 100%;
    height: 25px;
    z-index: 999;
}
.tools a{
    opacity: 0.7;
    background: #FFFFFF;
    cursor: pointer;
    display: block;
    width: 50%;
    line-height: 1.5;
    text-align: center;
}
.tools a:hover{
    opacity: 0.9;
    color: #606060 !important;
}
/*
.select2-container {
    display: flex;
}*/
</style>

<div class="{{$viewClass['form-group']}} {{ $class }}">

    <label for="{{$column}}" class="{{$viewClass['label']}} control-label">{!! $label !!}</label>

    <div class="{{$viewClass['field']}}">
        @include('admin::form.error')
        <div class="input-group" id="mediaSelector">
            <input type="text" class="form-control" id="{{ $name }}" readonly>
            <div class="input-group-append">
                <div class="btn btn-info" id="uploadBtn">
                    <i class="feather icon-upload"></i> &nbsp;
                    {{Jyounglabs\MediaCenterServiceProvider::trans('media.upload')}}</div>
            </div>
            <div class="input-group-append" style="margin-left:5px;" {!! $attributes !!}>
            </div>
            <div class="input-group-append">
                {!! $dialog !!}
            </div>
        </div>
        <input type="hidden" class="form-control" name="{{ $name }}" value="{{$value}}" id="field_{{ $name }}">
        @include('admin::form.help-block')
        <ul class="d-flex flex-wrap list-inline help-block field_{{$name}}_display mc-ul">
        </ul>
    </div>
</div>

<script require="@mselector" init="{!! $selector !!}">
    var dialogId = $('{!! $dialogSelector !!}').attr('id');

    (function( $ ){
        $(function() {
            var defaults = {!! $options !!};
            var options = {
                fieldId: '{{ $name }}',
                fieldVal: '{!! $value !!}',
                uploader: {
                    pick: {
                        id: '#uploadBtn',
                        label: '<i class="feather icon-upload"></i>&nbsp;上传',
                        style: "",
                    },
                    formData: {
                        _token: '{{csrf_token()}}'
                    },
                },
                selector: {
                    dialog: '[data-id="' + dialogId + '"]',
                    dialogId: dialogId,
                    @if(isset($max))
                    multiple: true,
                    max: {{ $max }},
                    @endif
                }
            };
            var setting = $.extend({}, defaults, options);
            var mc_selector = new MCSelector(setting);
            mc_selector.build();
        });
    })( jQuery );
</script>
