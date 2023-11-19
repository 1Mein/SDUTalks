<style>
    #fullscreen {
        display: none;
        position: fixed;
        z-index: 999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        justify-content: center;
        align-items: center;
    }

    #fullscreen img {
        max-width: 100%;
        max-height: 100%;
    }

    #close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        color: #fff;
        cursor: pointer;
    }
</style>
<script>
    function openFullscreen() {
        document.getElementById('fullscreen').style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Запрет прокрутки страницы
    }

    function closeFullscreen() {
        document.getElementById('fullscreen').style.display = 'none';
        document.body.style.overflow = ''; // Разрешение прокрутки страницы
    }
</script>

<img src="{{asset('storage/avatars/'.auth()->user()->avatar)}}" alt="" width="32" height="32" class="rounded-circle me-2" id="thumbnail" onclick="openFullscreen()">

<div id="fullscreen" onclick="closeFullscreen()">
    <span id="close-btn" onclick="closeFullscreen()">Close</span>
    <img src="{{asset('storage/avatars/'.auth()->user()->avatar)}}" alt="">
</div>
