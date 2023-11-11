<div class="lds-ripple-container" style="position: fixed;width: 100%;height: 100%;background: #2125297a;z-index: 999999999999;top: 0;left: 0px;">
    <div class="lds-ripple">
        <div></div>
        <div></div>
    </div>
</div>
<style>
    .lds-ripple {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
        position: absolute;
        top: 50%;
        left: 50%;
    }

    .lds-ripple div {
        position: absolute;
        border: 4px solid #fff;
        opacity: 1;
        border-radius: 50%;
        animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
    }

    .lds-ripple div:nth-child(2) {
        animation-delay: -0.5s;
    }

    @keyframes lds-ripple {
        0% {
            top: 36px;
            left: 36px;
            width: 0;
            height: 0;
            opacity: 0;
        }

        4.9% {
            top: 36px;
            left: 36px;
            width: 0;
            height: 0;
            opacity: 0;
        }

        5% {
            top: 36px;
            left: 36px;
            width: 0;
            height: 0;
            opacity: 1;
        }

        100% {
            top: 0px;
            left: 0px;
            width: 72px;
            height: 72px;
            opacity: 0;
        }
    }
</style>
<style>
    .main-out-list .card-body table tr td {
        text-align: center;
        padding: 5px;
        text-transform: none !important;
        font-size: 13px !important;
        line-height: 18px;
    }

    .main-out-list .card-body table tr td:nth-child(2) {
        text-align: left;
    }

    .main-content-list-month .card-body-22 .table-responsive {
        overflow-x: auto;
    }

    .main-content-list-month .card-body-22 td {
        font-size: 13px;
        border: 1px solid #aee1dd;
        padding: 5px;
    }

    .main-content-list-month .card-body-22 .text-muted td {
        font-weight: bold;
        font-size: 13px;
        font-family: roboto;
        text-transform: none !important;
        line-height: 16px;
        color: #08681f;
    }

    .text-muted {
        background: yellow;
    }

    textarea:focus,
    input:focus {
        outline: none;
    }
</style>