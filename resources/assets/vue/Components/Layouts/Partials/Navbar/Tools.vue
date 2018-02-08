<template>
    <ul class="nav navbar-toolbar">
        <li class="nav-item hidden-float" id="toggleMenubar">
            <a class="nav-link" data-toggle="menubar" href="#" role="button">
                <i class="icon hamburger hamburger-arrow-left">
                    <span class="sr-only">Toggle menubar</span>
                    <span class="hamburger-bar"></span>
                </i>
            </a>
        </li>

        <li class="nav-item hidden-sm-down" id="toggleFullscreen">
            <a class="nav-link fas fa-expand-arrows-alt" data-toggle="fullscreen" href="#" role="button">
                <span class="sr-only">Toggle fullscreen</span>
            </a>
        </li>
    </ul>
</template>

<script>
    export default {}
</script>