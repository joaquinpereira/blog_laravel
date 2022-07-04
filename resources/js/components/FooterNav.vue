<template>
    <nav>
        <ul class="container-flex space-center list-unstyled">
            <li><router-link :to="{ name:'home' }" class="text-uppercase c-white">Inicio</router-link></li>
            <li><router-link :to="{ name:'about' }" class="text-uppercase c-white">Nosotros</router-link></li>
            <li><router-link :to="{ name:'archive' }" class="text-uppercase c-white">Archivo</router-link></li>
            <li><router-link :to="{ name:'contact' }" class="text-uppercase c-white">Contacto</router-link></li>
        </ul>

        <div class="divider-2"></div>
        <p>Nunc placerat dolor at lectus hendrerit dignissim. Ut tortor sem, consectetur nec hendrerit ut, ullamcorper ac odio. Donec viverra ligula at quam tincidunt imperdiet. Nulla mattis tincidunt auctor.</p>
        <div class="divider-2" style="width: 80%;"></div>
        <p>© 2017 - Zendero. All Rights Reserved. Designed & Developed by <span class="c-white">Agencia De La Web</span></p>
    </nav>
</template>