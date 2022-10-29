<form action="{{ route('mobileverification') }}" name="add_redirect" method="POST">
    @csrf
    <input type="hidden" name="user_identity" value="{{ $userId }}">
    <button type="submit" style="opacity:0" id="add_redirect" sty class="btn btn-primary">submit</button> <br />
</form>

<script>
    window.onload = function() {
        document.forms['add_redirect'].submit();
    }
</script>
