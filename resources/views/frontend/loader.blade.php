<style>
    /*utils*/
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap');
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', sans-serif;
    }

    /*use flexbox to centered element*/
    div.wrapper {
        width: 100%;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    h1.brand {
        font-size: 40px;
    }

    h1.brand span:nth-child(1) {
        background-color: transparent;
        color: #0074b4;
    }

    h1.brand span:nth-child(2) {
        background-color: #0074b4;
        color: #f3f2ef;
        padding: 0px 6px;
        margin-left: -6px;
        border-radius: 2px;
    }

    div.loading-bar {
        width: 130px;
        height: 2px;
        background-color: #d6cec2;
        border-radius: 10px;
        margin-top: 15px;
        overflow: hidden;
        position: relative;
    }

    div.loading-bar::after {
        content: '';
        width: 50px;
        height: 2px;
        position: absolute;
        background-color: #0074b4;
        transform: translateX(-20px);
        animation: loop 2s ease infinite;
    }

    .loader{
        position: fixed;
        background: #fff;
        z-index: 999;
        width: 100%;
        top: 0;
    }

    @keyframes loop {

        0%,
        100% {
            transform: translateX(-28px);
        }

        50% {
            transform: translateX(100px)
        }
    }
</style>




<!--just for centered element-->
<div class="loader">
    <div class="wrapper">
        <h1 class="brand">
            <span>mechcareer</span>
        </h1>
        <div class="loading-bar"></div>
    </div>
</div>
