

<div wire:ignore>

    <input id="{{ $trixId }}" type="hidden" name="content" value="{{ $value }}">
    <trix-editor wire:ignore input="{{ $trixId }}"></trix-editor>

    
    <script>
        var trixEditor = document.getElementById("{{ $trixId }}")
        addEventListener("trix-blur", function(event) {
            @this.set('value', trixEditor.getAttribute('value'))
        })
    </script>
</div>