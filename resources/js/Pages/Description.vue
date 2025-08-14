<script setup>
import { ref, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    address: String,
    satelliteImageUrl: String,
    averageReductionPercent: Number,
    finalValue: Number,
    taxRate: Number,
    parcel: String,
    potentialReduction: Object,
    potentialSavings: Object,
    hashCode: String,
});

const formattedPrice = (price) => {
    return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(price);
}

const handleContinueClick = (hashCode) => {
    console.log(hashCode);
    const url = `https://customerportal.texasprotax.com/Neighborhood/${hashCode}`;
    window.location.href = url;
}

</script>
<script>
export default {
    data() {
        return {
            loading: true,
            totalSegments: 10,
            filledSegments: 0,
            matrixInterval: null,
            barInterval: null
        }
    },
    mounted() {
        // Start Matrix background
        this.startMatrixEffect()

        // Start loading bar animation
        this.barInterval = setInterval(() => {
            this.filledSegments = (this.filledSegments + 1) % (this.totalSegments + 1)
        }, 250)

        // Stop loader after 5 seconds
        setTimeout(() => {
            this.loading = false
            clearInterval(this.barInterval)
            clearInterval(this.matrixInterval)
        }, 5000)
    },
    methods: {
        startMatrixEffect() {
            const canvas = document.querySelector('.matrix-bg');
            const ctx = canvas.getContext('2d');
            function resizeCanvas() {
                canvas.height = window.innerHeight;
                canvas.width = window.innerWidth;
            }
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);

            const binary = ['0', '1'];
            const fontSize = 12;
            let columns = Math.floor(canvas.width / fontSize);
            let drops = Array(columns).fill(1);

            function draw() {
                ctx.fillStyle = 'rgba(0, 0, 139, 0.05)'; // dark blue fade
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                ctx.font = fontSize + 'px monospace';
                ctx.fillStyle = 'white'; // white binary text

                for (let i = 0; i < drops.length; i++) {
                    const text = binary[Math.floor(Math.random() * binary.length)];
                    ctx.fillText(text, i * fontSize, drops[i] * fontSize);
                    if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                        drops[i] = 0;
                    }
                    drops[i]++;
                }
            }
            setInterval(draw, 35);
        }
    }
}
</script>
<style>
.container-custom {
    width: 100%;
    max-width: 1381px;
    padding: 0px 15px;
    margin: 0 auto;
}

.footer-top .footer-col.footer-left .logo a {
    display: inline-block;
}

.desc-results-page nav.navbar #collapsibleNavbar {
    justify-content: flex-end;
}

.desc-results-page nav.navbar #collapsibleNavbar #menu-main-menu {
    gap: 20px;
    align-items: center;
}

.desc-results-page nav.navbar #collapsibleNavbar #menu-main-menu li.nav-item {
    padding-left: 11px;
    padding-right: 11px;
}

.desc-results-page nav.navbar #collapsibleNavbar #menu-main-menu li.nav-item a {
    font-size: 16px;
    color: #000000;
    text-decoration: none;
    font-weight: 500;
}

.desc-results-page nav.navbar #collapsibleNavbar #menu-main-menu li.nav-item.login a {
    background: #0A1475;
    border: 1px solid #0A1475;
    border-radius: 5px;
    height: 47px;
    margin: auto;
    padding: 5px 33px;
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.desc-results-page nav.navbar #collapsibleNavbar #menu-main-menu li.nav-item.signup a {
    background: #ffffff;
    border: 1px solid #ffffff;
    border-radius: 5px;
    height: 47px;
    margin: auto;
    padding: 5px 33px;
    color: #0A1475;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.hp-design p.sub-title {
    color: #0a1475;
    font-size: 16px;
    text-align: center;
    font-weight: 600;
}

.hp-design p.sub-title img {
    margin-right: 4px;
}

.hp-design h1 {
    font-family: 'Poppins', Helvetica, Arial, Lucida, sans-serif;
    font-weight: 700;
    font-size: 50px;
    color: #030303 !important;
    line-height: 60px;
    text-align: center;
}

.banner-content {
    padding-top: 180px;
    padding-bottom: 109px;
    background: linear-gradient(171.15deg, #EAECFD 50%, #FFFFFF 95.27%);
    overflow: hidden;
    width: 100%;
    max-width: 100%;
}

.banner-content::before {
    content: '';
    position: absolute;
    top: -17%;
    left: 0;
    width: calc(100% + 350px);
    height: calc(100% + 20%);
    background: url(/public/img/pattern-banner.svg) no-repeat top center;
    background-size: auto;
    z-index: 1;
    pointer-events: none;
    animation: skewTranslateLoop 18s ease-in-out infinite alternate;
    transform-origin: center;
    opacity: 0.7;
}

.desc-results-page header {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    z-index: 999;
}

.dr-box {
    background: #F5F6FF;
    border-radius: 10px;
    padding: 51px 49px;
    position: relative;
    z-index: 99;
}

.banner-content {
    position: relative;
    z-index: 0;
}

.estimate-text-sec {
    margin-top: 65px;
}

.estimate-text-sec .disclaimer-box {
    background: #FFF4F4;
    padding: 40px 20px;
    text-align: center;
    border-radius: 10px;
    margin-bottom: 31px;
}

.estimate-text-sec {
    margin-bottom: 105px;
}

.getting-started-sec .hp-design {
    margin-bottom: 38px;
}

.getting-starter-item .started-box {
    padding: 0px;
}

.displayed-result .right-img img.img-fluid {
    border-radius: 20px;
}

.displayed-result .content-wrap-flex {
    padding-left: 100px;
}

.displayed-result .content-wrap-flex h6 {
    color: #0A1475;
    font-size: 16px;
    font-weight: 500;
}

.displayed-result .content-wrap-flex h6 svg {
    fill: #0A1475;
    color: #0A1475;
}

.displayed-result .content-wrap-flex .reduction-sec {
    margin: 41px 0px 0px 0px;
}

.displayed-result .content-wrap-flex .reduction-sec h3 {
    font-size: 40px;
}

.displayed-result .content-wrap-flex .reduction-sec h5 {
    font-size: 18px;
}

.getting-starter-item .started-box h5 {
    color: #273238;
    font-size: 30px;
    font-weight: 700;
    width: 100%;
    max-width: 325px;
    padding: 18px 15px;
}

.getting-starter-item .started-box h5.red {
    background: linear-gradient(90deg, #FFE0E1 0%, #FFFFFF 100%);
    border-left: 1px solid #B7050B;
}

.getting-starter-item .started-box h5.blue {
    background: linear-gradient(90deg, #D2D7FF 0%, #FFFFFF 100%);
    border-left: 1px solid #0A1475;
}

.getting-starter-item .custom-list {
    padding: 0px 22px 30px 22px;
}

.getting-starter-item .custom-list.left-list li::before {
    background: linear-gradient(180deg, #5560CB 0%, #B6050B 100%);
    color: #fff;
    border: none;
}

.getting-starter-item .custom-list li::before {
    width: 35px;
    height: 35px;
}

.getting-starter-item .custom-list li {
    margin-bottom: 48px;
    padding-left: 45px;
}

.getting-starter-item .custom-list.right-list li::before {
    background: linear-gradient(180deg, #5560CB 0%, #0A1475 100%);
    color: #fff !important;
    border: none;
}

.getting-started-sec .action-btn.text-center {
    margin-top: 45px;
}

button.c-btn.blue {
    background-color: #0A1475;
    border-color: #0A1475;
}

button.c-btn.blue:hover {
    background-color: #c8102e;
    border-color: #c8102e;
}

.estimate-text-sec .disclaimer-box .danger-text {
    color: #B7050B;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.footer-top {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

.footer-top .footer-col.footer-left {
    width: 33.3%;
}

.footer-top .footer-col.footer-right {
    width: 66.667%;
    display: flex;
    flex-direction: row;
}

.footer-top .footer-col.footer-right .footer-menu {
    width: 26%;
}

.footer-top .footer-col.footer-right .footer-menu.second-item {
    width: 44%;
}

.footer-top ul {
    list-style: none;
    padding: 0px;
    margin: 0px;
}

.footer-top ul li {
    line-height: 38px;
    margin-top: 15px;
}

.footer-top ul li a {
    display: inline-block;
    text-decoration: none;
    font-size: 16px;
    color: #273238;
    line-height: 32px;
    font-weight: 400;
}

.footer-top .footer-menu h5 {
    font-size: 18px;
    color: #0A1475;
    text-transform: uppercase;
}

.footer-top .footer-col.footer-left>p {
    margin-top: 30px;
    margin-bottom: 0px;
    font-size: 16px;
    color: #273238;
    line-height: 32px;
    font-weight: 400;
}

.footer-top .footer-col.footer-left>a {
    display: inline-block;
    text-decoration: none;
    font-size: 16px;
    color: #273238;
    line-height: 32px;
    font-weight: 400;
}

.footer-top .footer-col.footer-left ul.footer-social {
    display: flex;
    gap: 25px;
    padding: 0;
    margin-top: 22px;
}

.footer-top .footer-col.footer-left ul.footer-social li {
    line-height: normal;
    margin-top: 0px;
}

.footer-top .footer-col.footer-left ul.footer-social li img {
    height: 16px;
}

.footer-bottom p {
    text-align: center;
    border-top: 1px solid rgba(39, 50, 56, 0.06);
    padding-top: 42px;
    padding-bottom: 30px;
    color: #273238;
    font-size: 16px;
    margin-bottom: 0px;
}

footer.footer {
    padding-top: 140px;
    position: relative;
    z-index: 0;
}

footer.footer .footer-top {
    padding-bottom: 144px;
}

footer.footer::after {
    position: absolute;
    content: '';
    left: 0px;
    bottom: 0px;
    height: 58%;
    width: 100%;
    background-image: url(/public/img/footer-gradient.png);
    right: 0;
    z-index: -1;
    background-position: bottom;
    background-repeat: no-repeat;
    background-size: cover;
}

.loader-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100vh;
}

@media (min-width: 1200px) {
    .estimate-text-sec .disclaimer-box p {
        font-size: 18px;
    }
}

@keyframes skewTranslateLoop {
    0% {
        transform: skew(0deg, 0deg) translate(0px, 0px);
    }

    50% {
        transform: skew(0deg, 1.5deg) translate(-196px, 0px);
    }

    100% {
        transform: skew(0deg, 0deg) translate(0px, 0px);
    }
}

.matrix-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #00008B;
    /* dark blue */
    font-size: 12px;
    pointer-events: none;
    z-index: 0;
}

.loader-container {
    position: relative;
    background: white;
    /* white background */
    border: 2px solid red;
    /* red border */
    border-radius: 10px;
    padding: 20px;
    z-index: 1;
    text-align: center;
    width: 90%;
    max-width: 320px;
    color: #00008B;
    /* dark blue text */
    font-weight: bold;
    font-size: 24px;
}

.loading-bar {
    margin-top: 15px;
    font-size: 14px;
    color: #00008B;
    /* dark blue text */
    word-break: break-word;
}

.loading-squares {
    display: inline-block;
}

.loading-squares span {
    display: inline-block;
    width: 8px;
    height: 8px;
    background: red;
    margin: 0 1px;
    animation: blink 1.2s infinite;
}

.loading-squares span:nth-child(even) {
    background: blue;
    animation-delay: 0.6s;
}

@keyframes blink {

    0%,
    50%,
    100% {
        opacity: 1;
    }

    25%,
    75% {
        opacity: 0.3;
    }
}
@media (max-width: 767px){
    body .hp-design h1 {
    font-size: 24px;
    line-height: 28px;
}
body .estimate-text-sec .disclaimer-box {
    padding: 15px;
}
body .getting-starter-item .started-box h5 {
    font-size: 20px;
}
.getting-starter-item .started-box {
    margin-bottom: 30px;
}
body footer.footer .footer-top {
    padding-bottom: 45px;
}
body .footer-top .footer-col.footer-left {
    width: 100%;
    margin-bottom: 20px;
}
.footer-top .footer-col.footer-right .footer-menu {
    width: 100% !important;
    margin-bottom: 20px;
}
body .footer-top ul li {
    margin-top: 0px;
}
body footer.footer {
    padding-top: 60px;
}
body .footer-top .footer-col.footer-right {
    width: 100%;
    flex-wrap: wrap;
}
body footer.footer .footer-top {
    flex-wrap: wrap;
    padding-bottom: 0px;
}
body .footer-bottom p {
    padding: 15px;
}
body .dr-box {
    padding: 15px;
}
body .displayed-result .content-wrap-flex {
    margin-top: 30px;
}
body .displayed-result .content-wrap-flex .reduction-sec {
    margin-top: 20px;
}
body .displayed-result .content-wrap-flex .reduction-sec h3 {
    font-size: 28px;
}
body .estimate-text-sec {
    margin-bottom: 45px;
    margin-top: 45px;
}
}
@media (max-width: 1199px){
    body .displayed-result .content-wrap-flex {
    padding-left: 0px;
}
.desc-results-page nav.navbar #collapsibleNavbar {
    background: #fff;
    border-top: 3px solid #2ea3f2;
    padding: 5%;
}
.desc-results-page nav.navbar #collapsibleNavbar #menu-main-menu li.nav-item {
    width: 100%;
}
.desc-results-page nav.navbar #collapsibleNavbar #menu-main-menu li.nav-item a {
    display: block;
    width: 100%;
    text-align: left;
}
.desc-results-page .navbar-toggler {
    border: none;
    padding: 0px;
    color: #000;
}
}
</style>
<template>
    <!-- Loader -->
    <div v-if="loading">
        <canvas class="matrix-bg"></canvas>
        <div class="loader-wrapper">
            <div class="loader-container">
                Texas Protax
                <div class="loading-bar">//LOADING [
                    <span class="loading-squares">
                        <span></span><span></span><span></span><span></span><span></span>
                        <span></span><span></span><span></span><span></span><span></span>
                    </span>
                    ]
                </div>
            </div>
        </div>
    </div>
    <div class="desc-results-page" v-else>
        <header>
            <div class="custom-container">
                <div class="container-custom">
                    <nav class="navbar navbar-expand-xl">
                        <a class="navbar-brand" href="#"><img src="/public/img/texasprotax-color-logo.svg" /></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsibleNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="collapsibleNavbar">
                            <ul id="menu-main-menu" class="navbar-nav">
                                <li class="nav-item"><a href="https://texasprotax.atxclients.com/">Home</a></li>
                                <li class="nav-item"><a href="https://texasprotax.atxclients.com/our-staff/">Our
                                        Staff</a></li>
                                <li class="nav-item"><a href="https://texasprotax.atxclients.com/reviews/">Reviews</a>
                                </li>
                                <li class="nav-item"><a
                                        href="https://texasprotax.atxclients.com/texas-commercial-property-tax-experts/">Commercial</a>
                                </li>
                                <li class="nav-item"><a
                                        href="https://texasprotax.atxclients.com/newclientsignupcomplete/">Residential</a>
                                </li>
                                <li class="nav-item"><a href="https://texasprotax.atxclients.com/contact-us/">Contact Us</a></li>
                                <li class="nav-item login"><a
                                        href="https://customerportal.texasprotax.com/?_gl=1*w6z9b1*_gcl_au*NTg4ODk4ODA0LjE3NDczODkyODE.*_ga*MzIxNjcwNTk2LjE3NDczODkyODE.*_ga_K11RLC8L5P*czE3NTUwODM5MjYkbzIyJGcwJHQxNzU1MDgzOTI2JGo2MCRsMCRoMA..*_ga_M5XXE7PPXH*czE3NTUwODM5MjYkbzIyJGcwJHQxNzU1MDgzOTI2JGo2MCRsMCRoMA..">Login</a>
                                </li>
                                <li class="nav-item signup"><a
                                        href="https://customerportal.texasprotax.com/Signup?_gl=1*w6z9b1*_gcl_au*NTg4ODk4ODA0LjE3NDczODkyODE.*_ga*MzIxNjcwNTk2LjE3NDczODkyODE.*_ga_K11RLC8L5P*czE3NTUwODM5MjYkbzIyJGcwJHQxNzU1MDgzOTI2JGo2MCRsMCRoMA..*_ga_M5XXE7PPXH*czE3NTUwODM5MjYkbzIyJGcwJHQxNzU1MDgzOTI2JGo2MCRsMCRoMA..">Sign
                                        Up</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <main>
            <section class="banner-content">
                <div class="container-custom">
                    <div class="banner_wrapper hp-design">
                        <p class="sub-title"><img decoding="async" src="/public/img/logo-icon.png">Why do we use it?</p>
                        <h1>Where does it come from?</h1>
                    </div>
                </div>
            </section>
            <section class="displayed-result">
                <div class="container-custom">
                    <div class="dr-box">
                        <div class="row align-items-center">
                            <div class="col-md-6 right-img col-sm-12">
                                <!-- Display satellite image -->
                                <img :src="satelliteImageUrl" alt="Satellite Image" class="img-fluid" />
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="content-wrap-flex">
                                    <h6 style="display: flex; align-items: center; gap: 8px;">
                                        <svg width="17" height="20" viewBox="0 0 17 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M0 8.31776C0 3.71789 3.84388 0 8.49345 0C13.1561 0 17 3.71789 17 8.31776C17 10.6357 16.157 12.7876 14.7695 14.6116C13.2388 16.6235 11.3522 18.3765 9.22854 19.7524C8.74251 20.0704 8.30387 20.0944 7.77045 19.7524C5.63474 18.3765 3.74809 16.6235 2.2305 14.6116C0.841983 12.7876 0 10.6357 0 8.31776ZM5.69423 8.57675C5.69423 10.1177 6.95166 11.3297 8.49345 11.3297C10.0362 11.3297 11.3058 10.1177 11.3058 8.57675C11.3058 7.0478 10.0362 5.77683 8.49345 5.77683C6.95166 5.77683 5.69423 7.0478 5.69423 8.57675Z"
                                                fill="#130F26" />
                                        </svg>
                                        {{ address }}
                                    </h6>
                                    <div class="reduction-sec">
                                        <h3>{{ formattedPrice(potentialReduction) }}</h3>
                                        <h5>Potential Reduction</h5>
                                    </div>
                                    <div class="reduction-sec">
                                        <h3>{{ formattedPrice(potentialSavings) }}</h3>
                                        <h5>Potential Savings</h5>
                                    </div>
                                    <div class="reduction-sec">
                                        <h3>{{ taxRate }}%</h3>
                                        <h5>Tax Rate</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="estimate-text-sec">
                <div class="container-custom">
                    <div class="disclaimer-box">
                        <p class="danger-text"><img decoding="async" src="/public/img/Danger.svg"> Disclaimer</p>
                        <p>
                            This estimate is based on our historical performance for the 2024 tax year within your
                            neighborhood or, when neighborhood-specific data is statistically insufficient, within the
                            broader market area.
                        </p>
                        <p>The projected tax savings are calculated using a hypothetical 2% tax rate.</p>
                        <p>Actual savings may vary due to numerous factors, including jurisdictional differences,
                            exemptions, property condition, and other variables affecting property tax protests.</p>
                        <p>This map is intended for estimation purposes only and should not be relied upon as a
                            guarantee of
                            future results.</p>
                    </div>
                    <div class="action-btn text-center">
                        <button class="c-btn blue" @click="handleContinueClick(hashCode)">Continue</button>
                    </div>
                </div>
            </section>
            <section class="getting-started-sec">
                <div class="container-custom">
                    <div class="hp-design">
                        <p class="sub-title"><img decoding="async" src="/public/img/logo-icon.png">Easy Start</p>
                        <h1>Getting started is easy</h1>
                    </div>
                    <div class="getting-starter-item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="started-box">
                                    <h5 class="red">What you do</h5>
                                    <ol class="custom-list left-list">
                                        <li>Enter your property address</li>
                                        <li>View your potential tax savings</li>
                                        <li>Provide your contact details</li>
                                        <li>Authorize us as your property tax agent</li>
                                        <li>Answer a few brief questions</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="started-box">
                                    <h5 class="blue">What you do</h5>
                                    <ol class="custom-list for-color-chngr right-list">
                                        <li>Evaluate your property</li>
                                        <li>Assemble protest evidence and materials</li>
                                        <li>Complete and file all necessary paperwork</li>
                                        <li>Work with the county on your behalf</li>
                                        <li>Monitor your property to maximize savings in the future</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="action-btn text-center">
                            <button class="c-btn blue" @click="handleContinueClick(hashCode)">Get Started</button>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer class="footer">
            <div class="container-custom">
                <div class="footer-top">
                    <div class="footer-col footer-left">
                        <div class="logo">
                            <a href="https://texasprotax.com/">
                                <img src="/public/img/texasprotax-color-logo.svg" alt="Texas Protax Logo" width="183"
                                    height="90" />
                            </a>
                        </div>
                        <p>
                            8322 Cross Park Drive <br />
                            Austin, Texas 78754
                        </p>
                        <a href="tel:(512) 339.6671">(512) 339.6671</a>
                        <ul class="footer-social">
                            <li><a target="_blank" rel="noopener"
                                    href="https://www.instagram.com/texasprotax/?hl=en"><img decoding="async"
                                        src="https://texasprotax.atxclients.com/wp-content/uploads/2025/08/instagram-icon.png">
                                </a></li>
                            <li><a href=" https://www.facebook.com/texasprotax/" target="_blank"><img decoding="async"
                                        src="https://texasprotax.atxclients.com/wp-content/uploads/2025/07/fb-pcic.svg">
                                </a></li>
                            <li><a href="https://www.youtube.com/channel/UCjWn2CWF6FphWoPQkaA-qyw" target="_blank"><img
                                        decoding="async"
                                        src="https://texasprotax.atxclients.com/wp-content/uploads/2025/07/u-tube.svg">
                                </a></li>
                        </ul>
                    </div>

                    <div class="footer-col footer-right">
                        <div class="footer-menu first-item">
                            <h5>Our Company</h5>
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><a href="https://texasprotax.atxclients.com/our-staff/">Our Staff</a></li>
                                <li><a href="https://texasprotax.atxclients.com/reviews/">Reviews</a></li>
                                <li><a href="https://texasprotax.atxclients.com/property-tax-consultants/">About</a>
                                </li>
                                <li><a href="https://texasprotax.atxclients.com/contact-us/">Contact Us</a></li>
                            </ul>
                        </div>

                        <div class="footer-menu second-item">
                            <h5>Solutions</h5>
                            <ul>
                                <li><a
                                        href="https://texasprotax.atxclients.com/newclientsignupcomplete/">Residential</a>
                                </li>
                                <li><a href="https://texasprotax.atxclients.com#">Residential &amp; Commercial
                                        Property</a></li>
                            </ul>
                        </div>

                        <div class="footer-menu third-item">
                            <h5>Company</h5>
                            <ul>
                                <li><a href="https://texasprotax.atxclients.com/blogs/">Blogs</a></li>
                                <li><a
                                        href="https://texasprotax.atxclients.com/texas-property-tax-news-updates-expert-insights-from-texas-protax/">News</a>
                                </li>
                                <li><a href="https://texasprotax.atxclients.com/faq/">FAQ</a></li>
                                <li><a href="https://texasprotax.atxclients.com/tax-calendar/">Tax Calendar</a></li>
                                <li>
                                    <a href="https://texasprotax.atxclients.comhttps://customerportal.texasprotax.com/?_gl=..."
                                        target="_blank">Login</a>
                                </li>
                                <li>
                                    <a href="https://texasprotax.atxclients.comhttps://customerportal.texasprotax.com/Signup?_gl=..."
                                        target="_blank">Sign up</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>© 2025 Texas Protax. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</template>
