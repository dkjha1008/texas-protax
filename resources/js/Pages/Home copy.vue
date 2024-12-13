<script setup>
import { ref, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';

const addressInput = ref(null);
const satelliteImageUrl = ref('');
const googleApiKey = 'AIzaSyBrDJEHY1D5bloa83uVvJN4xo2cXkWVzyE'; // Replace with your actual API key

onMounted(() => {
    if (typeof google !== 'undefined' && google.maps) {
        // Initialize the Google Maps Autocomplete
        const autocomplete = new google.maps.places.Autocomplete(addressInput.value, {
            types: ['geocode'], // Restrict to address search
        });

        autocomplete.addListener('place_changed', () => {
            const place = autocomplete.getPlace();
            if (place.geometry) {
                const lat = place.geometry.location.lat();
                const lng = place.geometry.location.lng();

                console.log('Selected place:', place);

                // Generate satellite image URL based on selected location
                satelliteImageUrl.value = `https://maps.googleapis.com/maps/api/staticmap?center=${lat},${lng}&zoom=15&size=600x300&maptype=satellite&key=${googleApiKey}`;
            } else {
                console.error('No geometry information available for the selected place.');
            }
        });
    } else {
        console.error('Google Maps API is not loaded.');
    }
});
</script>

<template>
    <AppLayout title="Texas Protax">
        <div>
            <h1 class="text-center">Welcome to Inertia.js with Vue 3</h1>

            <!-- Address Input Field -->
            <input type="text" ref="addressInput" class="form-control" placeholder="Enter your address" />

            <!-- Display Satellite Image -->
            <div v-if="satelliteImageUrl" class="mt-4">
                <h3>Satellite Image</h3>
                <img :src="satelliteImageUrl" alt="Satellite View" class="img-fluid" />
            </div>
        </div>
    </AppLayout>
</template>
