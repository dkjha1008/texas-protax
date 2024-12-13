<script setup>
import Header from './Header.vue';
import Footer from './Footer.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    title: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div>
        <!-- Header Component -->
        <Header />

        <!-- Set Page Title -->

        <Head :title="title" />

        <!-- Main Content Section -->
        <div class="p-0 container-fluid" id="page-middle-section">
            <main>
                <slot />
            </main>
        </div>

        <!-- Footer Component -->
        <Footer />
    </div>
</template>
